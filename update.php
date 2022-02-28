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
    <title>Update Record</title>
</head>
<style>
    .input-form.search .form-btn {
        margin-top: 0;
    }

    .input-form.search .field {
        margin-top: 18px;
    }

    .input-form.search .input-area {
        display: flex;
    }

    .input-form.search .form-btn {
        width: 40%;
        height: 100%;
        max-width: 140px;
    }
</style>

<body>
    <?php include "navbar.php" ?>
    <form class="input-form search" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="container">
            <header>Enter ID</header>
            <div class="row">
                <div class="col100">
                    <div class="field search-id">
                        <div class="input-area">
                            <!-- <input name="search-id" id="search-id" placeholder="Enter ID to Update Record" autofocus required> -->
                            <input type="number" name="search-id" id="search-id" placeholder="Enter ID to Update Record" autofocus required>
                            <input type="submit" class="form-btn" name="show" value="show">
                            <i class="valid valid-icon fas fa-check-circle"></i>
                            <i class="error error-icon fas fa-exclamation-circle"></i>
                        </div>
                        <div class="error ">
                            <span class="error-txt"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['show'])) {
        include "config.php";
        $sql = "SELECT * FROM students JOIN departments
        ON students.std_department = departments.dep_id
        where std_id = {$_POST['search-id']}";
        $result = mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <form class="input-form validate" action="submit.php" method="POST" novalidate>
                <div class="container">
                    <header>Update Record</header>
                    <input type="hidden" value="<?php echo $row['std_id'] ?>" name="id" id="id">
                    <div class="row">
                        <div class="col50">
                            <div class="field fname">
                                <div class="input-area">
                                    <label for="fname">first name<span class="require">*</span></label>
                                    <input type="text" value="<?php echo $row['std_fname'] ?>" name="fname" id="fname" placeholder="First Name">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col50">
                            <div class="field lname">
                                <div class="input-area">
                                    <label for="lname">last name<span class="require">*</span></label>
                                    <input type="text" value="<?php echo $row['std_lname'] ?>" name="lname" id="lname" placeholder="Last Name">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col50">
                            <div class="field fathername">
                                <div class="input-area">
                                    <label for="fathername">Father Name<span class="require">*</span></label>
                                    <input type="text" value="<?php echo $row['std_father'] ?>" name="fathername" id="fathername" placeholder="Father Name">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col50">
                            <div class="field gender">
                                <div class="input-area">
                                    <label class="focus-on-click">Gender<span class="require">*</span></label>
                                    <div class="radio-container">
                                        <input type="radio" <?php if ($row['std_gender'] == 'M') echo "checked" ?> id="male" class="gender-radio focus-on-click" name="gender" value="M">
                                        <input type="radio" <?php if ($row['std_gender'] == 'F') echo "checked" ?> id="female" class="gender-radio focus-on-click" name="gender" value="F">
                                        <input type="radio" <?php if ($row['std_gender'] == 'O') echo "checked" ?> id="other" class="gender-radio focus-on-click" name="gender" value="O">

                                        <label class="gender-options male" for="male">
                                            <div class="dot"></div>
                                            <span>Male</span>
                                        </label>
                                        <label class="gender-options female" for="female">
                                            <div class="dot"></div>
                                            <span>Female</span>
                                        </label>
                                        <label class="gender-options other" for="other">
                                            <div class="dot"></div>
                                            <span>other</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col50">
                            <div class="field dob">
                                <div class="input-area">
                                    <label for="dob">Date of Birth<span class="require">*</span></label>
                                    <input type="date" value="<?php echo $row['std_dob'] ?>" name="dob" id="dob">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col50">
                            <div class="field department">
                                <div class="input-area">
                                    <label for="department">department<span class="require">*</span></label>
                                    <select name="department" id="department">
                                        <?php
                                        $dep_sql = 'SELECT * FROM std_database.departments';
                                        $dep_result = mysqli_query($conn, $dep_sql) or exit('Query Unsuccessful.');
                                        echo "<option value='' selected disabled>Select your Department</option>";
                                        while ($dep_row = mysqli_fetch_assoc($dep_result)) {
                                            ($row['dep_name'] == $dep_row['dep_name']) ? $select = 'selected' : $select = '';
                                            echo "<option $select value='$dep_row[dep_id]'>$dep_row[dep_name]</option>";
                                        }
                                        ?>
                                    </select>
                                    <i class="fas fa-angle-down"></i>
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col50">
                            <div class="field email">
                                <div class="input-area">
                                    <label for="email">Email<span class="require">*</span></label>
                                    <input type="email" value="<?php echo $row['std_email'] ?>" name="email" id="email" placeholder="Email Address">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col50">
                            <div class="field phone">
                                <div class="input-area">
                                    <label for="phone">Phone<span class="optional">(optional)</span></label>
                                    <input type="tel" value="<?php echo $row['std_phone'] ?>" name="phone" id="phone" placeholder="03XXXXXXXXX">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col100">
                            <div class="field address">
                                <div class="input-area">
                                    <label for="address">Address<span class="require">*</span></label>
                                    <input type="text" value="<?php echo $row['std_address'] ?>" name="address" id="address" placeholder="street address (10-150)">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col50">
                            <div class="field postal">
                                <div class="input-area">
                                    <label for="postal">Postal Code<span class="optional">(optional)</span></label>
                                    <input type="number" value="<?php echo $row['std_postal'] ?>" name="postal" id="postal" min="10000" max="99999" placeholder="5-digit postal code">
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col50">
                            <div class="field city">
                                <div class="input-area">
                                    <label for="city">city<span class="require">*</span></label>
                                    <input type="text" value="<?php echo $row['std_city'] ?>" name="city" id="city" list="citylist" placeholder="Your City">
                                    <datalist id="citylist">
                                        <?php
                                        $sql = 'SELECT city_name FROM std_database.cities';
                                        $result = mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value='$row[city_name]'>";
                                        }
                                        ?>
                                    </datalist>
                                    <i class="valid valid-icon fas fa-check-circle"></i>
                                    <i class="error error-icon fas fa-exclamation-circle"></i>
                                </div>
                                <div class="error ">
                                    <span class="error-txt"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="form-btn" name="update" value="update">
                </div>
            </form>
        <?php
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
    <script src="js/form.js"></script>
    <script>
        nav_li[2].classList.add("active");
    </script>
</body>

</html>