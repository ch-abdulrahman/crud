<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="Font Awesome/css/all.min.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <title>CRUD</title>
</head>

<body>
    <?php
    include "navbar.php";
    include "config.php";
    $sql = 'SELECT * FROM students JOIN departments ON students.std_department = departments.dep_id';
    $result = mysqli_query($conn, $sql) or die('Query Unsuccessful.');
    if (mysqli_num_rows($result) > 0) {
    ?>
        <div class="table">
            <div class="container">
                <header>All Records</header>
                <div class="wrapper">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Father Name</td>
                                <th>Gender</th>
                                <th>D.O.B</th>
                                <th>Age</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Postal Code</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                // complete gender name
                                if ($row['std_gender'] == 'M')
                                    $gender = 'Male';
                                else if ($row['std_gender'] == 'F')
                                    $gender = 'Female';
                                else if ($row['std_gender'] == 'O')
                                    $gender = 'Other';
                                // format date of birth
                                $dob = date_format(date_create($row['std_dob']), 'd-m-Y');
                                // count age using date of birth
                                $diff = date_diff(date_create($row['std_dob']), date_create('now'));
                                $age = $diff->format('%y');
                                echo "<tr>
                                <td>$row[std_id]</td>
                                <td>$row[std_fname] $row[std_lname]</td>
                                <td>$row[std_father]</td>
                                <td>$gender</td>
                                <td>$dob</td>
                                <td>$age</td>
                                <td>$row[dep_name]</td>
                                <td>$row[std_email]</td>
                                <td>$row[std_phone]</td>
                                <td>$row[std_address]</td>
                                <td>$row[std_postal]</td>
                                <td>$row[std_city]</td>
                                <td class='action'>
                                    <i class='fas fa-edit' title='Edit'></i>
                                    <i class='fas fa-trash-alt' title='Delete'></i>
                                </td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
    ?>
    <script src="js/script.js"></script>
    <script>
        // anchors[0].style.color = 'var(--primary-color)';
        nav_li[0].classList.add("active");
    </script>
</body>

</html>