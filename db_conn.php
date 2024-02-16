
<?php
// db_conn.php
$db_conn = mysqli_connect("localhost", "root", "", "new");

if (!$db_conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
