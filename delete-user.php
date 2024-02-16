<?php
include "db_conn.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Use prepared statement to prevent SQL injection
    $sql = "DELETE FROM `user_table` WHERE id = ?";
    
    $stmt = mysqli_prepare($db_conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);  // "i" represents integer type

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    // Check the result
    if ($result) {
        header("Location: user.php?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}
?>
