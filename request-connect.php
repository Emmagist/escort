<?php
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Request For Sugar
          <?php
          if ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 's_mummy') {
            echo 'Boy';
          }elseif ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 'none') {
            echo 'Daddy';
          }elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 's_daddy') {
            echo 'Baby';
          }elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 'none') {
            echo 'Mummy';
          }
          ?>
        </h4>
        <p class="">We will be charging you
        <?php
          if ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 's_mummy') {
            echo '<strong>#50,000</strong>';
          }elseif ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 'none') {
            echo '<strong>#35,000</strong>';
          }elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 's_daddy') {
            echo '<strong>#50,000</strong>';
          }elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 'none') {
            echo '<strong>#35,000</strong>';
          }
          ?>
          for this service.
        </p>
        <div class="row escort_profile">
            <form action=""method="POST" id="request_sugar">
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
                <input type="hidden" class="form-control mb-3" name="token" value="'<?=$_SESSION['token']?>'">
                <input type="hidden" class="form-control mb-3" name="gender" value="'<?=$_SESSION['gender']== 'female'?'male':'female'?>'">
                <div class="col-md-6">
                  <label for="currency">Currency</label>
                  <select name="currency" id="currency" class="form-control mb-3">
                    <option value="">Select Currency</option>
                    <option value="ngn">NGN</option>
                    <option value="usd">USD</option>
                  </select>
                </div>
                <?php if($_SESSION['connect'] != 'none'): ?>
                <div class="col-md-6">
                  <label for="prices">Offering Price</label>
                  <input type="number" class="form-control mb-3" name="prices" id="prices">
                </div>
                <?php else: ''; endif; ?>
                <?php if($_SESSION['connect'] == 'none'): ?>
                <div class="col-md-6">
                  <label for="weight">Weight</label>
                  <input type="number" class="form-control mb-3" name="weight" id="weight">
                </div>
                <?php else: ''; endif; ?>
                <?php if($_SESSION['connect'] == 'none'): ?>
                <div class="col-md-6">
                  <label for="height">Height</label>
                  <input type="number" class="form-control mb-3" name="height" id="height">
                </div>
                <?php else: ''; endif; ?>
                <div class="col-md-6">
                  <label for="business">Your Business Type</label>
                  <input type="text" class="form-control mb-3" name="business" id="business">
                </div>
                <div class="col-md-6">
                  <label for="age_request">Age Requesting For:</label>
                  <input type="number" class="form-control mb-3" name="age_request" id="age_request">
                </div>
                <div class="col-md-6">
                  <label for="ethnicity">Ethnicity</label>
                  <input type="text" class="form-control mb-3" name="ethnicity" id="ethnicity">
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
                  <label for="weight_request">Weight Requesting For:</label>
                  <input type="text" class="form-control mb-3" name="weight_request" id="weight_request">
                </div>
                <div class="col-md-6">
                  <label for="height_request">Height Requesting For:</label>
                  <input type="text" class="form-control mb-3" name="height_request" id="height_request">
                </div>
                <div class="col-md-6">
                  <label for="complex">Complexion</label>
                  <select name="complexion" id="complex" class="form-control mb-3">
                    <option value="">Select Complexion</option>
                    <option value="black_skin">Black Skin</option>
                    <option value="light_skin">Light Skin</option>
                    <option value="chocolate_skin">Chocolate Skin</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="location">Location</label>
                  <input type="text" class="form-control mb-3" name="location" id="location">
                </div>
                <div class="col-md-6">
                  <label for="fileUpload">Upload Your Picture</label>
                  <input type="file" class="form-control mb-3" id="fileUpload" name="fileUpload">
                </div>
                <div class="col-md-12">
                  <label for="note">Describe what you want and your self very well here</label>
                  <textarea class="form-control mb-3" placeholder="Describe what you want and your self very well here" name="note" id="note"></textarea>
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
    const con = '<?=$_SESSION['connect']?>';
    const gender = '<?=$_SESSION['gender']?>';
    $.ajax({
      url: 'controllers/ajaxGet.php?con='+con+'&gender='+gender,
      method: 'GET',
      dataType: 'json', 
      data: {con,gender},
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
  $('#request_sugar').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=205',
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