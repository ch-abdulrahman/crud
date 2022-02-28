<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="Font Awesome/css/all.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Delete Record</title>
</head>
<style>
    .input-form .form-btn {
        margin-top: 0;
    }
</style>

<body>
    <?php include "navbar.php" ?>

    <form class="input-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <div class="caption">
                <h1>Enter ID</h1>
            </div>
            <div class="inp-row">
                <div class="col50">
                    <input type="search" name="delete-id" id="delete-id" placeholder="Enter ID to Delete Record" required>
                </div>
                <div class="col50">
                    <input type="submit" class="form-btn" name="delete" value="Delete">
                </div>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['delete'])) {
        include "config.php";
        $sql = "SELECT std_id FROM std_database.students  where std_id = {$_POST['delete-id']}";
        $result = mysqli_query($conn, $sql) or die('Select Query Unsuccessful.');
        if (mysqli_num_rows($result) > 0) {
            $delete_sql = "DELETE FROM std_database.students WHERE (std_id = {$_POST['delete-id']})";
            mysqli_query($conn, $delete_sql) or die('Delete Query Unsuccessful.');
        } else {
    ?>
            <div class='no-record'>
                <img src="img/No Record Found.jpg" alt="No Record Found">
                <h1>No Record Found</h1>
            </div>";
    <?php
        }
        mysqli_close($conn);
    }
    ?>

    <script src="js/script.js"></script>
    <script>
        nav_li[3].classList.add("active");
    </script>
</body>

</html>