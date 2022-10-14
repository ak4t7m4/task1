<?php
include('db.php');
session_start();
$id= $_GET['id'];
if(!$id){
    header("location: adminlogin.php");
}
mysqli_query($conn, "delete from register where id ='$id'");

?>
<script>
    window.location ="admindash.php";
</script>