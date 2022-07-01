<?php

if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    // $post_comments = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image/");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' )";

    $create_post_query = mysqli_query($connection, $query);

    verifyQry($create_post_query);

    $the_post_id = mysqli_insert_id($connection);

    echo "<h3 class='bg-success'>{$post_title} Post successfully created! <a class='btn btn-success' href='../post.php?p_id={$the_post_id}'>View Post</a> or <a class='btn btn-primary' href='./posts.php'>Edit other Posts</a></h3>";
}



?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>


    <div class="form-group">
        <select name="post_category_id" id="post_category_id">
            <?php
            $query = "SELECT * FROM categories";
            $select_category = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_category)) {
                $cat_id = $row["cat_id"];
                $cat_title = $row["cat_title"];
                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author" required>
    </div>

    <div class="form-group">


        <select name="post_status" id="">
            <option value="draft">Select Post Status</option>
            <option value="draft">Draft</option>
            <option value="published">Publish</option>


        </select>

    </div>



    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" required>
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10" required></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post" required>
    </div>

</form>