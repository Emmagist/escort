<?php

    // if (isset()) {
    //     # code...
    // }
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  $token = '67543388$re386yf32198765430op876y$';

?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Services Request</h5>
                <div class="table-responsive" id="table-responsive"></div>
              </div>
            </div>
          </div>
        </div>
<?php require "inc/footer.php"; ?>

<script>
    $(document).ready(function(event) {
    // event.preventDefault(); 
    const token = '<?=$token?>';
    $.ajax({
        url: 'controllers/ajaxGet.php?req_vw='+token,
        method: 'GET',
        dataType: 'json',
        data: token,
        contentType: false,
        processData: false,
        beforeSend: () => {
            $('#table-responsive').html('Loading contents...');
        },
        success: (param) => {
            if (param) {
                $('#table-responsive').html(param);
            }
        }
    })

  })

  function viewRequest(params) {
      $('#view-request').modal('show');

      $.ajax({
          url: 'controllers/ajaxGet.php?view_req='+params,
          method: 'GET',
          dataType: 'json',
          data: params,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#modal-body-view').html('Loading contents...');
          },
          success: (param) => {
              if (param) {
                  $('#modal-body-view').html(param);
              }
          }
      })
  }

  $('#acceptForm').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=205',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#send-request').html('Sending...');
          },
          success: (param) => {
              if (param) {
              }
          }
      })
      return false;
  })
</script>