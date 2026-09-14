<?php
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Change Password</h4>
        <div class="row escort_profile">
            <form action=""method="POST" id="change_password">
              <div class="mb-3">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_danger"></li>
              </div>
              <!-- <div class="row"> -->
                <div class="col-md-6">
                  <label>Current Password</label>
                  <input type="password" class="form-control mb-3" name="current_password">
                </div>
                <div class="col-md-6">
                  <label>New Password</label>
                  <input type="password" class="form-control mb-3" name="new_password">
                  <input type="hidden" class="form-control mb-3" name="token" value="<?=$_SESSION['token']?>">
                </div>
                <div class="col-md-6">
                  <label for="c_new_password">Confirm New Password</label>
                  <input type="password" class="form-control mb-3" name="c_new_password"  id="c_new_password">
                </div>
                <div class="col-md-6"><button type="submit" class="btn btn-warning p-3" id="post_button">Change Password</button></div>
              <!-- </div> -->
            </form>
        </div>
<?php 
  // else : echo "Sorry you do not have right access to this page";
  // endif;
  require "inc/footer.php";
?>

<script>
  //upload escort profile
  $('#change_password').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=211',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#post_button').html('Processing...');
          },
          success: (param) => {
            if (param.success) {
              $('#post_button').html('Password Changed');
              $('#reg_success').fadeIn()
              $('#reg_success').text(param.success);
              setTimeout(() => {
                $('#reg_success').fadeOut();
                location.reload();
              }, 2000);
            }else if(param.error){
              $('#post_button').html('Change Password');
              $('#reg_danger').fadeIn()
              $('#reg_danger').text(param.error);
              setTimeout(() => {
                $('#reg_danger').fadeOut();
              }, 5000);
            }
          }
      })
      return false;
  });
</script>