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
    $roll = $_GET['roll_no'];
    $sql = "SELECT * FROM students WHERE roll_no='$roll'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(isset($_POST['update']))
    {
        $name = $_POST['name'];
        $newroll = $_POST['roll_no'];
        $stream = $_POST['stream'];
        $phone = $_POST['phone'];

        $sql = "UPDATE students SET

        name='$name',
        roll_no='$newroll',
        stream='$stream',
        phone='$phone'

        WHERE roll_no='$roll'";
        mysqli_query($conn, $sql);
        header("location:display_student.php");
    }
?>


<style>
.content
{
    padding:40px;
    display:flex;
    justify-content:center;
    align-items:flex-start;
}

.edit-card
{
    background:white;
    padding:30px 40px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
    width:450px;
}

.edit-card h2
{
    text-align:center;
    margin-bottom:20px;
    color:#2E7D32;
}

.edit-card input
{
    width:94%;
    padding:12px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:15px;
}

.edit-card select
{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:6px;
    border:1px solid #ccc;
    font-size:15px;
}

.edit-card button
{
    width:100%;
    padding:12px;
    background:#2E7D32;
    color:white;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

.edit-card button:hover
{
    background:#66BB6A;
    color:#2E7D32;
}
</style>

<div class="content">
    <div class="edit-card">
        <h2>Edit Student</h2>
            <form method="POST">
                <input name="name" value="<?php echo $row['name'];?>" placeholder="Student Name" required>
                <input name="roll_no" value="<?php echo $row['roll_no'];?>" placeholder="Roll Number" required>

                <select name="stream" required>
                    <option value="B.Tech CSE" <?php if($row['stream']=="B.Tech CSE") echo "selected";?>> B.Tech CSE </option>
                    <option value="B.Tech CSSE" <?php if($row['stream']=="B.Tech CSSE") echo "selected";?>> B.Tech CSSE </option>
                    <option value="B.Tech IT" <?php if($row['stream']=="B.Tech IT") echo "selected";?>> B.Tech IT </option>
                    <option value="B.Tech ECE" <?php if($row['stream']=="B.Tech ECE") echo "selected";?>> B.Tech ECE </option>
                    <option value="B.Tech Mechanical" <?php if($row['stream']=="B.Tech Mechanical") echo "selected";?>> B.Tech Mechanical </option>
                    <option value="B.Tech Civil" <?php if($row['stream']=="B.Tech Civil") echo "selected";?>> B.Tech Civil </option>
                    <option value="MBA" <?php if($row['stream']=="MBA") echo "selected";?>> MBA </option>
                    <option value="MCA" <?php if($row['stream']=="MCA") echo "selected";?>> MCA </option>
                </select>



                    <input name="phone" value="<?php echo $row['phone'];?>" placeholder="Phone Number">

                    <button name="update"> Update Student </button>
            </form>
    </div>
</div>