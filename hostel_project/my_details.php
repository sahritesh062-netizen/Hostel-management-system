<html>
    <head>
        <title>About us</title>
        <link rel="stylesheet" href="assets/css/style.css">
</head>
<style>

/* MAIN CONTAINER */

.details-container
{
display:flex;
flex-direction:column;
align-items:center;
padding:40px;
}



/* TITLE */

.details-title
{
font-size:28px;
color:#2E7D32;
margin-bottom:25px;
}



/* CARD */

.details-card
{
background:white;

width:100%;
max-width:600px;

padding:30px;

border-radius:15px;

box-shadow:0 10px 25px rgba(0,0,0,0.1);

margin-bottom:25px;
}



/* INPUT */

.details-card input
{
width:100%;
padding:14px;
margin-bottom:15px;
border-radius:8px;
border:1px solid #ccc;
}



/* BUTTON */

.details-card button
{
width:100%;
padding:14px;
background:#2E7D32;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
}

.details-card button:hover
{
background:#66BB6A;
color:#2E7D32;
}



/* ROW */

.result-row
{
padding:10px 0;
border-bottom:1px solid #eee;
}



/* SECTION TITLE */

.section-title
{
margin-bottom:10px;
color:#2E7D32;
font-size:18px;
}



/* ERROR */

.error
{
color:red;
text-align:center;
}

</style>

<body>
    <?php

$page_title = "My Details | Scholars' Nest Hostel";

include 'includes/db.php';

$student = null;
$room = null;
$roommates = [];
$message = "";

if(isset($_POST['search']))
{

$roll = trim($_POST['roll_no']);


/* =====================
FETCH STUDENT
===================== */

$stmt = $conn->prepare("
SELECT s.*, r.block, r.floor, r.ac_type, r.capacity
FROM students s
JOIN rooms r ON s.room_number = r.room_number
WHERE s.roll_no = ?
");

$stmt->bind_param("s",$roll);

$stmt->execute();

$result = $stmt->get_result();


if($result->num_rows > 0)
{

$student = $result->fetch_assoc();


/* =====================
FETCH ROOMMATES
===================== */

$stmt2 = $conn->prepare("
SELECT name, roll_no
FROM students
WHERE room_number = ?
AND roll_no != ?
");

$stmt2->bind_param("ss",
$student['room_number'],
$student['roll_no']
);

$stmt2->execute();

$roommates = $stmt2->get_result();

}
else
{
$message = "No student found with this Roll Number.";
}

}

?>







<div class="content">

<div class="details-container">

<div class="details-title">

My Hostel Profile

</div>



<!-- SEARCH -->

<div class="details-card">

<form method="POST">

<input type="text"
name="roll_no"
placeholder="Enter your Roll Number"
required>

<button name="search">

Search Profile

</button>

</form>

</div>



<!-- ERROR -->

<?php if($message): ?>

<div class="details-card error">

<?php echo $message; ?>

</div>

<?php endif; ?>



<!-- STUDENT INFO -->

<?php if($student): ?>

<div class="details-card">

<div class="section-title">

Student Information

</div>


<div class="result-row">

<strong>Name:</strong>

<?php echo $student['name']; ?>

</div>


<div class="result-row">

<strong>Roll Number:</strong>

<?php echo $student['roll_no']; ?>

</div>


<div class="result-row">

<strong>Stream:</strong>

<?php echo $student['stream']; ?>

</div>


<div class="result-row">

<strong>Phone:</strong>

<?php echo $student['phone']; ?>

</div>

</div>



<!-- ROOM INFO -->

<div class="details-card">

<div class="section-title">

Room Information

</div>


<div class="result-row">

<strong>Room Number:</strong>

<?php echo $student['room_number']; ?>

</div>


<div class="result-row">

<strong>Block:</strong>

<?php echo $student['block']; ?>

</div>


<div class="result-row">

<strong>Floor:</strong>

<?php echo $student['floor']; ?>

</div>


<div class="result-row">

<strong>Type:</strong>

<?php echo $student['ac_type']; ?>

</div>


<div class="result-row">

<strong>Capacity:</strong>

<?php echo $student['capacity']; ?>

Seater

</div>

</div>



<!-- ROOMMATES -->

<div class="details-card">

<div class="section-title">

Roommates

</div>


<?php

if($roommates->num_rows > 0)
{

while($mate = $roommates->fetch_assoc())
{

echo "<div class='result-row'>";

echo $mate['name'] . " (" . $mate['roll_no'] . ")";

echo "</div>";

}

}
else
{

echo "<div class='result-row'>No roommates</div>";

}

?>

</div>

<?php endif; ?>


</div>

</div>