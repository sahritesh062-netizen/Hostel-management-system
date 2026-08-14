<!DOCTYPE html>
<html>

<head>

<title>Complaint Dashboard</title>

<style>

body{
font-family:Arial;
background:#f4f6fa;
margin:0;
padding:0;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.container{
text-align:center;
background:white;
padding:40px;
border-radius:10px;
box-shadow:0 0 15px rgba(0,0,0,0.1);
width:400px;
}

h2{
margin-bottom:30px;
color:#2E7D32;
}

.btn{
display:block;
text-decoration:none;
margin:15px 0;
padding:15px;
border-radius:6px;
font-size:16px;
color:white;
}

.register{
background:#007bff;
}

.register:hover{
background:#0056b3;
}

.status{
background:#28a745;
}

.status:hover{
background:#1e7e34;
}

</style>

</head>

<body>

<div class="container">

<h2>Complaint Dashboard</h2>

<a class="btn register" href="register_complaints.php">
Register Complaint
</a>

<a class="btn status" href="view_complaint.php">
View Complaint Status
</a>

</div>

</body>

</html>