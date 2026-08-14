<?php
    session_start();
        if(!isset($_SESSION['admin']))
        {
            header("Location: ../login.php");
            exit();
        }
    $page_title = "Admin Dashboard | Scholars' Nest Hostel";
?>

<link rel="stylesheet" href="../assets/css/admin_style.css">
    <div class="content">
        <div class="content-wrapper">
            <h2 class="page-title">Dashboard</h2>
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <h3>Student Management</h3>
                        <a href="student_management.php">Manage Students</a>
                    </div>

                    <div class="dashboard-card">
                        <h3>Room Management</h3>
                        <a href="edit_room.php">Manage Room Details</a>
                    </div>

                    <div class="dashboard-card" onclick="location.href='menu_management.php?page=menu'">
                        <h3>Menu Management</h3>
                        <a href="menu_management.php">Manage Menu</a>
                    </div>

                    <div class="dashboard-card">
                        <h3>Complain Management</h3>
                        <a href="complaint_status.php">Manage Complaint Status</a>
                    </div>
                </div>
        
                <div class="logout-container">
                    <a href="/hostel5/includes/logout.php" class="logout-btn"> Logout </a>
                </div>
        </div>
    </div>