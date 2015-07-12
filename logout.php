<?php
session_start();
if(isset($_SESSION['Student_ID'])){
    $_SESSION = array();
    session_destroy();
}
 exit('<script>top.location.href="index.php"</script>');
?>