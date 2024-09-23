<?php
    if (isset($_GET['esc']) && isset($_GET['sg'])) {
        $token = $_GET['esc'];
        $slug = $_GET['sg'];
    }
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Escort Profile</h4>
        <div class="row escort_profile" id="escort_profile" data-id="<?=$token?>" data-slug="<?=$slug?>">
            
        </div>
        <form action="" method="post" class="form-group" id="orderForm" style="display: none;">
          <input type="hidden" class="form-control mb-3" disabled name="escotee_date" id="escotee_date">
          <input type="hidden" class="form-control mb-3" disabled name="escotee_time" id="escotee_time">
          <input type="hidden" class="form-control mb-3" disabled name="price" id="esc_price">
          <input type="hidden" class="form-control mb-3" name="escort" id="escort_id">
          <input type="hidden" class="form-control mb-3" name="escortee" id="escortee_id">
          <input type="hidden" class="form-control mb-3" name="page" id="page">
          <input type="hidden" name="invoice" id="ref_invoice">
          <button type="submit" class="btn btn-success" id="paymentButton"></button>
        </form>
<?php 
  // require "modal/modal.php";
  require "inc/footer.php";
?>
<script src="https://checkout.squadco.com/widget/squad.min.js"></script>

<script>
    $(document).ready(function(event) {//alert('hey')
        // event.preventDefault(); 
        $.ajax({
            url: 'controllers/ajaxGet.php?escorts=121',
            method: 'GET',
            dataType: 'json',
            data: '121',
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
    
    $(document).ready(function(event) {//alert('hey')
        // event.preventDefault(); 
        const token = $('#escort_profile').attr('data-id'); //alert(token);
        
        $.ajax({
            url: 'controllers/ajaxGet.php?esc='+token,
            method: 'GET',
            dataType: 'json',
            data: token,
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('.escort_profile').html('Loading contents...');
            },
            success: (param) => {
                if (param) {
                    $('.escort_profile').html(param);
                }
            }
        })

    })

    function book(params) {
        const slug = $('#escort_profile').attr('data-slug');
        $('#exampleModal').modal('show');

        $.ajax({
            url: 'controllers/ajaxGet.php?esc_book='+params+'&slug='+slug,
            method: 'GET',
            dataType: 'json',
            data: {params,slug},
            contentType: false,
            processData: false,
            beforeSend: () => {
                $('#modal-body').html('Loading contents...');
            },
            success: (param) => {
                if (param) {
                    $('#modal-body').html(param);
                }
            }
        })
    }

//   const invoice = $('#invoice').val();
//   const amt = $('#price').val();
//   // const key = '<?//=KEY?>';
//   const NairapaymentForm = document.getElementById('bookEscortPaymentForm'); 
//   NairapaymentForm.addEventListener("submit", SquadPay, false);

  function SquadPay() {
    // e.preventDefault();
    const escort = document.getElementById("escort").value;
    const escortee = document.getElementById("escortee").value;
    const trn_invoice = document.getElementById("invoice").value;
    const price = document.getElementById("price").value;
    const date = document.getElementById("date").value;
    const time = document.getElementById("time").value;
    const slug = document.getElementById("slug").value;
    passable(date,time,escort,escortee,trn_invoice,price,slug);
    const squadInstance = new squad({
    onLoad: () => console.log("Widget loaded successfully"),
    key: 'sandbox_pk_2812061280c862064951d1ace69f69213cbe2d1f2f07',
    // "test_pk_sample-public-key-1"
    //Change key (test_pk_sample-public-key-1) to the key on your Squad Dashboard
    email: document.getElementById("email-address").value,
    amount: document.getElementById("price").value * 100,
    //Enter amount in Naira or Dollar (Base value Kobo/cent already multiplied by 100)
    transaction_ref: 'Inv'+Math.floor((Math.random() * 1000000000) + 1),
    currency_code: "NGN",
    onClose: () => alert("Transaction Cancelled"),
    onSuccess: function(response){
        let message = 'Payment complete! Reference: ' + response.transaction_ref ;
        // alert(message);
        const amt = document.getElementById("price").value;
        location.href = "verify?verify="+response.transaction_ref+'&inv='+invoice+'&amt='+amt+'&pd='+plan_id;
    }
    });
    squadInstance.setup();
    squadInstance.open();

  }

    function passable(date,time,escort,escortee,trn_invoice,price,slug) {
        const escotee_date = $('#escotee_date').val(date);
        const escotee_time = $('#escotee_time').val(time);
        const escort_id = $('#escort_id').val(escort);
        const escortee_id = $('#escortee_id').val(escortee);
        const invoiceGen = $('#ref_invoice').val(trn_invoice);
        const amount_pay = $('#esc_price').val(price);
        const page = $('#page').val(slug);

        if (amount_pay.val() != '' && invoiceGen != '' && escort_id != '' && escortee_id != '' && escotee_date != '' && escotee_time != '') {
            $('#paymentButton').click();
        }
    }

    $('#orderForm').submit( function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: 'controllers/fetchAjax.php?pg=202',
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