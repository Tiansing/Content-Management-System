<?php

if (isset($_POST['checkBoxArray'])) {


    $bulk_option = $_POST['selectOption'];



    foreach ($_POST['checkBoxArray'] as $postValueId) {
        switch ($bulk_option) {
            case "published":
                $query = "UPDATE  posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueId} ";
                $publish_post_query = mysqli_query($connection, $query);

                break;
            case "draft":
                $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = {$postValueId} ";
                $publish_post_query = mysqli_query($connection, $query);

                break;
            case "delete":
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $publish_post_query = mysqli_query($connection, $query);

                break;
        }
    }
}



?>


<form action="" method="post">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionSelect" class=" col-xs-4">
            <select name="selectOption" id="" class="form-control">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="form-group">
            <input class="btn btn-success" type="submit" value="Apply Changes">
            <a class="btn btn-primary" href="./posts.php?source=add_post">Add Post</a>
        </div>
        <tr>
            <th><input id="checkBoxSelectAll" type="checkbox"></th>
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
            ?>
                <td><input class="checkBoxes" type="checkBox" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
            <?php
                echo "<td>$post_id</a></td>";
                echo "<td>$post_author</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";


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
</form>
<?php

if (isset($_GET['delete'])) {
    $delete_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
    $delete_post_query = mysqli_query($connection, $query);
    header("Location: posts.php");
    verifyQry($delete_post_id);
}

?>