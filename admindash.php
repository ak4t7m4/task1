<?php
session_start();
// print_r($data_array);
if (isset($_SESSION['data']['id'])) {
    if ($_SESSION['data']['role'] == 'user') {
        header("location: userdash.php");
    }
}
if (!isset($_SESSION['data']['id'])) {
    header("location: index.php");
}
include('header.php');
// exit;
$limit = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$offset = ($page - 1) * $limit;
?>
<div class="container">

    <h3 style="text-align: center;">Welcome to Admin Pannel this is Registered Users</h3>
<!-- Searching data  -->
    <div style="width: 200px; margin-left: 500px;">
        <form class="d-flex" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
            <input class="form-control me-2" type="text" value="<?php if(isset($_GET['search'])) {
                                                                    echo $_GET['search'];
                                                                } ?>" name="search" placeholder="Search">
            <button class="btn btn-outline-secondary" name="search" type="submit">Search</button>
        </form>
        <?php
        if (isset($_GET['search'])) {
            $name = $_GET['search'];
            $sql2 = "select * from users where name like '$name'";
            $result1 = mysqli_query($conn, $sql2);
            if ($result1->num_rows > 0) {
                while ($row = mysqli_fetch_array($result1)) {
        ?>
                    <tr id="<?php echo $row['id'] ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td data-column="name"><?php echo $row['name']; ?></td>
                        <td data-column="email"><?php echo $row['email']; ?></td>
                        <td data-column="password"><?php echo $row['password']; ?></td>
                        <td data-column="date"><?php echo $row['register_date']; ?></td>
                        <td><a href="edit.php?id=<?php echo $row['id'] ?>"><button class="btn btn-warning user_edit" edit-id="<?php echo $row['id'] ?>" type="submit" id="Edit-btn">Edit</button></a>

                        </td>
                        <td>
                            <a href="delete.php?id=<?php echo $row['id'] ?>"><button class="btn btn-danger delete_users" user-id="<?php echo $row['id'] ?>" type="submit">Delete</button></a>
                        </td>
                    </tr>
        <?php
                }
            } else {
                echo "no record found";
            }
        }
        ?>

        <a href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
    </div>
    <hr>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Register Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $i = 1;
        $sql = mysqli_query($conn, "select * from users order by id desc limit {$offset}, {$limit}");
        while ($row = mysqli_fetch_assoc($sql)) {
        ?>
            <tr id="<?php echo $row['id'] ?>">
                <td><?php echo $row['id']; ?></td>
                <td data-column="name"><?php echo $row['name']; ?></td>
                <td data-column="email"><?php echo $row['email']; ?></td>
                <td data-column="password"><?php echo $row['password']; ?></td>
                <td data-column="date"><?php echo $row['register_date']; ?></td>
                <td><a href="edit.php?id=<?php echo $row['id'] ?>"><button class="btn btn-warning user_edit" edit-id="<?php echo $row['id'] ?>" type="submit" id="Edit-btn">Edit</button></a>

                </td>
                <td>
                    <a href="delete.php?id=<?php echo $row['id'] ?>"><button class="btn btn-danger delete_users" user-id="<?php echo $row['id'] ?>" type="submit">Delete</button></a>
                </td>
            </tr>
        <?php
        }
        ?>
        <a style="margin-bottom: 100px;" href="adminadd.php"><button type="button" class="btn btn-success">Add</button></a>
    </table>
</div>
<div style="margin-left:500px ;">

    <?php
    $sql1 = "select * from users";
    $result = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result) > 0) {
        $total_row = mysqli_num_rows($result);

        $total_page = ceil($total_row / $limit);
        echo '<ul class="pagination">';
        if ($page > 1) {
            echo '<li class="page-item"><a class="page-link" href="admindash.php?page=' . ($page - 1) . '">Prev</a></li>';
        }
        for ($i = 1; $i <= $total_page; $i++) {
            if ($i == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            echo '<li class="page-item ' . $active . '"><a class="page-link" href="admindash.php?page=' . $i . '">' . $i . '</a></li> ';
        }
        if ($total_page > $page) {
            echo '<li class="page-item ' . $active . '"><a class="page-link" href="admindash.php?page=' . ($page + 1) . '">Next</a></li>';
        }
        echo '</ul>';
    }

    ?>
</div>
<!-- pop up -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label required">Name</label>
                        <input type="text" value="<?php echo $row['name']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" value="<?php echo $row['email']; ?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Password</label>
                        <input type="text" class="form-control" value="<?php echo $row['email']; ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>
<script src="jquary.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
