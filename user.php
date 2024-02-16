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
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <form class="search-bar" method="GET" action="search-user.php">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search by Subject Code">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
    <div class="container">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="d-flex justify-content-center mb-3">
                    <a href="add-user.php" class="btn btn-dark me-2">Add New</a>
                    <a href="index.php" class="btn btn-dark me-2">Admin</a>
                    <button type="button" class="btn btn-dark me-2" onclick="printTable()"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">SUBJECT CODE</th>
                    <th scope="col">SUBJECT NAME</th>
                    <th scope="col">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file or establish a connection here
                include "db_conn.php"; // Replace with the correct path to your connection file

                // Check if the connection is successful
                if (!$db_conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Now you can execute your SQL query
                $sql = "SELECT * FROM user_table";
                $result = mysqli_query($db_conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    // Your code to process each row
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

                // Close the database connection when done
                mysqli_close($db_conn);
                ?>

            </tbody>
        </table>
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
