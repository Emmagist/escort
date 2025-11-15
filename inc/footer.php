<div class="py-6 px-6 text-center mt-5">
          <p class="text-center pb-3">Follow Us</p>
          <p class="mb-0 fs-4"><a href="" target="_blank" class="pe-3 text-primary"><i class="fa fa-twitter" style="font-size:32px;"></i></a> <a href="" class="pe-3"><i class="fa fa-telegram" style="font-size:32px;"></i></a><a href="" class="pe-3"><i class="fa fa-instagram" style="font-size:32px;"></i></a>
            
          </ul></p>
        </div>
      </div>

      <form action="" class="form-group" method="post" id="subscription_proc_form" style="display:none;"><input type="hidden" id="arial_sub_token" name="arial_sub_token"><select name="select_sub_plan" id="select_sub_plan"><option value="" id="select_opt"></option></select><input type="hidden" id="price_plan" name="price_plan"><input type="hidden" id="invoice_code" name="invoice_code"><button type="submit" id="subscription_processing"></button></form>
    </div>
    <?php require "modal/modal.php";?>
  </div>
  <script src="assets/src/jquery/dist/jquery.min.js"></script>
  <script src="assets/src/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/src/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/src/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="https://checkout.squadco.com/widget/squad.min.js"></script>

  <script>
    $(document).ready(() => {
      setInterval(() => {
        $('#become_escort').attr('class', 'btn btn-danger');
        setTimeout(() => {
          $('#become_escort').attr('class', 'btn btn-warning');
        }, 2000);
        setTimeout(() => {
          $('#become_escort').attr('class', 'btn btn-secondary');
        }, 3000);
        setTimeout(() => {
          $('#become_escort').attr('class', 'btn btn-success');
        }, 4000);
      }, 1000);
      
    })
    
    function subscribe(params) {
      $('#subscribeModal').modal('show');
      // $('#arial_token').val(params)

      $.ajax({
        url: 'controllers/ajaxGet.php?sub='+params,
        method: 'GET',
        dataType: 'json',
        data: params,
        contentType: false,
        processData: false,
        beforeSend: () => {
            $('#subscribe_contents').html('Loading contents...');
        },
        success: (param) => {
          if (param) {
              $('#subscribe_contents').html(param);
          }
        }
      })
    }

    function selectplan() {
      const value = $('#selectPlan').val();

      $.ajax({
        url: 'controllers/ajaxGet.php?plan_price='+value,
        method: 'GET',
        dataType: 'json',
        data: value,
        contentType: false,
        processData: false,
        success: (param) => {
          if (param) {
              $('#price_div').html(param);
          }
        }
      })
    }

    //Wallet earns
    $(document).ready(function() {
        $.ajax({
            url: 'controllers/ajaxGet.php?ern=200',
            method: 'GET',
            dataType: 'json',
            data: '200',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('#wallet_earn').html('Loading contents...');
            },
            success: (param) => {
                if (param) {
                    $('#wallet_earn').html(param);
                }
            }
        })

    });

    //escort transactions
    $(document).ready(function() {
        $.ajax({
            url: 'controllers/ajaxGet.php?trn=220',
            method: 'GET',
            dataType: 'json',
            data: '220',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('#table-body').html('Loading Transactions...');
            },
            success: (param) => {
                if (param) {
                    $('#table-body').html(param);
                }
            }
        })

    });

    //escort payment received
    $(document).ready(function() {
        $.ajax({
            url: 'controllers/ajaxGet.php?prv=220',
            method: 'GET',
            dataType: 'json',
            data: '220',
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('#timeline').html('Loading Transactions...');
            },
            success: (param) => {
                if (param) {
                    $('#timeline').html(param);
                }
            }
        })

    });

    //Check expired subscription and update user
    $(document).ready(function () {
      $.ajax({
        url: 'controllers/fetchAjax.php?pg=216',
        method: 'POST',
        dataType: 'json',
        data: '216',
        contentType: false,
        processData: false,
        success: (param) => {
          if (param.success) {
            console.log(response.message);
          }
        }
      })
    })

    function SquadPaySUb() {
      // e.preventDefault();
      const key_opener = "<?=KEY?>"; alert(key_opener);
      const arial_token = document.getElementById("arial_token").value;
      const plan_id = document.getElementById("selectPlan").value;
      const price = document.getElementById("plan_price").value;
      const invoice = document.getElementById("invoice").value;
      passage(arial_token,plan_id,price,invoice);
      const squadInstance = new squad({
      onLoad: () => console.log("Widget loaded successfully"),
      key: key_opener,
      // "test_pk_sample-public-key-1"
      //Change key (test_pk_sample-public-key-1) to the key on your Squad Dashboard
      email: document.getElementById("email-address").value,
      amount: price * 100,
      //Enter amount in Naira or Dollar (Base value Kobo/cent already multiplied by 100)
      transaction_ref: 'Inv'+Math.floor((Math.random() * 1000000000) + 1),
      currency_code: "NGN",
      onClose: () => alert("Transaction Cancelled"),
      onSuccess: function(response){
          let message = 'Payment complete! Reference: ' + response.transaction_ref ;
          // alert(message);
          const amt = price;
          location.href = "sub-verify?verify="+response.transaction_ref+'&inv='+invoice+'&amt='+amt+'&pd='+plan_id;
      }
      });
      squadInstance.setup();
      squadInstance.open();

    }

    function passage(arial_token,plan_id,price,invoice) {
      const arial_sub_token = $('#arial_sub_token').val(arial_token);
      const select_opt = $('#select_opt').val(plan_id);
      const price_plan = $('#price_plan').val(price);
      const invoice_code = $('#invoice_code').val(invoice);

      if (arial_sub_token != '' && select_opt != '' && price_plan != '' && invoice_code != '') {
          $('#subscription_processing').click();
      }
    }

    $('#subscription_proc_form').submit( function(event) {
      event.preventDefault();
      const formData = new FormData(this);

      $.ajax({
          url: 'controllers/fetchAjax.php?pg=207',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          success: (props) => {
              
          }
      })

      return false;
    })

  </script>

</body>

</html>