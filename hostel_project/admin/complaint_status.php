<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header("Location: ../login.php");
        exit();
    }
    include '../includes/db.php';

    if(isset($_GET['set_status']) && isset($_GET['id'])){
        $status = $_GET['set_status'];
        $id = $_GET['id'];

        mysqli_query($conn,
        "UPDATE complaints SET status='$status' WHERE id='$id'");

        header("Location: complaint_status.php");
        exit();
    }

    $result = mysqli_query($conn,
    "SELECT * FROM complaints ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Complaint Status Management</title>

        <style>

            body{
            font-family:Segoe UI;
            background:#eef2f7;
            margin:0;
            padding:0;
            }

            .container{
            width:1200px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
            }

            h2{
            text-align:center;
            color:#2E7D32;
            margin-bottom:25px;
            }

            table{
            width:100%;
            border-collapse:collapse;
            }

            th,td{
            padding:12px;
            border:1px solid #ddd;
            text-align:center;
            }

            th{
            background:#2E7D32;
            color:white;
            }

            tr:nth-child(even){
            background:#f9f9f9;
            }

            /* BUTTON STYLES */

            .status-btn{
            padding:6px 12px;
            border-radius:5px;
            text-decoration:none;
            color:white;
            font-size:13px;
            margin:3px;
            display:inline-block;
            }

            .start{
            background:#ffc107;
            color:black;
            }

            .resolve{
            background:#28a745;
            }

            .cannot{
            background:#dc3545;
            }

            .final-resolved{
            background:#28a745;
            padding:6px 10px;
            border-radius:4px;
            color:white;
            }

            .final-not{
            background:#6c757d;
            padding:6px 10px;
            border-radius:4px;
            color:white;
            }

        </style>
    </head>
<body>
    <div class="container">
        <h2>Complaint Status Management</h2>
        <table>
            <tr>
                <th>Roll Number</th>
                <th>Name</th>
                <th>Room No</th>
                <th>Complaint</th>
                <th>Date</th>
                <th>Status Action</th>
            </tr>

                <?php
            while($row=mysqli_fetch_assoc($result))
            {
                echo "<tr>";

                echo "<td>".$row['roll_no']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['room_number']."</td>";
                echo "<td>".$row['complaint']."</td>";
                echo "<td>".$row['created_at']."</td>";

                echo "<td>";
                ?>
                <?php if ($row['status'] == 'Pending'): ?>
                <a class="status-btn start"
                href="?set_status=In Progress&id=<?= $row['id'] ?>">
                Start Processing
                </a>

                <a class="status-btn cannot"
                href="?set_status=Not Resolved&id=<?= $row['id'] ?>">
                Cannot Resolve
                </a>

                <?php elseif ($row['status'] == 'In Progress'): ?>

                <a class="status-btn resolve"
                href="?set_status=Resolved&id=<?= $row['id'] ?>">
                Mark Resolved
                </a>

                <a class="status-btn cannot"
                href="?set_status=Not Resolved&id=<?= $row['id'] ?>">
                Cannot Resolve
                </a>

                <?php elseif ($row['status'] == 'Resolved'): ?>

                <span class="final-resolved">Resolved</span>

                <?php elseif ($row['status'] == 'Not Resolved'): ?>

                <span class="final-not">Not Resolved</span>

                <?php endif; ?>

                <?php
                echo "</td>";
                echo "</tr>";
            }
                ?>
        </table>
    </div>
</body>
</html>