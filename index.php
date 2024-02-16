<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Students Information</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #ACE916;">
        STUDENTS INFORMATION
    </nav>

    <div class="container">
    <div class="row justify-content-center mt-2">
        <div class="col-md-6">
            <form class="search-bar" method="POST" action="search.php">
                <div class="input-group">
                    <input type="text" class="form-control" name="search_subject_code" placeholder="Search by Subject Code">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <?php
                if (isset($_GET["msg"])) {
                    $msg = $_GET["msg"];
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            ' . $msg . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                ?>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3">
                    <a href="add-new.php" class="btn btn-dark me-2">Add New</a>
                    <a href="user.php" class="btn btn-dark me-2">User</a>
                    <button type="button" class="btn btn-dark me-2" onclick="printTable()"><i class="fas fa-print"></i> Print</button>
                    <a href="retrieve.php" class="btn btn-danger"> <i class="fa-solid fa-trash"></i> Trash </a>
                </div>
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Student Id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Subject Code</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_conn.php';

                if (!$db_conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT
                    admin_table.student_id,
                    admin_table.first_name,
                    admin_table.last_name,
                    user_table.subject_name,
                    admin_table.email,
                    admin_table.gender
                    FROM
                    admin_table
                    JOIN
                    user_table ON admin_table.id = user_table.id";

                $result = mysqli_query($db_conn, $sql);

                // Loop through the results and display them
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["subject_name"] . "</td>"; // Assuming this is the correct column name
                    echo "<td>" . $row["email"] . "</td>"; // Corrected column name
                    echo "<td>" . $row["gender"] . "</td>"; // Corrected column name
                    echo "<td>";
                    echo "<a href='edit.php?student_id=" . $row["student_id"] . "' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>";

                    // Change the form method to "POST" and include it inside the table cell
                    echo "<form method='post' action='delete.php' style='display: inline;'>";
                    echo "<input type='hidden' name='student_id' value='" . $row['student_id'] . "'>";
                    echo "<button type='submit' name='deletebtn' class='btn btn-danger'>";
                    echo "<i class='fa-solid fa-trash fs-5'></i>";
                    echo "</button>";
                    echo "</form>";

                    echo "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        function printTable() {
            window.print();
        }
    </script>
</body>

</html>

</html>
