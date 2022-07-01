<?php

if (isset($_GET['p_edit'])) {

    $the_post_id =  $_GET['p_edit'];
}

$query = "SELECT * FROM posts WHERE post_id =  $the_post_id";
$select_edit_posts = mysqli_query($connection, $query);
while ($row  = mysqli_fetch_assoc($select_edit_posts)) {

    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];

    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comments = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image/");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$the_post_id}";

    $update_post = mysqli_query($connection, $query);
    verifyQry($update_post);

    echo "<h3 class='bg-success'>{$post_title} Post successfully updated! <a class='btn btn-success' href='../post.php?p_id={$the_post_id}'>View Post</a> or <a class='btn btn-primary' href='./posts.php'>Edit other Posts</a></h3>";
}

?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>


    <div class="form-group">

        <select name="post_category" id="post_category">
            <?php

            $query = "SELECT * FROM categories ";
            $select_category = mysqli_query($connection, $query);
            verifyQry($select_category);
            while ($row = mysqli_fetch_assoc($select_category)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='$cat_id'>{$cat_title}</option>";
            }

            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
    </div>




    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status" id="">
            <?php
            echo "<option value = '$post_status'>{$post_status}</option>";
            if ($post_status == "published") {
                echo "<option>draft</option>";
            } else {
                echo "<option>published</option>";
            }
            ?>
        </select>
    </div>



    <div class="form-group">
        <label for="post_image">Post Image</label>
        <br>
        <img src="<?php echo "../images/$post_image" ?>" width="100" alt="post image">
        <input type="file" class="form-control" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
<?php echo $post_content; ?>

        </textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>