<?php
  if(isset($_GET['guid'])){$guid = $_GET['guid'];}
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Connect With Sugar
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
            echo '<strong>&#8358;50,000</strong>';
          }elseif ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 'none') {
            echo '<strong>&#8358;35,000</strong>';
          }elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 's_daddy') {
            echo '<strong>&#8358;50,000</strong>';
          }elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 'none') {
            echo '<strong>&#8358;35,000</strong>';
          }
          ?>
          for connection fee.
        </p>
        <div class="row escort_profile">
            <form action=""method="POST" id="request_sugar">
              <div class="mb-3">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_danger"></li>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="age">Age</label>
                  <input type="number" class="form-control mb-3" name="age" id="age">
                </div>
                <input type="hidden" class="form-control mb-3" name="token" value="<?=$_SESSION['token']?>">
                <input type="hidden" class="form-control mb-3" name="invoice" id="invoice" value="<?=Database::invoiceCode();?>">
                <input type="hidden" class="form-control mb-3" name="email"  id="email" value="<?=$_SESSION['email']?>">
                <input type="hidden" class="form-control mb-3" name="guid"  id="email" value="<?=$guid?>">
                <?php if($_SESSION['gender'] == 'female'): ?>
                  <input type="hidden" class="form-control mb-3" name="gender" value="female">
                <?php else : ?>
                  <input type="hidden" class="form-control mb-3" name="gender" value="male">
                <?php endif; ?>
                <div class="col-md-6">
                  <label for="weight">Weight</label>
                  <input type="number" class="form-control mb-3" name="weight" id="weight">
                </div>
                <div class="col-md-6">
                  <label for="height">Height</label>
                  <input type="number" class="form-control mb-3" name="height" id="height">
                </div>
                <div class="col-md-6">
                  <label for="business">Your Business Type</label>
                  <input type="text" class="form-control mb-3" name="business" id="business">
                </div>
                <div class="col-md-6">
                  <label for="ethnicity">Ethnicity</label>
                  <input type="text" class="form-control mb-3" name="ethnicity" id="ethnicity">
                </div>
                <?php if ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 's_mummy') : ?>
                  <input type="hidden" class="form-control mb-3" name="service_charge" value="50000" id="service_charge">
                <?php elseif ($_SESSION['gender'] == 'female' && $_SESSION['connect'] == 'none') : ?>
                  <input type="hidden" class="form-control mb-3" name="service_charge" value="35000" id="service_charge">
                <?php elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 's_daddy') : ?>
                  <input type="hidden" class="form-control mb-3" name="service_charge" value="50000" id="service_charge">
                <?php elseif ($_SESSION['gender'] == 'male' && $_SESSION['connect'] == 'none') : ?>
                  <input type="hidden" class="form-control mb-3" name="service_charge" value="35000" id="service_charge">
                <?php endif; ?>
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
                  <label for="complex">Complexion</label>
                  <select name="complexion" id="complex" class="form-control mb-3">
                    <option value="">Select Complexion</option>
                    <option value="black_skin">Black Skin</option>
                    <option value="light_skin">Light Skin</option>
                    <option value="chocolate_skin">Chocolate Skin</option>
                  </select>
                </div>
                <div class="col-md-12" id="com_div">
                  <label for="communication">Means of Communication</label>
                  <select name="communication" id="communication" class="form-control mb-3">
                    <option value="">Means of Communication</option>
                    <option value="phone">Phone call</option>
                    <option value="whatsapp">WhatsApp</option>
                    <option value="email">Email</option>
                  </select>
                </div>
                <div class="col-md-6" style="display: none;" id="div-input1">
                  <label for="calling_number">Calling Number</label>
                  <input type="text" class="form-control mb-3" name="calling_number" id="calling_number"  placeholder="+23488888888888">
                </div>
                <div class="col-md-6" style="display: none;" id="div-input2">
                  <label for="whatsapp_number">WhatsApp Number</label>
                  <input type="text" class="form-control mb-3" name="whatsapp_number" id="whatsapp_number" placeholder="+23488888888888">
                </div>
                <div class="col-md-6" style="display: none;" id="div-input3">
                  <label for="email_address">Email Address</label>
                  <input type="email" class="form-control mb-3" name="email_address" id="email_address" placeholder="example@gmail.com">
                </div>
                <div class="col-md-6">
                  <label for="location">State</label>
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
                <div class="col-md-6"><button type="submit" class="btn btn-primary p-3" id="post_button">Connect</button></div>
              </div>
            </form>
            <form action="" method="post" style="display: none;">
              <input type="hidden" name="email" id="user_email">
              <input type="hidden" name="service_charged" id="service_charged">
              <input type="hidden" name="trn_invoice" id="trn_invoice">
              <button type="button" id="charges_payment_button" onclick="SquadPay()">pay</button>
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
  });

  const communication = $('#communication');
  communication.change(()=>{
    if (communication.val() == 'phone') {
      $('#com_div').removeClass('col-md-12');
      $('#com_div').addClass('col-md-6');
      $('#div-input2').hide();
      $('#div-input3').hide();
      $('#div-input1').show();
    }else if (communication.val() == 'whatsapp') {
      $('#com_div').removeClass('col-md-12');
      $('#com_div').addClass('col-md-6');
      $('#div-input3').hide();
      $('#div-input1').hide();
      $('#div-input2').show();
    }else if (communication.val() == 'email') {
      $('#com_div').removeClass('col-md-12');
      $('#com_div').addClass('col-md-6');
      $('#div-input1').hide();
      $('#div-input2').hide();
      $('#div-input3').show();
    }else if (communication.val() == '') {
      $('#com_div').removeClass('col-md-6');
      $('#com_div').addClass('col-md-12');
    }
  })

  //upload escort profile
  $('#request_sugar').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $('#user_email').val($('#email').val());
      $('#service_charged').val($('#service_charge').val());
      $('#trn_invoice').val($('#invoice').val());
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=210',
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
              setTimeout(() => {
                $('#reg_success').fadeOut();
                $('#charges_payment_button').click();
              }, 5000);
            }else if(param.error){
              $('#post_button').html('Upload');
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

  // payment
  function SquadPay() {
    // e.preventDefault();
    const key = "<?=KEY?>"
    const squadInstance = new squad({
    onLoad: () => console.log("Widget loaded successfully"),
    key: key,
    // "test_pk_sample-public-key-1"
    //Change key (test_pk_sample-public-key-1) to the key on your Squad Dashboard
    email: document.getElementById("user_email").value,
    amount: document.getElementById("service_charged").value * 100,
    //Enter amount in Naira or Dollar (Base value Kobo/cent already multiplied by 100)
    transaction_ref: 'Inv'+Math.floor((Math.random() * 1000000000) + 1),
    currency_code: "NGN",
    
    onSuccess: function(response){
        // let message = 'Payment complete! Reference: ' + response.transaction_ref ;
        // alert(message);
        const amt = document.getElementById("service_charged").value;
        const trn_invoice = document.getElementById("trn_invoice").value;
        location.href = "verify-request-service?verify="+response.transaction_ref+"&inv="+trn_invoice+"&amt="+amt;
    },
    onClose: () => alert("Transaction Cancelled")
    });
    squadInstance.setup();
    squadInstance.open();

  }
</script>