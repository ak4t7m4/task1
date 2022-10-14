<?php
include("dbconn.php");
session_start();
session_destroy();
?>
<script>
    alert("logout successfully");
    location.replace("adminlogin.php");
</script>
<?php
?>