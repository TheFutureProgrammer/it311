<?php
include "db_conn.php";
$student_id = $_GET["student_id"];

if (isset($_POST["submit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $id = $_POST['id']; // Fix: Use 'id' instead of '$id'
  $email = $_POST['email'];
  $gender = $_POST['gender'];

  $sql = "UPDATE `admin_table` SET `first_name`='$first_name', `last_name`='$last_name', `id`='$id', `email`='$email', `gender`='$gender' WHERE student_id = $student_id";

  $result = mysqli_query($db_conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($db_conn);
  }
}

// Fetch the existing data for the given student_id
$sql = "SELECT * FROM `admin_table` WHERE student_id = $student_id";
$result = mysqli_query($db_conn, $sql);
$row = mysqli_fetch_assoc($result);
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

  <div class="container d-flex justify-content-center">
  <form action="" method="post" style="width:50vw; min-width:300px;">
    <div class="row mb-3">
      <div class="col">
        <label class="form-label">First Name:</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
      </div>

      <div class="col">
        <label class="form-label">Last Name:</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Subject:</label>
      <select name="id">
        <?php
        $sql1 = "SELECT * FROM user_table";
        $result1 = mysqli_query($db_conn, $sql1) or die("Query Unsuccessful.");

        while ($row1 = mysqli_fetch_assoc($result1)) {
          $select = ($row['subject'] == $row1['id']) ? "selected" : "";
          echo  "<option {$select} value='{$row1['id']}'>{$row1['subject_code']}</option>";
        }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Email:</label>
      <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
    </div>

    <div class="form-group mb-3">
      <label>Gender:</label>
      &nbsp;
      <input type="radio" class="form-check-input" name="gender" value="male" <?php echo ($row["gender"] == 'male') ? "checked" : ""; ?>>
      <label for="male" class="form-input-label">Male</label>
      &nbsp;
      <input type="radio" class="form-check-input" name="gender" value="female" <?php echo ($row["gender"] == 'female') ? "checked" : ""; ?>>
      <label for="female" class="form-input-label">Female</label>
    </div>

    <div>
      <button type="submit" class="btn btn-success" name="submit">Update</button>
      <a href="index.php" class="btn btn-danger">Cancel</a>
    </div>
  </form>
</div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>