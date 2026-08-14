<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html>

<head>

<title>View Complaint Status</title>

<style>

body{
font-family:Segoe UI, Arial;
background:#eef2f7;
margin:0;
padding:0;
}

.container{
width:1000px;
margin:60px auto;
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

.search-box{
text-align:center;
margin-bottom:20px;
}

input{
padding:10px;
width:250px;
border:1px solid #ccc;
border-radius:5px;
}

button{
padding:10px 16px;
background:#2E7D32;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#66BB6A;
color:#2E7D32;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th, td{
padding:14px;
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

tr:hover{
background:#f1f4fb;
}

.pending{
color:#dc3545;
font-weight:bold;
}

.resolved{
color:#28a745;
font-weight:bold;
}

.action-buttons{
display:flex;
justify-content:center;
gap:10px;
}

.edit-btn{
display:inline-flex;
align-items:center;
gap:5px;
background:#007bff;
padding:6px 12px;
color:white;
text-decoration:none;
border-radius:5px;
font-size:14px;
}

.edit-btn:hover{
background:#0056b3;
}

.delete-btn{
display:inline-flex;
align-items:center;
gap:5px;
background:#dc3545;
padding:6px 12px;
color:white;
text-decoration:none;
border-radius:5px;
font-size:14px;
}

.delete-btn:hover{
background:#b52a37;
}

</style>

</head>

<body>

<div class="container">

<h2>View Complaint Status</h2>

<div class="search-box">

<form method="GET">

<input type="text" name="roll_no" placeholder="Enter Roll Number" required>

<button type="submit">Search</button>

</form>

</div>

<?php

if(isset($_GET['roll_no']))
{

$roll = $_GET['roll_no'];

$sql = "SELECT * FROM complaints
        WHERE roll_no='$roll'
        ORDER BY created_at DESC";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0)
{
echo "<p style='text-align:center;color:red;'>No complaints found.</p>";
}
else
{

echo "<table>";

echo "<tr>
<th>Roll Number</th>
<th>Name</th>
<th>Room No</th>
<th>Complaint</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>";

while($row=mysqli_fetch_assoc($result))
{

$statusClass = ($row['status']=="Resolved") ? "resolved" : "pending";

echo "<tr>";

echo "<td>".$row['roll_no']."</td>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['room_number']."</td>";

echo "<td>".$row['complaint']."</td>";

echo "<td class='".$statusClass."'>".$row['status']."</td>";

echo "<td>".$row['created_at']."</td>";

echo "<td>";

if($row['status']=="Pending")
{

echo "<div class='action-buttons'>";

echo "<a class='edit-btn' href='edit_complaint.php?id=".$row['id']."'>✏ Edit</a>";

echo "<a class='delete-btn' href='delete_complaint.php?id=".$row['id']."' 
onclick=\"return confirm('Delete this complaint?')\">🗑 Delete</a>";

echo "</div>";

}
else
{
echo "-";
}

echo "</td>";

echo "</tr>";

}

echo "</table>";

}

}

?>

</div>

</body>

</html>