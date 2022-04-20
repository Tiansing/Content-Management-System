<?php

if (isset($_GET['edit_user'])) {
    $edit_user_id = $_GET['edit_user'];
    $query = "SELECT * FROM users WHERE user_id= {$edit_user_id}";
    $edit_user_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($edit_user_query)) {
        $username = $row['username'];
        $user_role = $row['user_role'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_image = $row['user_image'];
    }
}

if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/users_img/$user_image/");
    if (empty($user_image)) {

        $query = "SELECT * FROM users WHERE user_id=$edit_user_id";
        $select_image = mysqli_query($connection, $query);
        while ($row  = mysqli_fetch_array($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    $query = "UPDATE users SET username='{$username}', user_role = '{$user_role}',user_firstname='{$user_firstname}',user_lastname='{$user_lastname}',user_email='{$user_email}',user_password='{$user_password}',user_image='{$user_image}' WHERE user_id = $edit_user_id";

    $update_user_query = mysqli_query($connection, $query);

    verifyQry($update_user_query);
}



?>



<form action="" method="post" enctype="multipart/form-data">
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