<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_GET['id'])) {
  $id = mysqli_real_escape_string($db_conn, $_GET['id']);
  $sql = "SELECT * FROM `user_table` WHERE id = '$id'";
  $result = mysqli_query($db_conn, $sql) or die("Query Unsuccessful.");
  $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $subject_code = mysqli_real_escape_string($db_conn, $_POST['subject_code']);
  $subject_name = mysqli_real_escape_string($db_conn, $_POST['subject_name']);

  // Validate and sanitize other fields if needed

  $updateSql = "UPDATE `user_table` SET `subject_code` = '$subject_code', `subject_name` = '$subject_name' WHERE `id` = '$id'";
  $updateResult = mysqli_query($db_conn, $updateSql);

  if ($updateResult) {
      header("Location: user.php"); // Redirect to the main page after successful update
      exit();
  } else {
      echo "Update failed: " . mysqli_error($db_conn);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <!-- <?php
    $sql = "SELECT * FROM `user_table` WHERE id = $id LIMIT 1";
    $result = mysqli_query($db_conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?> -->

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">3
            <label class="form-label">Subject Code:</label>
            <input type="text" class="form-control" name="subject_code" value="<?php echo $row['subject_code'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Subject Name:</label>
            <input type="text" class="form-control" name="subject_name" value="<?php echo $row['subject_name'] ?>">
          </div>
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="user.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>