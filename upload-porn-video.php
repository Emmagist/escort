<?php
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Upload Profile</h4>
        <div class="row escort_profile">
            <form action=""method="POST" id="upload_porn">
              <div class="row">
                <div class="col-md-6">
                  <label for="title">Title</label>
                  <input type="text" class="form-control mb-3" name="title" id="title">
                </div>
                <input type="hidden" class="form-control mb-3" name="token" value="12345">
                <div class="col-md-6">
                  <label for="hash_tag">Hash Tag</label>
                  <input type="text" class="form-control mb-3" name="hash_tag" id="hash_tag">
                </div>
                <div class="col-md-6">
                  <label for="fileUpload">Upload file</label>
                  <input type="file" class="form-control mb-3" id="fileUpload" name="fileUpload">
                </div>
                <div class="col-md-6">
                  <label for="content">Contents</label>
                  <textarea class="form-control mb-3" placeholder="Contents" name="content" id="content"></textarea>
                </div>
                <div class="col-md-6"><button type="submit" class="btn btn-primary p-3" id="post_button">Upload</button></div>
              </div>
            </form>
        </div>
<?php 
  // else : echo "Sorry you do not have right access to this page";
  // endif;
  require "inc/footer.php";
?>

<script>
  //upload escort profile
  $('#upload_porn').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=204',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#post_button').html('Uploading...');
          },
          success: (param) => {
              if (param) {
                $('#post_button').html('Uploaded');
              }
          }
      })
      return false;
  })
</script>