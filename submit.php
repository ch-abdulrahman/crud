 <?php

    include "config.php";

    if (isset($_POST['add'])) {
        $fname = trim(ucwords(strtolower($_POST['fname'])));
        $lname = trim(ucwords(strtolower($_POST['lname'])));
        $fathername = trim(ucwords(strtolower($_POST['fathername'])));
        $gender = trim(strtoupper($_POST['gender']));
        $dob = $_POST['dob'];
        $department = trim(ucwords(strtolower($_POST['department'])));
        $email = trim(strtolower($_POST['email']));
        $phone = preg_replace('/^0|^92/', '+92', str_replace("-", "", trim($_POST['phone']))); //if phone number starts from 0 or 92 then replace it with +92 and if conatins hyphen (-) then replace it with null
        $address = trim(ucwords(strtolower($_POST['address'])));
        $postal = trim($_POST['postal']);
        $city = trim(ucwords(strtolower($_POST['city'])));

        $sql = "INSERT INTO std_database.students 
        (std_fname, std_lname, std_father, std_gender, std_dob, std_department, std_email, std_phone, std_address, std_postal, std_city) VALUES
        ('{$fname}','{$lname}','{$fathername}','{$gender}','{$dob}','{$department}','{$email}','{$phone}','{$address}','{$postal}','{$city}')";
        // echo (mysqli_query($conn, $sql)) ? true : false;
        mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
        header("location: http://localhost/php/7.%20CRUD/crud.php");
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $fname = trim(ucwords(strtolower($_POST['fname'])));
        $lname = trim(ucwords(strtolower($_POST['lname'])));
        $fathername = trim(ucwords(strtolower($_POST['fathername'])));
        $gender = trim(strtoupper($_POST['gender']));
        $dob = $_POST['dob'];
        $department = trim(ucwords(strtolower($_POST['department'])));
        $email = trim(strtolower($_POST['email']));
        $phone = preg_replace('/^0|^92/', '+92', str_replace("-", "", trim($_POST['phone']))); //if phone number starts from 0 or 92 then replace it with +92 and if conatins hyphen (-) then replace it with null
        $address = trim(ucwords(strtolower($_POST['address'])));
        $postal = trim($_POST['postal']);
        $city = trim(ucwords(strtolower($_POST['city'])));

        $sql = "UPDATE std_database.students SET std_fname = '{$fname}', std_lname = '{$lname}', std_father = '{$fathername}', std_gender = '{$gender}', std_dob = '{$dob}', std_department = '{$department}', std_email = '{$email}', std_phone = '{$phone}', std_address = '{$address}', std_postal = '{$postal}', std_city = '{$city}' WHERE (std_id = '$id')";
        mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
        header("location: http://localhost/php/7.%20CRUD/crud.php");
    }



    if (isset($_POST['checkemail'])) {
        $id = $_POST['id'];
        $email = trim(strtolower($_POST['email']));
        $sql = "SELECT std_id, std_email FROM std_database.students WHERE NOT std_id = '$id' AND std_email = '$email' ";
        $result = mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
        // if (mysqli_num_rows($result) > 0) echo true;
        echo (mysqli_num_rows($result) > 0) ? true : false;
    }

    if (isset($_POST['checkphone'])) {
        $id = $_POST['id'];
        $phone = preg_replace('/^0|^92/', '+92', str_replace("-", "", trim($_POST['phone']))); //if phone number starts from 0 or 92 then replace it with +92 and if conatins hyphen (-) then replace it with null
        $sql = "SELECT std_id, std_phone FROM std_database.students WHERE NOT std_id = '$id' AND std_phone = '$phone' ";
        $result = mysqli_query($conn, $sql) or exit('Query Unsuccessful.');
        // if (mysqli_num_rows($result) > 0) echo true; 
        echo (mysqli_num_rows($result) > 0) ? true : false;
    }
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    mysqli_close($conn);
