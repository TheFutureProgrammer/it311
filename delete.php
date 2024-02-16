<?php
session_start();
include "db_conn.php";

if (isset($_POST['deletebtn'])) 
    if (isset($_POST['student_id']) && !empty($_POST['student_id'])) {
        $student_id = $_POST['student_id'];

        // Fetch the existing data for the given student_id
        $sqlSelect = "SELECT * FROM `admin_table` WHERE student_id = ?";
        $stmtSelect = mysqli_prepare($db_conn, $sqlSelect);
        mysqli_stmt_bind_param($stmtSelect, "i", $student_id);
        mysqli_stmt_execute($stmtSelect);
        $resultSelect = mysqli_stmt_get_result($stmtSelect);
        $row = mysqli_fetch_assoc($resultSelect);

        // Use prepared statements to prevent SQL injection
        $sqlDelete = "DELETE FROM admin_table WHERE student_id = ?";
        $stmtDelete = mysqli_prepare($db_conn, $sqlDelete);
        mysqli_stmt_bind_param($stmtDelete, "i", $student_id);
        $resultDelete = mysqli_stmt_execute($stmtDelete);

        // Check if deletion is successful
        if ($resultDelete) {
            // Use prepared statements for the insertion query as well
            $sqlInsert = "INSERT INTO deleted_records (student_id, first_name, last_name, id, email, gender) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsert = mysqli_prepare($db_conn, $sqlInsert);
            mysqli_stmt_bind_param($stmtInsert, "isssss", $row['student_id'], $row['first_name'], $row['last_name'], $row['id'], $row['email'], $row['gender']);
            $resultInsert = mysqli_stmt_execute($stmtInsert);

            // Check if insertion is successful
            if ($resultInsert) {
                header("Location:index.php?msg=Data deleted successfully");
        } else {
            die("Deletion failed: " . mysqli_error($db_conn));
        }

        mysqli_stmt_close($stmtDelete);
        mysqli_stmt_close($stmtInsert);
        mysqli_stmt_close($stmtSelect);
    } else {
        echo "Invalid student ID.";
    }
}

mysqli_close($db_conn);
?>
