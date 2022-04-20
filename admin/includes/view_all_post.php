<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

    </thead>
    <tbody>

        <?php

        $query = "SELECT * FROM posts";
        $select_all_posts = mysqli_query($connection, $query);
        while ($row  = mysqli_fetch_assoc($select_all_posts)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_comment_count'];
            $post_date = $row['post_date'];

            echo "<tr>";
            echo "<td>$post_id</td>";
            echo "<td>$post_author</td>";
            echo "<td>$post_title</td>";


            $query = "SELECT * FROM categories WHERE cat_id = $post_category";
            $category = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($category)) {
                $cat_title = $row['cat_title'];
                echo "<td>$cat_title</td>";
            }


            echo "<td>$post_status</td>";
            echo "<td> <img src = '../images/$post_image' width='100' alt = 'image'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comments</td>";
            echo "<td>$post_date</td>";
            echo "<td><a href='./posts.php?source=edit_post&p_edit={$post_id}'>Edit</td>";
            echo "<td><a href='./posts.php?delete={$post_id}'>Delete</td>";
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