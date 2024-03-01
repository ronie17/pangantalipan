<?php
session_start();
include("config.php");

if(isset($_POST['submit'])) {
    // Update operation
    $id = $_POST['id'];
    $studentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $email = $_POST['email'];

    // Assuming you're using prepared statements to prevent SQL injection
    $query = "UPDATE student_information SET student_id=?, fname=?, mname=?, lname=?, birthday=?, email_address=? WHERE id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssssssi", $studentId, $firstName, $middleName, $lastName, $dateOfBirth, $email, $id);
    mysqli_stmt_execute($stmt);

    if(mysqli_affected_rows($con) > 0) {
        $_SESSION['status'] = "Student data updated successfully.";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: Failed to update student data.";
        $_SESSION['status_code'] = "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
    header("Location: index.php");
    exit();
} elseif(isset($_POST['insert'])) { 
    // Insert operation
    $studentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $dateOfBirth = $_POST['birthday'];
    $email = $_POST['email'];

    // Assuming you're using prepared statements to prevent SQL injection
    $query = "INSERT INTO student_information (student_id, fname, mname, lname, address, birthday, email_address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $studentId, $firstName, $middleName, $lastName, $address, $dateOfBirth, $email);
    mysqli_stmt_execute($stmt);

    if(mysqli_affected_rows($con) > 0) {
        $_SESSION['status'] = "New student added successfully.";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: Failed to add new student.";
        $_SESSION['status_code'] = "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
    header("Location: index.php");
    exit();
} elseif(isset($_GET['delete_id'])) { 
    // Delete operation
    $id = $_GET['delete_id'];

    // Assuming you're using prepared statements to prevent SQL injection
    $query = "DELETE FROM student_information WHERE id=?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if(mysqli_affected_rows($con) > 0) {
        $_SESSION['status'] = "Student data deleted successfully.";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Error: Failed to delete student data.";
        $_SESSION['status_code'] = "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
    header("Location: index.php");
    exit();
} else {
    // Invalid operation
    $_SESSION['status'] = "Error: Invalid operation.";
    $_SESSION['status_code'] = "error";
    header("Location: index.php");
    exit();
}
?>
