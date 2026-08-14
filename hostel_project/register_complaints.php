<?php
include 'includes/db.php';

$message = "";

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $roll = $_POST['roll_no'];
    $room = $_POST['room_number'];
    $complaint = $_POST['complaint'];

    /* CHECK IF STUDENT EXISTS */

    $check = "SELECT * FROM students 
              WHERE name='$name' 
              AND roll_no='$roll' 
              AND room_number='$room'";

    $result = mysqli_query($conn,$check);

    if(mysqli_num_rows($result) == 0)
    {
        $message = "❌ Student not found in hostel records.";
    }
    else
    {
        /* INSERT COMPLAINT */

        $sql = "INSERT INTO complaints(name,roll_no,room_number,complaint,status)
                VALUES('$name','$roll','$room','$complaint','Pending')";

        mysqli_query($conn,$sql);

        $message = "✅ Complaint submitted successfully.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Register Complaint</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>
/* Page Background */

body{
margin:0;
padding:0;
font-family:'Segoe UI', Tahoma, sans-serif;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}


/* Form Card */

.box{
height: 85%;
width:500px;
background:#94ccec;;
padding:35px;
border-radius:12px;
box-shadow:0 15px 30px rgba(0,0,0,0.2);
animation:fadeIn 0.6s ease;
}


/* Title */

h2{
text-align:center;
margin-bottom:20px;
color:#1c3b6f;
font-weight:600;
letter-spacing:1px;
}


/* Input Fields */

input,
textarea{
width:95%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:6px;
font-size:14px;
transition:all 0.3s ease;
}

select{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:6px;
font-size:14px;
transition:all 0.3s ease;
}

/* Input Focus Effect */

input:focus,
select:focus,
textarea:focus{
outline:none;
border-color:#4b6cb7;
box-shadow:0 0 5px rgba(75,108,183,0.5);
}


/* Textarea */

textarea{
resize:none;
height:90px;
}


/* Submit Button */

button{
width:100%;
padding:12px;
margin-top:12px;
border:none;
border-radius:6px;
background:linear-gradient(90deg,#4b6cb7,#1c3b6f);
color:white;
font-size:15px;
cursor:pointer;
transition:all 0.3s ease;
}


/* Button Hover */

button:hover{
background:linear-gradient(90deg,#1c3b6f,#4b6cb7);
transform:scale(1.03);
}


/* Message */

.msg{
text-align:center;
font-weight:bold;
margin-bottom:10px;
color:#e63946;
}


/* Smooth Entry Animation */

@keyframes fadeIn{
from{
opacity:0;
transform:translateY(-20px);
}
to{
opacity:1;
transform:translateY(0);
}
}
</style>

<script>

function validateForm(){

    var name = document.forms["compForm"]["name"].value;
    var roll = document.forms["compForm"]["roll_no"].value;
    var room = document.forms["compForm"]["room_number"].value;
    var comp = document.forms["compForm"]["complaint"].value;

    if(name=="" || roll=="" || room=="" || comp==""){
        alert("All fields are required!");
        return false;
    }

    if(comp.length < 10){
        alert("Complaint must be at least 10 characters!");
        return false;
    }

    return true;
}

</script>

</head>

<body>

<div class="box">

<h2>Register Complaint</h2>

<div class="msg"><?php echo $message; ?></div>

<form name="compForm" method="POST" onsubmit="return validateForm()">

<input type="text" name="name" placeholder="Student Name" required>

<input type="text" name="roll_no" placeholder="Roll Number" required>

<select name="room_number" required>

<option value="" disabled selected>Select Room Number</option>

<?php

$sql = "SELECT room_number FROM rooms ORDER BY room_number";

$result = mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result))
{
echo "<option>".$row['room_number']."</option>";
}

?>

</select>

<textarea name="complaint" placeholder="Write Complaint" required></textarea>

<button type="submit" name="submit">
Submit Complaint
</button>

</form>

</div>

</body>
</html>