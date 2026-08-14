<html>
    <head>
        <title>About us</title>
        <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
$page_title = "Mess Menu | Scholars' Nest Hostel";
include 'includes/db.php';

$today = date("l"); // Get current day
?>

<div class="content">

    <div class="card">
        <h2>🍽 Weekly Mess Menu</h2>
        <p>Below is the structured weekly mess schedule for all residents.</p>
    </div>

    <div class="menu-table-container">
        <table class="menu-table">
            <tr>
                <th>Day</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Snacks</th>
                <th>Dinner</th>
            </tr>

            <?php
            $result = mysqli_query($conn, "SELECT * FROM mess_menu");

            while ($row = mysqli_fetch_assoc($result)) {

                $highlight = ($row['day'] == $today) ? "today-row" : "";

                echo "<tr class='$highlight'>
                        <td><strong>{$row['day']}</strong></td>
                        <td>{$row['breakfast']}</td>
                        <td>{$row['lunch']}</td>
                        <td>{$row['snacks']}</td>
                        <td>{$row['dinner']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

</div>

