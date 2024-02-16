<?php
include 'db_conn.php';

if (!$db_conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search_term = mysqli_real_escape_string($db_conn, $_GET['search']);

    $sql = "SELECT * FROM user_table WHERE id LIKE '%$search_term%' OR subject_code LIKE '%$search_term%' OR subject_name LIKE '%$search_term%'";
    $result = mysqli_query($db_conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($db_conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>SUBJECT INFORMATIONS</title>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #ACE916;">
        SUBJECT INFORMATIONS
    </nav>
    <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3">
                    <a href="user.php" class="btn btn-dark me-2">BACK</a>
                </div>
            </div>
        </div>

        <?php
        if (isset($result) && mysqli_num_rows($result) > 0) {
            echo "<div class='row justify-content-center mt-3'>";
            echo "<div class='col-md-6'>";
            echo "<table class='table table-hover text-center'>";
            echo "<thead class='table-dark'>";
            echo "<tr>";
            echo "<th scope='col'>ID</th>";
            echo "<th scope='col'>SUBJECT CODE</th>";
            echo "<th scope='col'>SUBJECT NAME</th>";
            echo "<th scope='col'>ACTION</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["subject_code"] . "</td>";
                echo "<td>" . $row["subject_name"] . "</td>";
                echo "<td>";
                echo "<a href='edit-user.php?id=" . $row["id"] . "' class='link-dark'><i class='fa-solid fa-pen-to-square fs-5 me-3'></i></a>";
                echo "<a href='delete-user.php?id=" . $row["id"] . "' class='link-dark'><i class='fa-solid fa-trash fs-5'></i></a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='row justify-content-center mt-3'>";
            echo "<div class='col-md-6'>";
            echo "<div class='alert alert-warning' role='alert'>No results found.</div>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- JavaScript for printing table -->
    <script>
        function printTable() {
            window.print();
        }
    </script>
</body>

</html>
