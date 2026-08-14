<?php
    session_start();
        if(!isset($_SESSION['admin']))
        {
            header("Location: ../login.php");
            exit();
        }
?>

<?php
    include '../includes/db.php';
    $roll=$_GET['roll_no'];
    $sql="DELETE FROM students WHERE roll_no='$roll'";
    mysqli_query($conn,$sql);
    header("location:display_student.php");
?>