<?php
session_start();
include('header.php');
if(isset($_SESSION['data']['id'])){
    if($_SESSION['data']['role']=='user'){
        header("location: userdash.php");
    }
    if($_SESSION['data']['role']=='admin'){
        header("location: admindash.php");
    }
}
// print_r($_SESSION['data']);
?>
<div class="container" style="width: 500px;">
    <form class="mt-5 center" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
        <h3 style="text-align: center;">User Registration</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" name="cpassword" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Upload Image</label>
            <input type="file" name="fileToUpload" accept="image/*" name="uimage" id="fileToUpload" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="adminlogin.php"><button class="btn btn-danger mt-5">Admin login</button></a>
</div>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // echo $date;
    $image = $_FILES['fileToUpload'];

    $filename = $_FILES['fileToUpload']['name'];

    $exist = "select * from users where email ='$email'";
    $query2 = mysqli_query($conn, $exist);
    if ($query2->num_rows == 0) {
        
        if ($password == $cpassword) {
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "image/" . $filename);
            $sql = "INSERT INTO `users` (`name`, `email`, `password`, `image`, `utype`) VALUES ('$name', '$email', '$password','$filename', 'user')";
            $query = mysqli_query($conn, $sql);
            if ($query) {
?>
                <script>
                    alert("Registration Done");
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("not register");
                </script>
        <?php
            }
        } else {
            echo "password not matched";
        }
    } else {
        ?>
        <script>
            alert("Email Already Exist");
        </script>
<?php
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>