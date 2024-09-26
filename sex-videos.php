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
        <div class="row escort_ro">
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
              <a href="video.php" class="align-middle"><img src="assets/images/products/no-img-men.jpg" class="show-not align-middle" alt="" width="560" height="170"></a>
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
          </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
              <a href="javascript:void(0)"><img src="assets/images/products/no-img-men.jpg" class="show-not" alt="" width="560" height="170"></a>
              </div>
            </div>
          </div>
        </div>
<?php 
  require "inc/footer.php";
?>
<script>
  $('.show-not').mouseover(function(){
    $(this).attr("src", "videos/94132137-7d4fc100-fe7c-11ea-8512-69f90cb65e48.gif");
  }).mouseout(function(){
    $(this).attr("src", "assets/images/products/no-img-men.jpg");
  })
  
  // $(document).ready(function(event) {
  //   // event.preventDefault(); 
  //   const slug = '<?//=$slug?>';
  //   $.ajax({
  //       url: 'controllers/ajaxGet.php?escorts='+slug,
  //       method: 'GET',
  //       dataType: 'json',
  //       data: slug,
  //       contentType: false,
  //       processData: false,
  //       beforeSend: () => {
  //           $('.escort_row').html('Loading contents...');
  //       },
  //       success: (param) => {
  //           if (param) {
  //               $('.escort_row').html(param);
  //           }
  //       }
  //   })

  // })
</script>