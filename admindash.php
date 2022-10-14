<?php
session_start();
// $data_array = $_SESSION['data'];
// if (!$data_array['role'] == 'admin' && !$data_array['id'] == 1) {
//     header("location: index.php");
// }
// print_r($data_array);
if(isset($_SESSION['data']['id'])){
    if($_SESSION['data']['role']=='user'){
        header("location: userdash.php");
    }
}
include('header.php');
// exit;
?>
<div class="container">
    <h1>Welcome to Admin pannel</h1>
    <table class="table table-bordered table-striped">
        <hr>
        <h3 style="text-align: center;">Registered Users</h3>
        <hr>
        <tr>
            <th>Sr No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Register Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $i = 1;
        $sql = mysqli_query($conn, "select * from users");
        while ($row = mysqli_fetch_assoc($sql)) {
        ?>
            <tr id="<?php echo $row['id'] ?>">
                <td><?php echo $i;
                    $i++; ?></td>
                <td data-column="name"><?php echo $row['name']; ?></td>
                <td data-column="email"><?php echo $row['email']; ?></td>
                <td data-column="password"><?php echo $row['password']; ?></td>
                <td data-column="date"><?php echo $row['register_date']; ?></td>
                <td><button class="btn btn-warning user_edit" data-bs-toggle="modal" data-bs-target="#myModal" id="edit" type="submit">Edit</button>

                </td>
                <td>
                    <a href="delete.php?id=<?php echo $row['id'] ?>"><button class="btn btn-danger delete_users" user-id="<?php echo $row['id'] ?>" type="submit">Delete</button></a>
                </td>
            </tr>
        <?php
        }
        ?>
        <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
</div>