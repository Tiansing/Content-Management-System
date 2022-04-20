<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Role</th>
            <th>Image</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>


        </tr>

    </thead>
    <tbody>

        <?php

        $query = "SELECT * FROM users";
        $select_all_posts = mysqli_query($connection, $query);
        while ($row  = mysqli_fetch_assoc($select_all_posts)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";


            // $query = "SELECT * FROM categories WHERE cat_id = $post_category";
            // $category = mysqli_query($connection, $query);
            // while ($row = mysqli_fetch_assoc($category)) {
            //     $cat_title = $row['cat_title'];
            //     echo "<td>$cat_title</td>";
            // }


            echo "<td>$user_lastname</td>";

            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";
            echo "<td> <img src = '../images/users_img/$user_image' height='50' alt = 'image'></td>";
            echo "<td><a href = './users.php?change_to_admin={$user_id}'>admin</a></td>";
            echo "<td><a href = './users.php?change_to_sub={$user_id}'>subscriber</a></td>";
            echo "<td><a href = './users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
            echo "<td><a href='./users.php?delete={$user_id}'>Delete</td>";

            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php
if (isset($_GET['change_to_admin'])) {
    $set_to_admin = $_GET['change_to_admin'];

    $query = "UPDATE users SET ";
    $query .= "user_role ='admin' ";
    $query .= "WHERE user_id = {$set_to_admin}";
    $set_admin_query = mysqli_query($connection, $query);
    header("Location:users.php");
    verifyQry($set_admin_query);
}

if (isset($_GET['change_to_sub'])) {
    $set_to_sub = $_GET['change_to_sub'];

    $query = "UPDATE users SET ";
    $query .= "user_role ='subscriber' ";
    $query .= "WHERE user_id = {$set_to_sub}";
    $set_admin_query = mysqli_query($connection, $query);
    header("Location:users.php");
    verifyQry($set_admin_query);
}

if (isset($_GET['delete'])) {

    $delete_user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
    $delete_user_query = mysqli_query($connection, $query);
    header("Location: users.php");
    verifyQry($delete_user_query);
}

?>