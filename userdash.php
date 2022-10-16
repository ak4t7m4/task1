<?php
include('header.php');
session_start();
if(!isset($_SESSION['data']['id'])){
    header("location: index.php");
}
$uid = $_SESSION['data']['id'];
$sql = "select * from users where id = '$uid'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($query);
?>
<div class="container">

    <h2>This is user dashboard Mr <?php echo $row['name'] ?></h2>
    <a href="ulogout.php"><button class="btn btn-danger mt-5" type="submit">Logout</button></a>
    <a href="profile.php"><button class="btn btn-success mt-5" type="submit">Profile</button></a>
</div>