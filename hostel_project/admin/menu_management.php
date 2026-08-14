<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit();
}

include '../includes/db.php';


/* UPDATE ALL MENU */
if(isset($_POST['update_all']))
{

    foreach($_POST['menu_id'] as $key => $menu_id)
    {

        $breakfast = mysqli_real_escape_string($conn,$_POST['breakfast'][$key]);
        $lunch     = mysqli_real_escape_string($conn,$_POST['lunch'][$key]);
        $snacks    = mysqli_real_escape_string($conn,$_POST['snacks'][$key]);
        $dinner    = mysqli_real_escape_string($conn,$_POST['dinner'][$key]);

        mysqli_query($conn,"
        UPDATE mess_menu SET
        breakfast='$breakfast',
        lunch='$lunch',
        snacks='$snacks',
        dinner='$dinner'
        WHERE menu_id='$menu_id'
        ");

    }

    header("Location: dashboard.php?msg=updated");
    exit();

}
?>


<style>

/* MAIN CONTENT */

.main-content{
padding:30px;
background:#f4f1e8;
min-height:600px;

}


/* CARD */

.menu-card{

background:white;
padding:20px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,0.1);

}


/* TABLE */

.menu-table{

width:100%;
border-collapse:collapse;

}


.menu-table thead{

background:#0d2a52;
color:white;
font-size:18px;

}


.menu-table th{

padding:15px;
text-align:center;

}


.menu-table td{

padding:12px;
border-bottom:1px solid #ddd;

}


.menu-table input{

width:100%;
border:1px solid #ccc;
padding:6px;
border-radius:5px;

}


/* DAY COLUMN */

.day{

font-weight:bold;
font-size:16px;

}


/* BUTTONS */

.update-btn{

background:#198754;
color:white;
padding:10px 25px;
border:none;
border-radius:6px;
font-size:16px;

}


.back-btn{

background:#6c757d;
color:white;
padding:10px 25px;
border-radius:6px;
text-decoration:none;
margin-left:10px;

}


.update-btn:hover{

background:#157347;

}

.back-btn:hover{

background:#565e64;
color:white;

}


</style>



<div class="main-content">


<div class="menu-card">


<h3 style="margin-bottom:20px;">Manage Mess Menu</h3>


<form method="POST">


<table class="menu-table">


<thead>

<tr>

<th>Day</th>

<th>Breakfast</th>

<th>Lunch</th>

<th>Snacks</th>

<th>Dinner</th>

</tr>

</thead>


<tbody>


<?php

$result=mysqli_query($conn,"
SELECT * FROM mess_menu
ORDER BY FIELD(day,'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')
");

while($row=mysqli_fetch_assoc($result))
{
?>


<tr>


<td class="day">

<?php echo $row['day']; ?>

<input type="hidden"
name="menu_id[]"
value="<?php echo $row['menu_id']; ?>">

</td>


<td>

<input type="text"
name="breakfast[]"
value="<?php echo htmlspecialchars($row['breakfast']); ?>">

</td>


<td>

<input type="text"
name="lunch[]"
value="<?php echo htmlspecialchars($row['lunch']); ?>">

</td>


<td>

<input type="text"
name="snacks[]"
value="<?php echo htmlspecialchars($row['snacks']); ?>">

</td>


<td>

<input type="text"
name="dinner[]"
value="<?php echo htmlspecialchars($row['dinner']); ?>">

</td>


</tr>


<?php } ?>


</tbody>


</table>



<br>


<button name="update_all" class="update-btn">

Update Full Menu

</button>



<a href="dashboard.php" class="back-btn">

Back

</a>


</form>


</div>


</div>