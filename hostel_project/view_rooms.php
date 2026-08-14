<html>
    <head>
        <title>About us</title>
</head>
<style>
.room-container
{
max-width: 1500px;
padding: 20px;
}

.room-grid
{
display: grid;
grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
gap: 25px;
}

.room-card
{
background: #ffffff;
padding: 20px;
border-radius: 15px;
box-shadow: 0 10px 25px rgba(0,0,0,0.08);
transition: 0.3s;
}

.room-card:hover
{
transform: translateY(-6px);
box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.room-header
{
font-size: 18px;
font-weight: bold;
color: #2E7D32;
margin-bottom: 10px;
}

.room-meta
{
margin-bottom: 6px;
}

.available
{
color: green;
font-weight: bold;
}

.full
{
color: red;
font-weight: bold;
}

.student-list
{
margin-top: 10px;
font-size: 13px;
}
</style>
<body>
    
<?php
$page_title = "View Rooms | Scholars' Nest Hostel";

include 'includes/db.php';

$query = "
SELECT r.block,
       r.floor,
       r.room_number,
       r.capacity,
       r.ac_type,
       COUNT(s.roll_no) AS filled_seats
FROM rooms r
LEFT JOIN students s
ON r.room_number = s.room_number
GROUP BY r.block, r.floor, r.room_number, r.capacity, r.ac_type
ORDER BY r.block, r.floor, r.room_number
";

$result = $conn->query($query);
/* ERROR CHECK */
if (!$result)
{
    die("SQL Error: " . $conn->error);
}
?>


<div class="content">
<div class="room-container">
<h2>🏢 Hostel Room Availability</h2>

<div class="room-grid">
<?php
while($row = $result->fetch_assoc()):
$available = $row['capacity'] - $row['filled_seats'];
$is_full = ($available <= 0);
?>

<div class="room-card">
<div class="room-header">
Block <?php echo htmlspecialchars($row['block']); ?>
-
Room <?php echo htmlspecialchars($row['room_number']); ?>
</div>

<div class="room-meta">
Floor : <?php echo htmlspecialchars($row['floor']); ?>
</div>

<div class="room-meta">
Capacity : <?php echo htmlspecialchars($row['capacity']); ?>
Seater
</div>

<div class="room-meta">
Type : <?php echo htmlspecialchars($row['ac_type']); ?>
</div>
<div class="room-meta">
Filled :
<?php echo $row['filled_seats']; ?>
/
<?php echo $row['capacity']; ?>
</div>

<?php if($is_full): ?>
<div class="full">
🔒 Completely Full
</div>
<?php else: ?>
<div class="available">
Seats Available :
<?php echo $available; ?>
</div>

<?php endif; ?>

<div class="student-list">
<strong>Students :</strong><br>

<?php
$student_query = $conn->prepare("
SELECT name, roll_no
FROM students
WHERE room_number = ?
");
$student_query->bind_param("s", $row['room_number']);
$student_query->execute();
$students = $student_query->get_result();

if ($students && $students->num_rows > 0)
{
while($stu = $students->fetch_assoc())
{
echo htmlspecialchars($stu['name'])
. " ("
. htmlspecialchars($stu['roll_no'])
. ")<br>";
}
}
else
{
echo "No students allotted.";
}
$student_query->close();
?>
</div>
</div>
<?php endwhile; ?>
</div>
</div>
</div>
