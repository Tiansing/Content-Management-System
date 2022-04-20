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
            echo "<td> <img src = '../images/' width='100' alt = 'image'></td>";
            // echo "<td><a href='./posts.php?source=edit_post&p_edit={$post_id}'>Edit</td>";
            echo "<td><a href='./users.php?delete={}'>Delete</td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php

if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $delete_post_query = mysqli_query($connection, $query);
    header("Location: posts.php");
    verifyQry($delete_post_id);
}

?>