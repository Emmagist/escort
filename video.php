<?php


  require_once "controllers/users.php";

  $redirect = $db->redirectURI(); //echo $redirect;exit;
  // $db->getLoginSession($redirect);

  // $ip_address = Database::getClientIp();

  if (isset($_SESSION['token']) && isset($_SESSION['role']) && $_SESSION['role'] == 3 || $_SESSION['role'] == 2) {
      $token = $_SESSION['token'];
      $role = $_SESSION['role'];
  }

  if (isset($_GET['ent'])) {
    $slug = $_GET['ent'];
  }
  
  foreach (Users::getSingleSexVideos($slug) as $key) {
    $cat = $key['sex_cat_id'];
  }

  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";

?>

<style>
  .video-card {
    background-color: #111;
    border-radius: 8px;
    overflow: hidden;
    color: #fff;
    width: 100%;
    max-width: 100%;
    margin-bottom: 30px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    transition: transform 0.3s ease;
}

.video-card:hover {
    transform: scale(1.02);
}

.video-thumb-container {
    position: relative;
    background-color: #000;
}

.video-player {
    width: 100%;
    height: auto;
    max-height: 550px;
    object-fit: cover;
    border-radius: 0;
}

.video-info {
    padding: 15px;
}

.video-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
    color: #f1f1f1;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>
    
      <!--  Header End -->
    <div class="container-fluid">
        <div class="row escort_ro">
          <div class="col-lg-12 d-flex align-items-strech" id="show-sex-video"></div>
          <!-- <div class="col-sm-6 col-xl-3">
            <div class="" style="display: block;">
                <div class=" overflow-hidden rounded-2 mb-4 mt-3">
                <div class="position-relative" id="testing">
                <a href="javascript:void(0)"><img src="assets/images/advert/PLACE-YOUR-ADVERT-HERE.gif" class="show-not" alt="" width="300" height="200"></a>
                </div>
                </div>
                <div class=" overflow-hidden rounded-2">
                <div class="" id="testing">
                <a href="javascript:void(0)"><img src="assets/images/advert/PLACE-YOUR-ADVERT-HERE.gif" class="show-not" alt="" width="300" height="200" style="display: block !important;margin-left: auto!important;margin-right: auto!important;"></a>
                </div>
                </div>
            </div>
          </div> -->
        </div>
        <div class="container-fluid" style="padding-top:100px;">
            <h4 class="text-title">Related Videos</h4>
            <div class="row" id="re__videos">
                <!-- <div class="col-sm-6 col-xl-3">
                  <div class="card overflow-hidden rounded-2">
                      <div class="position-relative" id="testing">
                      <a href="video.php"><img src="assets/images/products/no-img-men.jpg" class="show-not" alt="" width="560" height="170"></a>
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
        </div>
<?php 
  require "inc/footer.php";
?>
<script>
  $(document).ready(function(event) {
    // event.preventDefault(); 
    const slug = '<?=$slug?>';
    $.ajax({
        url: 'controllers/ajaxGet.php?ent='+slug,
        method: 'GET',
        dataType: 'json',
        data: slug,
        // contentType: false,
        // processData: false,
        beforeSend: () => {
            $('#show-sex-video').html('Loading contents...');
        },
        success: (param) => {
            if (param) {
                $('#show-sex-video').html(param);
            }
        }
    })

  });

  function changein(params, id){
    $('.sex__change__'+id).attr("src", params);
  }
  function changeout(params, id){
    $('.sex__change__'+id).attr("src", params);
  }

  //Related Video
  $(document).ready(function(event) {
    const slug = '<?=$slug?>';
    const cat = '<?=$cat?>';
    
    $.ajax({
      url: 'controllers/ajaxGet.php?rel='+slug+'&cate='+cat,
      method: 'GET',
      dataType: 'json',
      data: {slug,cat},
      contentType: false,
      processData: false,
      beforeSend: () => {
        $('#re__videos').html('Loading contents...');
      },
      success: (param) => {
        if (param) {
            $('#re__videos').html(param);
        }
      }
    })

  })
</script>