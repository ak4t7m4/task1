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
?>
<div class="container" style="width: 500px;">
    <form class="mt-5 center" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <h3 style="text-align: center;">User Login</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    <h5>I'm not member</h5> <a href="register.php"><button class="btn btn-dark">Register</button></a>
    <a href="adminlogin.php"><button type="button" class="btn btn-danger mt-5">Admin login</button></a>
</div>
<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from users where email = '$email'";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        $row = mysqli_fetch_assoc($query);
        $db_password = $row['password'];
        $db_status = $row['utype'];
        // print_r($row);
        // exit;
        if ($password == $db_password && $db_status == 'user') {
?>
            <script>
                alert("Login successfull");
                location.replace("userdash.php");
            </script>
        <?php
            session_start();
            $_SESSION["data"] = array(
                'id' => $row['id'],
                'role' => $row['utype'],
            );
            // $_SESSION['role'] = $row['utype'];
        } else {
        ?>
            <script>
                alert("Password not match");
            </script>
<?php
        }
    }
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>