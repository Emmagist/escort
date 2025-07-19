<?php
    require "inc/auth.php";
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
        <h4 class="form-title mb-4">Sugar Profile</h4>
        <div class="row escort_profile" id="escort_profile" data-id="<?=$token?>" data-slug="<?=$slug?>">
            
        </div>

        <?php 
  // require "modal/modal.php";
  require "inc/footer.php";
?>

<script>
    
    $(document).ready(function(event) {//alert('hey')
        // event.preventDefault(); 
        const token = $('#escort_profile').attr('data-id'); //alert(token);
        
        $.ajax({
            url: 'controllers/ajaxGet.php?sug_pro='+token,
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
        location.href = "sugar-connect?guid="+params+"&slug="+slug;
    }
</script>