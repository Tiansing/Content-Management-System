<div class="col-md-4">

    <!-- Blog Search Well -->


    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <form action="search.php" method="post">
                <input type="text" class="form-control" name="search" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>

            </form>

        </div>
        <!-- /.input-group -->
    </div>
    <div class="well">
        <h4 class="text-center ">Login</h4>

        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input name="username" class="form-control" type="text" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <input name="password" class="form-control" type="password" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit" name="login">Submit

                    </button>
                </span>
            </div>

        </form>


        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">

        <?php
        $query = "SELECT * FROM categories ";
        $select_all_categories = mysqli_query($connection, $query);


        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($select_all_categories)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo " <li><a href='categories.php?category=$cat_id'>{$cat_title}</a>";
                    }
                    ?>

                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <?php include "includes/widget.php"; ?>