<?php

if (isset($_POST['create_user'])) {
    $username = $_POST['username'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($user_image_temp, "../images/users_img/$user_image/");

    $query = "INSERT INTO users (username, user_role, user_firstname, user_lastname,user_email, user_password, user_image) ";
    $query .= "VALUES ('{$username}','{$user_role}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_password}','{$user_image}')";

    $create_user_query = mysqli_query($connection, $query);

    verifyQry($create_user_query);
}

echo "<h1>USER HAS BEEN CREATED: " . "<a href = 'users.php'>View all users</a></h1>";

?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>

    <div class="form-group">
        <select name="user_role" id="user_role">
            <option value="subscriber">Please Select Role</option>
            <option value="subscriber">subscriber</option>
            <option value="admin">admin</option>
        </select>
    </div>



    <div class="form-group">
        <label for="user_firstname">Firsname</label>
        <input type="text" class="form-control" name="user_firstname" required>
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_image">Image</label>
        <input type="file" class="form-control" name="image">
    </div>



    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

</form>