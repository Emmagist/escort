<?php
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";

?>
    <div class="container-fluid">
        <div class="col-md-8 offset-md-1">
            <h3>DeBrain Live — Viewer</h3>
            <div class="card p-3 mb-3">
            <video id="remoteVideo" autoplay playsinline class="w-100" style="height:360px;"></video>
            </div>

            <div class="mb-3">
            <button id="watchBtn" class="btn btn-primary">Watch Stream</button>
            <button id="stopWatchBtn" class="btn btn-secondary" disabled>Stop Watching</button>
            </div>

            <div id="status" class="small text-muted">Status: idle</div>
        </div>
    </div>

<?php require "inc/footer.php"; ?>

<script>
$(function(){
  const SIGNAL_URL = 'signal.php';
  let pc = null;
  let localStream = null;
  let pollingAnswerInterval = null;

  async function startLocal() {
    localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
    $('#localVideo')[0].srcObject = localStream;
  }

  async function startStreaming() {
    $('#status').text('Status: Creating connection...');
    pc = new RTCPeerConnection();

    // Add local tracks
    localStream.getTracks().forEach(t => pc.addTrack(t, localStream));

    pc.onicecandidate = (e) => {
      // no special handling — ICE candidates included in SDP by default when setLocalDescription is used in browsers
    };

    // Create offer
    const offer = await pc.createOffer();
    await pc.setLocalDescription(offer);

    // send offer (SDP + type) to signaling server
    await $.ajax({
      url: SIGNAL_URL + '?action=post_offer',
      type: 'POST',
      data: JSON.stringify(pc.localDescription),
      contentType: 'application/sdp' // arbitrary
    });

    $('#status').text('Status: Offer posted. Waiting for answer...');

    // start polling for answer every 2s
    pollingAnswerInterval = setInterval(async () => {
      const res = await $.getJSON(SIGNAL_URL + '?action=get_answer&_=' + Date.now());
      if (res.answer) {
        // set remote description
        if (!pc.currentRemoteDescription) {
          await pc.setRemoteDescription(new RTCSessionDescription(res.answer));
          $('#status').text('Status: Viewer connected (answer applied). Streaming live.');
        }
        // stop polling further if we have answer
        clearInterval(pollingAnswerInterval);
      }
    }, 2000);

    $('#startBtn').prop('disabled', true);
    $('#stopBtn').prop('disabled', false);
  }

  async function stopStreaming(){
    if (pc) {
      pc.getSenders().forEach(s => {
        try { pc.removeTrack(s); } catch(e) {}
      });
      pc.close();
      pc = null;
    }
    if (localStream) {
      localStream.getTracks().forEach(t => t.stop());
      localStream = null;
      $('#localVideo')[0].srcObject = null;
    }
    clearInterval(pollingAnswerInterval);
    $('#startBtn').prop('disabled', false);
    $('#stopBtn').prop('disabled', true);
    $('#status').text('Status: stopped');
  }

  $('#startBtn').click(async function(){ 
    await startLocal();
    await startStreaming();
  });

  $('#stopBtn').click(async function(){
    await stopStreaming();
  });

  $('#clearSignal').click(async function(){
    await $.getJSON(SIGNAL_URL + '?action=clear');
    alert('signal cleared');
  });
});
</script>
</body>
</html>
