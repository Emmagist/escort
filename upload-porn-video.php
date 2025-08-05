<?php
  require "inc/auth.php";
  require "inc/head.php";
  require "inc/aside.php";
  require "inc/header.php";
  //if($_SESSION['role'] == 2):

?>
    
      <!--  Header End -->
      <div class="container-fluid">
        <h4 class="form-title mb-4">Upload Porn Video</h4>
        <div class="row escort_profile">
            <form action=""method="POST" id="upload_porn">
              <div class="mb-3">
                <li class="alert alert-success list-unstyled" style="display: none;" id="reg_success"></li>
                <li class="alert alert-danger list-unstyled" style="display: none;" id="reg_danger"></li>
              </div>
              <div class="row">
              <div class="col-md-6">
                  <label for="category">Category</label>
                  <select name="" class="form-control" id="choose_cat">
                    <option value="">Choose Option</option>
                    <option value="custom">Add my custom category</option>
                    <option value="built_cat">Choose from category</option>
                  </select>
                  <select name="category" class="form-control" id="built_cat" style="display:none"></select>
                  <input type="text" class="form-control mb-3" name="custom_cat" id="custom_cat" style="display:none" placeholder="Add your custom category">
                </div>
                <div class="col-md-6">
                  <label for="title">Title</label>
                  <input type="text" class="form-control mb-3" name="title" id="title">
                </div>
                <input type="hidden" class="form-control mb-3" name="token" value="<?=$_SESSION['token']?>">
                <div class="col-md-6">
                  <label for="hash_tag">Hash Tag</label>
                  <input type="text" class="form-control mb-3" name="hash_tag" id="hash_tag">
                </div>
                <div class="col-md-6">
                  <label for="fileUpload">Upload file</label>
                  <input type="file" class="form-control mb-3" id="fileUpload" name="fileUpload">
                </div>
                <div class="col-md-12">
                  <label for="content">Contents</label>
                  <textarea class="form-control mb-3" placeholder="Contents" name="content" id="content"></textarea>
                </div>
                <div class="col-md-6"><button type="submit" class="btn btn-primary p-3" id="post_button">Upload</button></div>
              </div>
            </form>
        </div>
<?php 
  // else : echo "Sorry you do not have right access to this page";
  // endif;
  require "inc/footer.php";
?>

<script>
  $('#choose_cat').change(function () {
    if($(this).val() == 'custom'){
      $('#custom_cat').show();
      $(this).hide();
    }else if($(this).val() == 'built_cat'){
      $(this).hide();
      $('#custom_cat').hide();
      $('#built_cat').show();
      $.ajax({
      url: 'controllers/ajaxGet.php?built_cat=200',
      method: 'GET',
      dataType: 'json',
      data: '200',
      contentType: false,
      processData: false,
      beforeSend: () => {
          $('#built_cat').html('Loading contents...');
      },
      success: (param) => {
        if (param) {
          $('#built_cat').html(param);
        }
      }
    })
    }
  })
  //upload escort profile
  $('#upload_porn').submit(function () {
      const formData = new FormData(this); //alert(formData);
      $.ajax({
          url: 'controllers/fetchAjax.php?pg=204',
          method: 'POST',
          dataType: 'json',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: () => {
              $('#post_button').html('Uploading...');
          },
          success: (param) => {
            if (param.success) {
              $('#post_button').html('Uploaded');
              $('#reg_success').fadeIn()
              $('#reg_success').text(param.success);
              setInterval(() => {
                $('#reg_success').fadeOut();
                location.reload();
              }, 5000);
            }else if(param.error){
              $('#post_button').html('Upload');
              $('#reg_danger').fadeIn()
              $('#reg_danger').text(param.error);
              setInterval(() => {
                $('#reg_danger').fadeOut();
              }, 5000);
            }
          }
      })
      return false;
  })
</script>