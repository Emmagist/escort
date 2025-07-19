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
    
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row mb-5">
          <!-- <div class="col-md-3">
            <input type="search" name="search" id="search__data" class="form-control" placeholder="Search by state, location or username">
            <ul class="rounded p-2" style="box-shadow: 2px 2px gray; display:none;" id="search_result">
              <li class="list-items list-unstyle mb-2"><a href="" class="text-bold" style="font-weight: 600; color:#000">Lagos</a></li>
            </ul>
          </div> -->
          <div class="position-relative col-md-9">
            <input type="search" name="search" id="search__data" class="form-control ps-5" placeholder="Search by state, location or username">
            <i class="fa fa-search text-black" style="position: absolute;top: 50%;left: 15px;transform: translateY(-50%);font-size: 18px;color: #888;pointer-events: none; padding-left:10px;"></i>
            
            <ul class="list-group position-absolute w-100 z-3 bg-white" id="search_result" style="display:none; max-height: 250px; overflow-y: auto;"></ul>
          </div>


        </div>
        <div class="row escort_row">
          <!-- <div class="col-sm-6 col-xl-3">
            <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <a href="javascript:void(0)"><img src="assets/images/products/s4.jpg" class="card-img-top rounded-0" alt="..."></a>
                <a href="javascript:void(0)" class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add To Cart">order<i class=" fs-4"></i>
                </a>               
              </div>
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Boat Headphone</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-semibold fs-4 mb-0">$50 <span class="ms-2 fw-normal text-muted fs-3"><del>$65</del></span></h6>
                  <ul class="list-unstyled d-flex align-items-center mb-0">
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="me-1" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                    <li><a class="" href="javascript:void(0)"><i class="ti ti-star text-warning"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div> -->
        </div>
<?php 
  require "inc/footer.php";
?>
<script>
  $(document).ready(function(event) {
    // event.preventDefault(); 
    const slug = '<?=$slug?>';
    $.ajax({
        url: 'controllers/ajaxGet.php?escorts='+slug,
        method: 'GET',
        dataType: 'json',
        data: slug,
        contentType: false,
        processData: false,
        beforeSend: () => {
            $('.escort_row').html('Loading contents...');
        },
        success: (param) => {
            if (param) {
                $('.escort_row').html(param);
            }
        }
    })

  })

  //search
  $('#search__data').keyup(function () {
    const formData = $(this).val();
    const slug = '<?=$slug?>';
    $.ajax({
        url: 'controllers/fetchAjax.php?pg=206&esc_pg=' + slug + '&data=' + encodeURIComponent(formData),
        method: 'GET',
        dataType: 'json',
        beforeSend: () => {
          $('#search_result').show();
          $('#search_result').html('Searching...');
        },
        success: (param) => {
          if (param.success) {
            $('#search_result').html(param.success);
          } else if (param.error) {
            $('#search_result').html(param.error);
            setTimeout(() => {
              $('#search_result').fadeOut();
            }, 3000);
          }
        }
    });
    return false;
  });


  function bookEscort(key) { //alert(key)
    const slug = '<?=$slug?>';
    const token = '<?=$_SESSION['token']?>';
    const page = '<?=$redirect?>'

    if (token.length == 0) {
      window.location.href = 'login?page_url='+page;
    }else if (token.length > 0) {
      window.location.href='escort-profile?esc='+key+'&sg='+slug
      // window.location.href = "escort-profile.php?esc="+key+"&sg="+slug
    }
  }
</script>