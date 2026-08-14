<?php
    session_start();
    if(!isset($_SESSION['admin']))
    {
        header("Location: ../login.php");
        exit();
    }
?>

<?php
$page_title="Student Management";
?>

<link rel="stylesheet" href="/hostel5/assets/css/admin_style.css">
<div class="content">
    <div class="content-wrapper">
        <h2 class="page-title">Student Management</h2>
            <div class="management-grid">
                <div class="management-card">
                    <h3>Add Student</h3>
                    <a href="add_student.php">Add new student</a>
                </div>

                <div class="management-card">
                    <h3>Display Students</h3>
                    <a href="display_student.php">View / Edit Students</a>
                </div>
            </div>
    </div>
</div>