<?php
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">My Profile</h4>
        <div class="row escort_profile">
            <form action=""method="POST" id="edit_profile">
              <div class="mb-3">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_danger"></li>
              </div>
              <div class="row div_row"></div>
            </form>
        </div>
<?php 
  // else : echo "Sorry you do not have right access to this page";
  // endif;
  require "inc/footer.php";
?>

<script>
  $(document).ready(function(event) {
    // event.preventDefault(); 
    const token = '<?=$_SESSION['token']?>';
    $.ajax({
      url: 'controllers/ajaxGet.php?pf_fm='+token,
      method: 'GET',
      dataType: 'json',
      data: token,
      contentType: false,
      processData: false,
      beforeSend: () => {
          $('.div_row').html('Loading Data...');
      },
      success: (param) => {
        if (param) {
          $('.div_row').html(param);
        }
      }
    })

  })

  //upload escort profile
  $('#edit_profile').submit(function () {
      const formData = new FormData(this);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=212',
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
              $('#post_button').html('Profile Edited');
              $('#reg_success').fadeIn()
              $('#reg_success').text(param.success);
              setTimeout(() => {
                $('#reg_success').fadeOut();
                location.reload();
              }, 3000);
            }else if(param.error){
              $('#post_button').html('Edit Profile');
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