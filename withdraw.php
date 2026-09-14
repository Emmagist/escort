<?php
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Withdraw Funds</h4>
        <div class="row escort_profile">
            <form action=""method="POST" id="withdraw_fund">
              <div class="mb-3 col-md-8">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_danger"></li>
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <label for="age">Amount</label>
                  <input type="number" class="form-control mb-3" name="amount" id="age" placeholder="Amount">
                </div>
                <input type="hidden" class="form-control mb-3" name="token" value="<?=$_SESSION['token']?>">
                <!-- <div class="col-md-12">
                  <label for="currency">Bank Name</label>
                  <select name="currency" id="currency" class="form-control mb-3">
                    <option value="">Select Bank</option>
                    <option value="ngn">NGN</option>
                    <option value="usd">USD</option>
                  </select>
                </div> -->
                <div class="col-md-12">
                  <label for="weight">Bank Name</label>
                  <input type="text" class="form-control mb-3" name="bank_name" id="weight" placeholder="Bank Name">
                </div>
                <div class="col-md-12">
                  <label for="height">Account Number</label>
                  <input type="number" class="form-control mb-3" name="acc_number" id="height" placeholder="Account Number">
                </div>
                <div class="col-md-12">
                  <label for="height">Account Name</label>
                  <input type="text" class="form-control mb-3" name="acc_name" id="height" placeholder="Account Name">
                </div>
                <div class="col-md-6"><button type="submit" class="btn btn-success p-3" id="post_button">Withdraw Fund</button></div>
              </div>
            </form>
        </div>
<?php 
  // else : echo "Sorry you do not have right access to this page";
  // endif;
  require "inc/footer.php";
?>

<script>

  //upload escort profile
  $('#withdraw_fund').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=215',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#post_button').html('Withdrawing...');
          },
          success: (param) => {
            if (param.success) {
              $('#post_button').html('Withdrawal Initiated');
              $('#reg_success').fadeIn()
              $('#reg_success').text(param.success);
              setTimeout(() => {
                $('#reg_success').fadeOut();
                location.reload();
              }, 4000);
            }else if(param.error){
              $('#post_button').html('Withdraw Fund');
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
</script>