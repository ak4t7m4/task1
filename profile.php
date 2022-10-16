<?php
include('header.php');
session_start();
if(isset($_SESSION)){
    if($_SESSION['data']['role']=='admin'){
        header('location: admindash.php');
    }else{
        $uid = $_SESSION['data']['id'];
    }
}
if(!isset($_SESSION['data']['role'])=='user'){
    header('location: index.php');
}
$sql = "select * from users where id = '$uid'";
$query = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($query);
?>

    <div class="container">
        <div class="row" style="width: 500px; margin-left: 300px;">
            <form class="mt-5 center" method="POST">
                <h3 style="text-align: center;">User Profile</h3>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">profile pic</label>
                   <img src="<?php echo "image/".$row['image'];?>" alt="image" width="100px">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email"  value="<?php echo $row['email'] ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password"  value="<?php echo $row['password'] ?>" class="form-control" >
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"> User Type</label>
                    <input type="text" name="cpassword" value="<?php echo $row['utype'] ?>" class="form-control" >
                </div>
               

                <button type="button" name="submit" class="btn btn-primary">Update</button>
                <button class="btn btn-danger" type="button" onclick="goback()">Back</button>
            </form>
        </div>
    </div>
<script>
    function goback(){
        window.location = "userdash.php";
    }
</script>
<?php

?>
</body>

</html>