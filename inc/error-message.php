<?php
    // require "libs/process.php";
    
    if (isset($errors)) {
        foreach ($errors as $error) {
            echo "<li class='alert alert-danger list-unstyled  text-center'>".$error."</li>";
        }
    }

?>

<script>
    setInterval(() => {
        $('.alert-danger').hide();
    }, 2000);
</script>