<?php include "includes/admin_header.php"; ?>

<?php

if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_user_profile_query)) {

        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

?>

<?php

if (isset($_POST["update_user"])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/users_img/$user_image/");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_profile_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_profile_image)) {
            $user_image = $row['user_image'];
        }
    }

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password= '{$user_password}', ";
    $query .= "user_firstname= '{$user_firstname}', ";
    $query .= "user_lastname= '{$user_lastname}', ";
    $query .= "user_email= '{$user_email}', ";
    $query .= "user_role= '{$user_role}', ";
    $query .= "user_image = '{$user_image}' ";
    $query .= "WHERE username = '{$username}'";

    $update_user_profile_query = mysqli_query($connection, $query);
}




?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome Admin
                        <small>Author</small>
                    </h1>

                    <form action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username; ?>" class="form-control" name="username" required>
                        </div>

                        <div class="form-group">
                            <select name="user_role" id="user_role">
                                <?php
                                echo "<option value='{$user_role}'>{$user_role}</option>";
                                if ($user_role === "admin") {
                                    echo "<option value='subscriber'>subscriber</option>";
                                } else if ($user_role === "subscriber") {
                                    echo "<option value='admin'>admin</option>";
                                }
                                ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="user_firstname">Firsname</label>
                            <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" required>
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
                        </div>
                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
                        </div>
                        <div class="form-group">
                            <label for="user_image">Image</label>
                            <br>
                            <?php echo "<img src='../images/users_img/$user_image' width=100 alt='user_image'>"; ?>
                            <input type="file" class="form-control" name="image">
                        </div>



                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>