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
?>

<link rel="stylesheet" href="/hostel5/assets/css/admin_style.css">
<div class="content">
    <div class="content-wrapper">
        <h2 class="page-title">Student Records</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Stream</th>
                    <th>Phone</th>
                    <th>Room</th>
                    <th>Action</th>
                </tr>

                <?php
                    $sql="SELECT * FROM students";
                    $result=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        echo "<tr>
                            <td>".$row['name']."</td>
                            <td>".$row['roll_no']."</td>
                            <td>".$row['stream']."</td>
                            <td>".$row['phone']."</td>
                            <td>".$row['room_number']."</td>
                            <td>
                                <a href='edit_student.php?roll_no=".$row['roll_no']."' class='btn-edit'>
                                Edit
                                </a>
                                <a href='delete_student.php?roll_no=".$row['roll_no']."' class='btn-delete'
                                onclick=\"return confirm('Are you sure you want to delete this student?');\">
                                Delete
                                </a>
                            </td>
                        </tr>";
                    }
                ?>
            </table>
        </div>
    </div>
</div>