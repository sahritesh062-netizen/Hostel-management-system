<?php
include 'includes/db.php';

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM complaints WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
$complaint = $_POST['complaint'];

mysqli_query($conn,"UPDATE complaints SET complaint='$complaint' WHERE id='$id'");

header("Location:view_complaint.php?roll_no=".$row['roll_no']);
exit();
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Complaint</title>

<style>

body{
font-family:Segoe UI, Arial;
background:#eef2f7;
margin:0;
padding:0;
}

.container{
width:520px;
margin:80px auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 0 12px rgba(0,0,0,0.15);
}

h2{
text-align:center;
color:#2E7D32;
margin-bottom:20px;
}

label{
font-weight:bold;
color:#333;
}

input{
width:100%;
padding:8px;
margin:6px 0 15px;
border:1px solid #ccc;
border-radius:5px;
background:#f5f5f5;
}

textarea{
width:100%;
height:120px;
padding:10px;
border:1px solid #ccc;
border-radius:5px;
resize:none;
font-size:14px;
}

.button-row{
margin-top:15px;
display:flex;
gap:10px;
}

.update-btn{
padding:10px 16px;
background:#007bff;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
font-size:15px;
}

.update-btn:hover{
background:#0056b3;
}

.cancel-btn{
padding:10px 16px;
background:#6c757d;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
font-size:15px;
text-decoration:none;
display:inline-block;
text-align:center;
}

.cancel-btn:hover{
background:#545b62;
}

</style>

</head>

<body>

<div class="container">

<h2>Edit Complaint</h2>

<form method="POST">

<label>Name</label>
<input type="text" value="<?php echo $row['name']; ?>" readonly>

<label>Roll Number</label>
<input type="text" value="<?php echo $row['roll_no']; ?>" readonly>

<label>Room Number</label>
<input type="text" value="<?php echo $row['room_number']; ?>" readonly>

<label>Complaint</label>
<textarea name="complaint"><?php echo $row['complaint']; ?></textarea>

<div class="button-row">

<button class="update-btn" name="update">
Update Complaint
</button>

<a class="cancel-btn" href="view_complaint.php?roll_no=<?php echo $row['roll_no']; ?>">
Cancel
</a>

</div>

</form>

</div>

</body>

</html>