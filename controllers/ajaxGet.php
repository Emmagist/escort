<?php

    require_once "ajaxRequest.php";

  if ($_GET['nav']) {
    $token = $_GET['nav'];
    $outPut = '';

    if (Ajax::getSideBarLists()) {
      foreach (Ajax::getSideBarLists() as $key) {
        $outPut .= '
        <li class="sidebar-item">
          <a class="sidebar-link" href="pages.php?pg='.$key['token_guid'].'" aria-expanded="false">
            <span>
              <i class="'.$key['icon'].'"></i>
            </span>
            <span class="hide-menu">'.ucfirst($key['category']).'</span>
          </a>
        </li>
        ';
      }
    }

    echo json_encode($outPut);
  }

  if ($_GET['escorts']) {
    $slug = $_GET['escorts'];
    $outPut = '';

    if (Ajax::getAllEscortsBySlug($slug)) {
      foreach (Ajax::getAllEscortsBySlug($slug) as $key) {
        $outPut .= '<div class="col-sm-4 col-xl-3">
          <div class="card overflow-hidden rounded-2" style="width:250px">
            <div class="position-relative">
              <a href="escort-profile?esc='.$key['entity_guid'].'&sg='.$slug.'">';
                if($key['gender'] == 'male' && empty($key['profile_image']) || $_SESSION['token'] == 0): 
                  $image = 'assets/images/products/no-img-men.jpg';
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;filter: blur(15px); -webkit-filter: blur(15px);">';
                elseif ($key['gender'] == 'female' && empty($key['profile_image']) || $_SESSION['token'] == 0) :
                  $image = 'assets/images/products/no-img-women.jpg';
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;filter: blur(15px); -webkit-filter: blur(15px);">';
                elseif ($key['profile_image'] > 0 || $_SESSION['token'] == 0) :
                  $image = $key['profile_image'];
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;filter: blur(15px); -webkit-filter: blur(15px);">';
                elseif ($key['profile_image'] > 0 && $_SESSION['token'] > 0 && Ajax::checkActiveSubscriber($_SESSION['token']) == true) :
                  $image = $key['profile_image'];
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;">';
                endif;
              $outPut .= '</a>
              <a class="bg-primary rounded-circle p-2 text-white d-inline-flex position-absolute bottom-0 end-0 mb-n3 me-3" data-bs-placement="top" data-bs-title="Book" style="cursor:pointer" onclick=bookEscort(`'.$key['entity_guid'].'`)>book<i class=" fs-4"></i>
              </a>               
            </div>
            <div class="card-body pt-3 p-4">
              <h6 class="fw-semibold fs-4">'.$key['username'].'</h6>
              <div class="d-flex align-items-center justify-content-between">
                <h6 class="fw-semibold fs-4 mb-0">$'.$key['prices'].'/<span>'.$key['period_prices'].'</span></h6>
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
        </div>';
      }
    }

    echo json_encode($outPut);
  }

  // //   //get escort profile
  if ($_GET['esc']) {
      $token = $_GET['esc'];
      $outPut = '';

      if (Ajax::getEscortById($token)) { //echo $_SESSION['token'];exit;
        foreach (Ajax::getEscortById($token) as $key) { //var_dump(Ajax::checkActiveSubscriber($_SESSION['token']));exit;
          $outPut .= '
            <div class="col-md-12 mb-3">';
              if (Ajax::checkActiveSubscriber($_SESSION['token']) == true):
                $outPut .= '<img src="assets/images/products/no-img-men.jpg" class="card-img-top rounded-0" alt="..." style="width:550px;height:450px">';
              elseif (Ajax::checkActiveSubscriber($_SESSION['token']) == false) :
                $outPut .= '
                  <p class=" text-danger mb-5 text-center text-bold"><marquee behavior="" direction="">Kindly subscribe to view <strong>'.ucwords($key['username']).'</strong> pictures. <a class="text-pramry" style="cursor:pointer;" onclick="subscribe(`'.$_SESSION['token'].'`)">Subscribe here</a></marquee></p>
                  <img src="assets/images/products/no-img-men.jpg" class="card-img-top rounded-0 mb-4" alt="..." style="width:550px;height:450px;filter: blur(30px); -webkit-filter: blur(30px);">
                ';
              endif;
            $outPut .= '</div>
            <div class="col-md-6">
              <label>Username</label>
              <input type="text" class="form-control mb-3" disabled value="'.ucwords($key['username']).'">
            </div>
            <div class="col-md-6">
              <label>Age</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['age'].'">
            </div>
            <div class="col-md-6">
              <label>Gender</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['gender'].'">
            </div>
             <div class="col-md-6">
              <label>Price/'.ucwords($key['period_prices']).'</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['prices'].'">
            </div>
            <div class="col-md-6">
              <label>Weight</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['weight'].'">
            </div>
            <div class="col-md-6">
              <label>Height</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['height'].'">
            </div>
            <div class="col-md-6">
              <label>Ethnicity</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['ethnicity'].'">
            </div>
            <div class="col-md-6">
              <label>Hair Lenght</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['hair_long'].'">
            </div>
            <div class="col-md-6">
              <label>Hair Color</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['hair_color'].'">
            </div>
            <div class="col-md-6">
              <label>Bust</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['bust_size'].'">
            </div>
            <div class="col-md-6">
              <label>Smoker</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['smoker'].'">
            </div>
            <div class="col-md-6">
              <label>Alcohol</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['alcohol'].'">
            </div>
            <div class="col-md-6">
              <label>Build</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['build'].'">
            </div>
            <div class="col-md-6">
              <label>Sexual Orientation</label>
              <input type="text" class="form-control mb-3" disabled value="'.$key['sexual_orientation'].'">
            </div>
            <div class="col-md-12">
              <label>Bio</label>
              <textarea class="form-control mb-3" disabled>'.$key['comments'].'</textarea>
            </div>
            <div class=" d-flex"><button class=" btn btn-warning" style="margin-right: 20px;">Cancel</button>';
            if (Ajax::checkActiveSubscriber($_SESSION['token']) == false) :
              $outPut .= '<button type="button" onclick="subscribe(`'.$_SESSION['token'].'`)" class="btn btn-primary">Subscribe to book escort</button></div>';
            else :
              $outPut .= '<button type="button" onclick="book(`'.$key['entity_guid'].'`)" class="btn btn-success">Book Now</button></div>';
            endif;
          
        }
      }

      echo json_encode($outPut);
  }

  if ($_GET['esc_book']) {
    $token = $_GET['esc_book'];
    $slug = $_GET['slug'];
    $outPut = '';

    if (Ajax::getEscortById($token)) {
      foreach (Ajax::getEscortById($token) as $key) {
        $outPut .= '
        <form action="" class="form-group" id="bookEscortPaymentForm">
          <label for="date">Date <span class="text-danger">*</span></label>
          <input type="date" class="form-control mb-3" id="date">
          <label for="time">Time <span class="text-danger">*</span></label>
          <input type="time" class="form-control mb-3" id="time">
          <label for="phone_number">Active Phone Number <span class="text-danger">*</span></label>
          <input type="number" class="form-control mb-3" id="phone_number">
          <label for="price">Price</label>
          <input type="text" class="form-control mb-3" value="'.$key['prices'].'" disabled id="price">
          <input type="hidden" class="form-control mb-3" value="'.$key['email'].'" id="email-address">
          <input type="hidden" class="form-control mb-3" value="'.$_SESSION['token'].'" id="escort">
          <input type="hidden" class="form-control mb-3" value="'.$token.'" id="escortee">
          <input type="hidden" class="form-control mb-3" value="'.$slug.'" id="slug">
          <input type="hidden" value="'.DataBase::invoiceCode().'" id="invoice">
          <label for="location">Meetup Location <span class="text-danger">*</span></label>
          <input type="text" class="form-control mb-3" id="location">
          <label for="note">Any message for your escort?</label>
          <textarea class="form-control mb-3" id="note" placeholder="Any message for your escort? Drop it here"></textarea>
          <div class="modal-footer">
            <button type="button" onclick="SquadPay()" class="btn btn-success" id="bookEscortPaymentButton">Pay</button>
          </div>
        </form>
        ';
      }
    }

    echo json_encode($outPut);
  }

  if ($_GET['cat']) {
    $outPut = '';

    if (Ajax::getSideBarLists()) {
      $outPut .= '<option value="">Select category</option>';
      foreach (Ajax::getSideBarLists() as $key) {
        $outPut .= '<option value="'.$key['token_guid'].'">'.$key['category'].'</option>';
      }
    }

    echo json_encode($outPut);
  }

  if ($_GET['req_vw']) {
    $token = $_GET['req_vw'];//exit;
    $outPut = '';
    // var_dump(Ajax::getAllEscortRequest($token));exit;

    if (Ajax::getAllEscortRequest($token)) {
      $outPut .= '<table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">S/N</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Name</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Service</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Comment</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Date</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">status</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">View</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>';
                    foreach (Ajax::getAllEscortRequest($token) as $key) {
                      $count = 1;
                      $outPut .= '
                      <tr>
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">'.$count++.'</h6></td>
                        <td class="border-bottom-0">  
                            <h6 class="fw-semibold mb-0 fs-4">'.ucwords($key['name']).'</h6>                         
                        </td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0 fs-4">'.ucwords($key['category']).'</h6>
                        </td>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">'.ucfirst($key['request_comments']).'</p>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">'.Database::dateFormat($key['created_at']).'</h6>
                        </td>
                        <td class="border-bottom-0">
                          <select name="" id="" class="form-control">
                            <option value="">'.ucfirst($key['request_status']).'</option>
                          </select>
                        </td>
                        <td class="border-bottom-0">
                          <div class="d-flex">
                            <a data-id="`" class="ti ti-pencil text-warning view_request" style="padding-right: 6px; font-size:18px;" onclick=viewRequest(`'.$key['entity'].'`)></a>
                            <a class="ti ti-article text-success" style="font-size:18px;"></a>
                        </div>
                        </td>
                      </tr>'; 
                    }                 
                    $outPut .= '</tbody>
                  </table>';
      
    }

    echo json_encode($outPut);
  }

  if ($_GET['view_req']) {
    $token = $_GET['view_req'];
    $outPut = '';

    if (Ajax::getRequestById($token)) {
      foreach (Ajax::getRequestById($token) as $key) {
        $outPut .= '
        <form action="" class="form-group" id="acceptForm">
          <label>Name</label>
          <input type="text" class="form-control mb-3" id="date" value="'.$key['name'].'" disabled>
          <label>Service</label>
          <input type="text" class="form-control mb-3" id="time" value="'.$key['category'].'" disabled>
          <label>Click the box to Accept/Decline the service</label>
          <select name="" id="request_status" class="form-control mb-3">
            <option value="'.$key['request_status'].'">'.ucfirst($key['request_status']).'</option>
            <option value="accept">Accept</option>
            <option value="decline">Decline</option>
          </select>
          <label for="start">Service Start At</label>
          <input type="text" class="form-control mb-3" value="'.Database::time($key['service_time_start']).'" id="start" disabled>
          <label for="end">Service End At</label>
          <input type="text" class="form-control mb-3" value="'.Database::time($key['service_time_end']).'" id="end" disabled>
          <input type="hidden" class="form-control mb-3" value="'.$key['escorter'].'" name="escortr" disabled>
          <input type="hidden" class="form-control mb-3" value="'.$key['escortee'].'" name="escortee" disabled>';
          if($key['request_comments']):
          $outPut .= ' <label for="req_com">Note</label>
          <textarea class="form-control mb-3" id="req_com" value="'.$key['request_comments'].'" disabled>'.$key['request_comments'].'</textarea>';
          endif;
          $outPut .= '<label for="comment">Do you have any request for your meet-up? Feel free to tell the person here</label>
          <textarea class="form-control mb-3" id="comment" placeholder="Your request here"></textarea>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="send-request">Send</button>
          </div>
        </form>
        ';
      }
    }

    echo json_encode($outPut);
  }

  // //Get all Sex Videos
  if ($_GET['svd']) {
    // $slug = $_GET['escorts'];
    $outPut = '';

    if (Ajax::getAllSexVideos()) {
      foreach (Ajax::getAllSexVideos() as $key) {
        if ($key['img']) {
          $outPut .= '<div class="col-sm-6 col-xl-3">
            <div class=" overflow-hidden rounded-2">
              <div class="position-relative" id="testing">
                <a href="video.php?ent='.$key['entity_guid'].'" class="align-middle">
                  <img src="'.$key['img'].'" data-img="'.$key['img'].'" data-gif="'.$key['gif'].'" class="show-not align-middle sex__change" onmouseover="changein(`'.str_replace('../', '', $key['gif']).'`)" onmouseout="changeout(`'.str_replace('../', '', $key['img']).'`)" alt="" width="560" height="170">
                  <h6 class=" text-capitalize text-center d-inline-block text-truncate pt-1" title="'.$key['title'].'">'.$key['title'].'</h6>
                </a>
              </div>
            </div>
          </div>';
        }
      }
    }else {
      $outPut = '<h6 class="text-danger mt-5">XXvideos not available at the moment</h6>';
    }

      echo json_encode($outPut);
  }

  // //Sex Video Show
  if ($_GET['ent']) {
    $slug = $_GET['ent'];
    $outPut = '';

    if (Ajax::getSingleSexVideos($slug)) {
      foreach (Ajax::getSingleSexVideos($slug) as $key) {
        if ($key['porn_video']) {
          $outPut .= '<div id="carouselExampleSlidesOnly" class="sex-videos-related" data-id="`'.$key['user_id'].'`" data-cat="`'.$key['sex_cat_id'].'`">
            <div class="">
              <div class="">
                <video src="'.str_replace('../','',$key['porn_video']).'" style="height: 450px;"        class="d-block w-100 rounded-2" controls></video>
              </div>
            </div>
          </div>';
        }
      }
    }

      echo json_encode($outPut);
  }

  // if ($_GET['rel'] && $_GET['cat']) {
  //   $slug = $_GET['rel'];
  //   $cat = $_GET['cat'];
  //   $outPut = '';

  //   if (Ajax::getRelatedSexVideos($slug, $cat)) {
  //     foreach (Ajax::getRelatedSexVideos($slug, $cat) as $key) {
  //       if ($key['img']) {
  //         $outPut .= '<div class="col-sm-6 col-xl-3">
  //           <div class=" overflow-hidden rounded-2">
  //             <div class="position-relative" id="testing">
  //             <a href="video.php?ent='.$key['entity_guid'].'" class="align-middle">
  //               <img src="'.$key['img'].'" data-img="'.$key['img'].'" data-gif="'.$key['gif'].'" class="show-not align-middle sex__change" onmouseover="changein(`'.str_replace('../', '', $key['gif']).'`)" onmouseout="changeout(`'.str_replace('../', '', $key['img']).'`)" alt="" width="560" height="170">
  //               <h5 class=" text-capitalize text-center">'.$key['title'].'</h5>
  //             </a>
  //             </div>
  //           </div>
  //         </div>';
  //       }
  //     }
  //   }

  //     echo json_encode($outPut);
  // }

  // // Suger mummy category
  if ($_GET['con'] && $_GET['gender']) {
    $con = $_GET['con'];
    $gender = $_GET['gender'];
    $outPut = '';

    $outPut .= '<option value="">Select category</option>';
    if ($con == 's_mummy' && $gender == 'female') {
      $outPut .= '<option value="sugar_boy">Sugar Boy</option>';
    }elseif ($con == 'none' && $gender == 'female') {
      $outPut .= '<option value="sugar_daddy">Sugar Daddy</option>';
    }elseif ($con == 's_daddy' && $gender == 'male') {
      $outPut .= '<option value="sugar_girl">Sugar Girl</option>';
    }elseif ($con == 'none' && $gender == 'male') {
      $outPut .= '<option value="sugar_mummy">Sugar Mummy</option>';
    }

    echo json_encode($outPut);
  }

  // get sex cat on upload
  if ($_GET['built_cat']) {
    $token = $_GET['built_cat'];
    $outPut = '';

    if (Ajax::getSexVideosCategory()) {
      foreach (Ajax::getSexVideosCategory() as $key) {
        $outPut .= '
          <option value="">Choose Option</option>
          <option value="'.$key['identity_guid'].'">'.$key['sex_category'].'</option>
        ';
      }
    }

    echo json_encode($outPut);
  }

  if (isset($_GET['sub'])) {
    $sub = $_GET['sub'];
    $outPut = '';

    if (Ajax::getSubscriptionPlans()) {
      $outPut .= '
        <input type="hidden" class="form-control mb-3" name="arial_token" id="arial_token" value="'.$sub.'">
        <input type="hidden" class="form-control mb-3" name="invoice" id="invoice" value="'.Database::invoiceCode().'">
        <input type="hidden" class="form-control mb-3" name="email-address" id="email-address" value="'.$_SESSION['email'].'">
        <select name="plan" id="selectPlan" class="form-control mb-3" onchange=selectplan()>
          <option value="">Select a plan</option>';
          foreach (Ajax::getSubscriptionPlans() as $key) {
            $outPut .= '<option value="'.$key['plan_guid'].'">'.ucfirst($key['plan']).' &#8358;'.$key['price'].' for '.$key['duration'].'Days</option>';
          }
        $outPut .= '</select>
        <div class="form-group" id="price_div"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" onclick="SquadPaySUb()" id="subscription_button">Subscribe Now</button>
        </div>
      ';
    }

    echo json_encode($outPut);
  }

  if (isset($_GET['plan_price'])) {
    $id = $_GET['plan_price'];
    $outPut = '';

    if (Ajax::getSingleSubscriptionPlans($id)) {
      foreach (Ajax::getSingleSubscriptionPlans($id) as $key) {
        $outPut .= '<input type="hidden" class="form-control mb-3" name="price" id="plan_price" value="'.$key['price'].'">';
      }
      
    }

    echo json_encode($outPut);
  }

  if (isset($_GET['get_sugar'])) { echo "jkj";exit;
    echo $slug = $_SESSION['token'];exit;
    echo $gender = $_SESSION['gender'];exit;
    $outPut = '';
    var_dump(Ajax::getAllSugarConnectBySlug($slug, $gender));exit;

    if (Ajax::getAllSugarConnectBySlug($slug, $gender)) {
      foreach (Ajax::getAllSugarConnectBySlug($slug, $gender) as $key) {
        $outPut .= '<div class="col-sm-4 col-xl-3">
          <div class="card overflow-hidden rounded-2" style="width:250px">
            <div class="position-relative">
              <a href="escort-profile?esc='.$key['entity_guid'].'&sg='.$slug.'">';
                if($key['gender'] == 'male' && empty($key['upload_file']) || $_SESSION['token'] == 0): 
                  $image = 'assets/images/products/no-img-men.jpg';
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;filter: blur(15px); -webkit-filter: blur(15px);">';
                elseif ($key['gender'] == 'female' && empty($key['upload_file']) || $_SESSION['token'] == 0) :
                  $image = 'assets/images/products/no-img-women.jpg';
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;filter: blur(15px); -webkit-filter: blur(15px);">';
                elseif ($key['upload_file'] > 0 || $_SESSION['token'] == 0) :
                  $image = $key['upload_file'];
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;filter: blur(15px); -webkit-filter: blur(15px);">';
                elseif ($key['upload_file'] > 0 && $_SESSION['token'] > 0 && Ajax::checkActiveSubscriber($_SESSION['token']) == true) :
                  $image = $key['upload_file'];
                  // $image->blurImage(5,3);
                $outPut .='<img src="'.$image.'" class="card-img-top rounded-0" alt="..." style="width:250px;height:250px;">';
                endif;
              $outPut .= '</div>
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">'.$key['username'].'</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-semibold fs-4 mb-0">$'.$key['location'].'</h6>
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
        </div>';
      }
    }else {
      $outPut = '<h6 class="text-danger mt-5">XXvideos not available at the moment</h6>';
    }

    echo json_encode($outPut);
  }

  if (isset($_GET['task'])) {
    $token = $_GET['task'];
    $outPut = '';

    if (Ajax::getMyTasks($token)) {
      $count = 0;
      foreach (Ajax::getMyTasks($token) as $key) {
        $outPut = '
          <tr>
            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">'.$count++.'</h6></td>
            <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1">'.$key['username']?$key['username']:$key['name'].'</h6>
                <span class="fw-normal">'.$key['contact_number'].'</span>                       
            </td>
            <td class="border-bottom-0">
              <p class="mb-0 fw-normal">'.$key['location'].'</p>
            </td>
            <td class="border-bottom-0">
              <h6 class="fw-semibold mb-0 fs-4">'.Database::dateFormat($key['escortee_date']).'</h6>
            </td>
            <td class="border-bottom-0">
              <h6 class="fw-semibold mb-0 fs-4">'.Database::time($key['escortee_time']).'</h6>
            </td>
            <td class="border-bottom-0">
              <h6 class="fw-semibold mb-0 fs-4">'.$key['order_status'].'</h6>
            </td>
            <td class="border-bottom-0">
              <h6 class="fw-semibold mb-0 fs-4">'.$key['location'].'</h6>
            </td>
            <td class="border-bottom-0">
              <a class="fw-semibold mb-0 fs-4 ti ti-eye task-view" onclick="viewTask('.$key['order_entity'].')"></a>
              <a class="fw-semibold mb-0 fs-4 ti ti-pencil task-edit" onclick="editTask('.$key['order_entity'].')"></a>
            </td>
          </tr> 
        ';
      }
    }
  }