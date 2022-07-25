<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<?php

if (isset($_POST['submit'])) {
    $reg_username = $_POST['username'];
    $reg_email = $_POST['email'];
    $password = $_POST['password'];


    if (!empty($reg_username) && !empty($reg_email) && !empty($reg_password)) {
        $reg_username = mysqli_escape_string($connection, $reg_username);
        $reg_email = mysqli_escape_string($connection, $reg_email);
        $password = mysqli_escape_string($connection, $password);


        $query = "SELECT randSalt FROM users";
        $select_randSalt_query = mysqli_query($connection, $query);

        if (!$select_randSalt_query) {
            die("QUERY FAILED " . mysqli_error($connection) . " " . mysqli_errno($connection));
        }
        while ($row = mysqli_fetch_array($select_randSalt_query)) {
            $salts = $row['randSalt'];
        }

        $password = crypt($password, $salts);
        $query = "INSERT INTO users (username, user_email, user_password, user_role )";
        $query .= "VALUES('{$reg_username}', '{$reg_email}', '{$password}', 'subscriber')";
        $register_query = mysqli_query($connection, $query);
        if (!$register_query) {
            die("QUERY FAILED " . mysqli_error($connection) . " " . mysqli_errno($connection));
        }
        $message = "success";
    } else {

        $message = "empty";
    }
} else {
    $message = "";
}


?>




<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                            <?php

                            switch ($message) {
                                case "empty":
                                    echo "  <h2 class='text-center bg-danger'>Fields cannot be empty</h2>";
                                    break;
                                case "success":
                                    echo "  <h2 class='text-center bg-success d-inline'>Submitted Successfully! {$reg_password}</h2>";
                                    break;
                            }

                            ?>

                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>