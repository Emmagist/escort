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
            <form action=""method="POST" id="upload_escort">
              <div class="mb-3">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_danger"></li>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="category">Category</label>
                  <select name="category" id="category" class="form-control"></select>
                </div>
                <!-- <div class="col-md-6">
                  <label>Username</label>
                  <input type="text" class="form-control mb-3" name="username">
                </div> -->
                <div class="col-md-6">
                  <label for="age">Age</label>
                  <input type="number" class="form-control mb-3" name="age" id="age">
                </div>
                <input type="hidden" class="form-control mb-3" name="token" value="12345">
                <div class="col-md-6">
                  <label for="gender">Gender</label>
                  <select name="gender" id="gender" class="form-control">
                    <option value="">Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="period">Period</label>
                  <select name="period" id="period" class="form-control">
                    <option value="">Select Period</option>
                    <option value="hour">Hour</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="currency">Currency</label>
                  <select name="currency" id="currency" class="form-control">
                    <option value="">Select Currency</option>
                    <option value="ngn">NGN</option>
                    <option value="usd">USD</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="prices">Price</label>
                  <input type="number" class="form-control mb-3" name="prices" id="prices">
                </div>
                <div class="col-md-6">
                  <label for="weight">Weight</label>
                  <input type="text" class="form-control mb-3" name="weight" id="weight">
                </div>
                <div class="col-md-6">
                  <label for="height">Height</label>
                  <input type="text" class="form-control mb-3" name="height" id="height">
                </div>
                <div class="col-md-6">
                  <label for="ethnicity">Ethnicity</label>
                  <input type="text" class="form-control mb-3" name="ethnicity" id="ethnicity">
                </div>
                <div class="col-md-6">
                  <label for="hair_long">Hair Lenght</label>
                  <input type="text" class="form-control mb-3" name="hair_long" id="hair_long">
                </div>
                <div class="col-md-6">
                  <label for="hair_color">Hair Color</label>
                  <input type="text" class="form-control mb-3" name="hair_color" id="hair_color">
                </div>
                <div class="col-md-6">
                  <label for="bust_size">Bust</label>
                  <select name="bust_size" id="bust_size" class="form-control mb-3">
                    <option value="">Select Bust Size</option>
                    <option value="l">L</option>
                    <option value="xl">XL</option>
                    <option value="xxl">XXL</option>
                    <option value="xxxl">XXXL</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="smoker">Smoker</label>
                  <select name="smoker" id="smoker" class="form-control mb-3">
                    <option value="">Select Smoker</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="alcohol">Alcohol</label>
                  <select name="alcohol" id="alcohol" class="form-control mb-3">
                    <option value="">Select Alcohol</option>
                    <option value="yes">Yes</option>
                    <option value="no">no</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="build">Build</label>
                  <input type="text" class="form-control mb-3" name="build" id="build">
                </div>
                <div class="col-md-6">
                  <label for="sexual_orientation">Sexual Orientation</label>
                  <input type="text" class="form-control mb-3" name="sexual_orientation" id="sexual_orientation">
                </div>
                <div class="col-md-6">
                  <label for="fileUpload">Upload file</label>
                  <input type="file" class="form-control mb-3" id="fileUpload" name="fileUpload">
                </div>
                <div class="col-md-12">
                  <label>Bio</label>
                  <textarea class="form-control mb-3" placeholder="Bio" name="bio"></textarea>
                </div>
                <div class="col-md-6"><button type="submit" class="btn btn-primary p-3" id="post_button">Request</button></div>
              </div>
            </form>
        </div>
<?php 
  // else : echo "Sorry you do not have right access to this page";
  // endif;
  require "inc/footer.php";
?>

<script>
  //get category
  $(document).ready(function(event) {//alert('hey')
    // event.preventDefault(); 
    $.ajax({
      url: 'controllers/ajaxGet.php?cat=200',
      method: 'GET',
      dataType: 'json',
      data: '200',
      contentType: false,
      processData: false,
      beforeSend: () => {
          $('#category').html('Loading contents...');
      },
      success: (param) => {
        if (param) {
          $('#category').html(param);
        }
      }
    })
  })

  //upload escort profile
  $('#upload_escort').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=203',
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
              $('#reg_success').fadeIn()
              $('#reg_success').text(param.success);
              setInterval(() => {
                $('#reg_success').fadeOut();
                location.reload();
              }, 5000);
            }else if(param.error){
              $('#post_button').html('Upload');
              $('#reg_danger').fadeIn()
              $('#reg_danger').text(param.error);
              setInterval(() => {
                $('#reg_danger').fadeOut();
              }, 5000);
            }
          }
      })
      return false;
  })
</script>