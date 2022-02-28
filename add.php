<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://kit.fontawesome.com/0cfca579f4.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="Font Awesome/css/all.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Add Record</title>
</head>

<body>
    <?php include "navbar.php" ?>

    <form class="input-form validate" action="submit.php" method="POST" novalidate>
    <!-- <form class="input-form validate"  novalidate> -->
        <div class="container">
            <header>Add Record</header>
            <input type="hidden" id="id">
            <div class="row">
                <div class="col50">
                    <div class="field fname">
                        <div class="input-area">
                            <label for="fname">first name<span class="require">*</span></label>
                            <input type="text" name="fname" id="fname" placeholder="First Name">
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
                            <input type="text" name="lname" id="lname" placeholder="Last Name">
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
                            <input type="text" name="fathername" id="fathername" placeholder="Father Name">
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
                                <input checked type="radio" id="male" class="gender-radio focus-on-click" name="gender" value="M">
                                <input type="radio" id="female" class="gender-radio focus-on-click" name="gender" value="F">
                                <input type="radio" id="other" class="gender-radio focus-on-click" name="gender" value="O">

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
                            <input type="date" name="dob" id="dob">
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
                                include "config.php";
                                $sql = 'SELECT * FROM std_database.departments';
                                $result = mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
                                echo "<option value='' selected disabled>Select your Department</option>";
                                echo "<option value='7' selected>Arts</option>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='$row[dep_id]'>$row[dep_name]</option>";
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
                            <input type="email" name="email" id="email" placeholder="Email Address">
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
                            <input type="tel" name="phone" id="phone" placeholder="03XXXXXXXXX">
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
                            <input type="text" name="address" id="address" placeholder="street address (10-150)">
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
                            <input type="number" name="postal" id="postal" min="10000" max="99999" placeholder="5-digit postal code">
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
                            <input type="text" name="city" id="city" list="citylist" placeholder="Your City">
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
            <input type="submit" class="form-btn" name="add" value="add">
        </div>
    </form>
    <?php
    mysqli_close($conn);
    ?>
    <script src="js/script.js"></script>
    <script src="js/form.js"></script>
    <script>
        nav_li[1].classList.add("active");
    </script>
</body>

</html>