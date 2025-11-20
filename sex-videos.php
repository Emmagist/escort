<?php
  require_once "controllers/users.php";

  $redirect = $db->redirectURI(); //echo $redirect;exit;
  // $db->getLoginSession($redirect);

  // $ip_address = Database::getClientIp();

  if (isset($_SESSION['token']) && isset($_SESSION['role']) && $_SESSION['role'] == 3 || $_SESSION['role'] == 2) {
      $token = $_SESSION['token'];
      $role = $_SESSION['role'];
  }

  if (isset($_GET['pg'])) {
    $slug = $_GET['pg'];
  }
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";

?>

<style>
  @media only screen and (max-width: 600px) {
  .sex__list__show{
    width: 390px;
    height: 220px;
  }

  #related_videos{
    padding-top: 50px;
  }

  .related_video_img_card{
    width: 350px;
    height: 200px;
  }
}

/* @media only screen and (max-width: 540px){
  .sex__list__show{
    width: 718px;
    height: 260px;
  }
} */

@media only screen and (max-width: 414px){
  .sex__list__show{
    width: 375px;
    height: 200px;
  }
}

@media only screen and (max-width: 390px){
  .sex__list__show{
    width: 350px;
    height: 180px;
  }
}

@media only screen and (max-width: 375px){
  .sex__list__show{
    width: 337px;
    height: 170px;
  }
}

@media only screen and (max-width: 360px){
  .sex__list__show{
    width: 320px;
    height: 170px;
  }
}

@media only screen and (max-width: 344px){
  .sex__list__show{
    width: 420px !important;
    height: 170px !important;
  }
}

/* @media only screen and (max-width: 768px){
  .sex__list__show{
    padding-right: 225px;
    width: 400px;
    height: 150px;
  }

  .sex_video_title{
    width: 170px;
  }
}

@media only screen and (max-width: 912px){
  .sex__list__show{
    padding-right: 215px;
    width: 420px;
    height: 150px;
  }

  .sex_video_title{
    width: 200px !important;
  }
}

@media only screen and (max-width: 768px){
  .retaled_video_card{
    margin-right: 130px;
  }
}

@media only screen and (max-width: 820px){
  .sex__list__show{
    padding-right: 215px;
    width: 400px;
    height: 150px;
  }

  .sex_video_title{
    width: 170px;
  }
}

@media only screen and (max-width: 1024px){
  .sex__list__show{
    padding-right: 210px;
    width: 445px;
    height: 170px;
  }

  .sex_video_title{
    width: 235px;
  }
} */

</style>
    
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
  function changein(params, id){ //alert(id)
    $('.sex__change__'+id).attr("src", params);
  }
  function changeout(params, id){
    $('.sex__change__'+id).attr("src", params);
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