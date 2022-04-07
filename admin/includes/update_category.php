<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Update Category</label>
        <?php
        //UPDATE CATEGORY
        if (isset($_GET['update'])) {
            $cat_id = $_GET['update'];
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
            $update_category_id = mysqli_query($connection, $query);


            while ($row = mysqli_fetch_assoc($update_category_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
        ?>
                <input type="text" class="form-control" name="cat_title" value="<?php if (isset($cat_title)) {
                                                                                    echo "{$cat_title}";
                                                                                } ?>">
        <?php
            }
        }
        ?>


    </div>
    <div class="form-group">
        <?php
        if (isset($_POST['update-categories'])) {

            $the_cat_title = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";
            $update_query = mysqli_query($connection, $query);

            if (!$update_query) {
                echo "QUERY FAILED " . mysqli_error($connection);
            }
        }
        ?>
        <input type="submit" class="btn btn-primary" name="update-categories" value="Update Category">
    </div>
</form>