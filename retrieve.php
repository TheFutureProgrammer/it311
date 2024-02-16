<?php
include 'db_conn.php'; // Add this line

// Function to retrieve data from the database
function retrieveData($db_conn)
{
    // SQL query to retrieve data
    $sql = "SELECT * FROM deleted_records";
    $result = mysqli_query($db_conn, $sql);

    // Check if the query was successful
    if ($result === false) {
        die("Error in query: " . mysqli_error($db_conn));
    }

    // Fetch data from the result set
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Free the result set
    mysqli_free_result($result);

    // Return the retrieved data
    return $data;
}


$retrievedData = retrieveData($db_conn);

// Close the database db_connection
mysqli_close($db_conn);
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

    <title>DELETED RECORDS</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #ACE916;">
        DELETED RECORDS
    </nav>

    <div class="container text-center">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        ?>
         <a href="index.php" class="btn btn-dark mb-3">BACK</a>

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
                foreach ($retrievedData as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["last_name"] . "</td>";
                    echo "<td>" . $row["id"] . "</td>"; // Assuming this is the correct column name
                    echo "<td>" . $row["email"] . "</td>"; // Corrected column name
                    echo "<td>" . $row["gender"] . "</td>"; // Corrected column name
                    echo "<td>";

                    // Change the form method to "POST" and include it inside the table cell
                    echo "<form method='post' action='retrive-admin.php' style='display: inline;'>";
                    echo "<input type='hidden' name='student_id' value='" . $row['student_id'] . "'>";
                    echo "<button type='submit' name='restorebtn' class='btn btn-success'>";
                    echo "<i class='fa-solid fa-arrow-counterclockwise fs-5'></i> Restore";
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

</body>

</html>
