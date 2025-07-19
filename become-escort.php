<?php

  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Upload Profile</h4>
        <div class="row escort_profile">
            <form action=""method="POST" id="become_esc">
              <div class="mb-3">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success__"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_dangers"></li>
              </div>
              <div class="col-md-6 ">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control mb-3" name="username">
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control mb-3" name="address">
                </div>
                <input type="hidden" class="form-control mb-3" name="token" value="<?=$_SESSION['token']?>">
                <div class="form-group">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="form-control mb-3">
                    <option value="">Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                  </select>
                </div>
                <div class="form-group">
                    <label>NIN</label>
                    <input type="number" class="form-control mb-3" name="nin" placeholder="12345678912">
                </div>
                <div class="form-group">
                  <label>Upload NIN Slip</label>
                  <input type="file" class="form-control mb-3" name="nin_slip">
                </div>
                <div class="form-group">
                  <label>Upload Recent Passport/Photograph</label>
                  <input type="file" class="form-control mb-3" name="passport">
                </div>
                </div>
                <div class="form-group"><button type="submit" class="btn btn-primary p-3" id="post_button">Post</button></div>
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
  $('#become_esc').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=208',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#post_button').html('Posting...');
          },
          success: (param) => {
            if (param.success) {
              $('#post_button').html('Uploaded');
              $('#reg_success__').fadeIn()
              $('#reg_success__').text(param.success);
              setInterval(() => {
                $('#reg_success__').fadeOut();
                location.reload();
              }, 5000);
            }else if(param.error){
              $('#post_button').html('Upload');
              $('#reg_dangers').fadeIn()
              $('#reg_dangers').text(param.error);
              setInterval(() => {
                $('#reg_dangers').fadeOut();
              }, 5000);
            }
          }
      })
      return false;
  });


    
</script>