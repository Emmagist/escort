<?php

  require "inc/auth.php";
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
    
      <!--  Header End -->
    <div class="container-fluid">
        <div class="row escort_ro">
          <div class="col-lg-9 d-flex align-items-strech" id="show-sex-video">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                      <div class="carousel-item active">
                      <video src="videos/Xvideos_sishd_-_my_step_sis_was_lying_about_pregnancy_HD.mp4" style="height: 450px;" class="d-block w-100 rounded-2" controls></video>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="" style="display: block;">
                <div class=" overflow-hidden rounded-2 mb-4 mt-5">
                <div class="position-relative" id="testing">
                <a href="javascript:void(0)"><img src="assets/images/advert/PLACE-YOUR-ADVERT-HERE.gif" class="show-not" alt="" width="560" height="170"></a>
                </div>
                </div>
                <div class=" overflow-hidden rounded-2">
                <div class="" id="testing">
                <a href="javascript:void(0)"><img src="assets/images/advert/PLACE-YOUR-ADVERT-HERE.gif" class="show-not" alt="" width="560" height="170" style="display: block !important;margin-left: auto!important;margin-right: auto!important;"></a>
                </div>
                </div>
            </div>
          </div>
        </div>
        <div class="container-fluid" style="padding-top:100px;">
            <h4 class="text-title">Related Videos</h4>
            <div class="row re__videos">
                <div class="col-sm-6 col-xl-3">
                  <div class="card overflow-hidden rounded-2">
                      <div class="position-relative" id="testing">
                      <a href="video.php"><img src="assets/images/products/no-img-men.jpg" class="show-not" alt="" width="560" height="170"></a>
                      </div>
                  </div>
                </div>
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
        contentType: false,
        processData: false,
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

  function changein(params){ //alert(params)
    $('.sex__change').attr("src", params);
  }
  function changeout(params){
    $('.sex__change').attr("src", params);
  }

  $(document).ready(function(event) {//alert('hey')
    const slug = '<?=$slug?>';
    const cat = '<?=$cat?>';
    
    $.ajax({
      url: 'controllers/ajaxGet.php?rel='+slug+'&cat='+cat,
      method: 'GET',
      dataType: 'json',
      data: {slug,cat},
      contentType: false,
      processData: false,
      beforeSend: () => {
        $('.re__videos').html('Loading contents...');
      },
      success: (param) => {
        if (param) {
            $('.re__videos').html(param);
        }
      }
    })

  })
</script>