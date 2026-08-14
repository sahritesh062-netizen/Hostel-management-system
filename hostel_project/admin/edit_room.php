<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location: ../login.php");
exit();
}

include '../includes/db.php';

/* TRANSFER STUDENT */

if(isset($_POST['transfer']))
{

$roll=$_POST['roll_no'];
$new_room=$_POST['room_number'];

/* CHECK ROOM CAPACITY */

$capacity=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT capacity FROM rooms WHERE room_number='$new_room'"))['capacity'];

$occupied=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM students WHERE room_number='$new_room'"))['total'];

if($occupied < $capacity)
{

mysqli_query($conn,
"UPDATE students SET room_number='$new_room' WHERE roll_no='$roll'");

echo "<script>alert('Student transferred successfully');</script>";

}
else
{

echo "<script>alert('Selected room is full');</script>";

}

}

/* FETCH STUDENTS */

$students=mysqli_query($conn,"SELECT * FROM students");

/* FETCH ROOMS */

$rooms=mysqli_query($conn,"SELECT * FROM rooms");
?>

<!DOCTYPE html>
<html>

<head>

<title>Transfer Student</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-4">

<h3>Student Room Management</h3>

<div class="card p-4 shadow">

<form method="POST">

<label>Select Student</label>

<select name="roll_no" class="form-control mb-3">

<?php
while($s=mysqli_fetch_assoc($students))
{
echo "<option value='".$s['roll_no']."'>".$s['name']." (".$s['roll_no'].") - Room ".$s['room_number']."</option>";
}
?>

</select>


<label>Select New Room</label>

<select name="room_number" class="form-control mb-3">

<?php

while($r=mysqli_fetch_assoc($rooms))
{

$room_no=$r['room_number'];

$capacity=$r['capacity'];

$occupied=mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as total FROM students WHERE room_number='$room_no'"))['total'];

$available=$capacity-$occupied;

echo "<option value='".$room_no."'>Room ".$room_no." (".$available." seats available)</option>";

}

?>

</select>


<button name="transfer"
class="btn btn-primary w-100">

Transfer Student

</button>

</form>

</div>

</div>

</body>

</html>