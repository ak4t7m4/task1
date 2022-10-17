<?php
session_start();
include('header.php');
    if(!$_SESSION['data']['role']=='admin'){
        header("location: index.php");
    }
    if(!isset($_GET['id'])){
        header("location: admindash.php");
    }
$uid = $_GET['id'];
$sql = "select * from users where id = '$uid'";
$data = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($data);
// print_r($_SESSION['data']);
?>
<div class="container" style="width: 500px;">
    <form class="mt-5 center" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
        <h3 style="text-align: center;"> Update User Details</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="text" value="<?php echo $row['password'] ?>" name="password" class="form-control" required>
        </div>
     

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
if(isset($_POST['submit'])){
    extract($_POST);
    $sql1 = "update users set name = '$name', password = '$password', email= '$email' where id ='$uid'";
    $query = mysqli_query($conn, $sql1);
    if($query){
        ?>
        <script>
            alert("Details updated");
            location.replace("admindash.php");
        </script>
<?php
    }else{
        ?>
        <script>
            alert("Details not updated");
            location.replace("admindash.php");
        </script>
<?php
    }
}


?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>