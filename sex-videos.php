<?php
  require "inc/auth.php";
  if (isset($_GET['pg'])) {
    $slug = $_GET['pg'];
  }
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row sex_videos">
          <!-- <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
              <a href="video.php" class="align-middle"><img src="assets/images/products/no-img-men.jpg" class="show-not align-middle" alt="" width="560" height="170"></a>
              </div>
            </div>
          </div> -->
          <!-- <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
              <a href="javascript:void(0)"><img src="assets/images/products/no-img-men.jpg" class="show-not" alt="" width="560" height="170"></a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
              <a href="javascript:void(0)"><img src="assets/images/products/no-img-men.jpg" class="show-not" alt="" width="560" height="170"></a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
              <a href="javascript:void(0)"><img src="assets/images/products/no-img-men.jpg" class="show-not" alt="" width="560" height="170"></a>
              </div>
            </div>
          </div> -->
        </div>
<?php 
  require "inc/footer.php";
?>
<script>
  function changein(params){ //alert(params)
    $('.sex__change').attr("src", params);
  }
  function changeout(params){
    $('.sex__change').attr("src", params);
  }
  
  $(document).ready(function(event) {//alert('hey')
    // event.preventDefault(); 
    // const token = $('#escort_profile').attr('data-id'); //alert(token);
    
    $.ajax({
      url: 'controllers/ajaxGet.php?svd=2005',
      method: 'GET',
      dataType: 'json',
      data: 2005,
      contentType: false,
      processData: false,
      beforeSend: () => {
        $('.sex_videos').html('Loading contents...');
      },
      success: (param) => {
        if (param) {
            $('.sex_videos').html(param);
        }
      }
    })

  })
</script>