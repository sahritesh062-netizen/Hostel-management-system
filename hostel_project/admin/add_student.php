<html>
    <head>
        <title>Add Student</title>
    </head>
    <style>
        body{
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg,#eef2f7,#d9e4f5);
            margin:0;
            padding:0;
        }

        .content{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-direction:column;
            min-height:80vh;
        }

        .page-title{
            font-size:30px;
            font-weight:600;
            color:#2E7D32;
            margin-bottom:25px;
            letter-spacing:1px;
        }


        .form-card{
            background:white;
            padding:40px;
            border-radius:14px;
            width:420px;
            box-shadow:0 12px 35px rgba(0,0,0,0.15);
            transition:0.3s;
        }

        .form-card input,
        .form-card select{
            width:100%;
            padding:12px 14px;
            margin-bottom:15px;
            border-radius:8px;
            border:1px solid #ccc;
            font-size:14px;
            transition:all 0.25s ease;
        }

        .form-card input:focus,
        .form-card select:focus{
            border-color:#2E7D32;
            box-shadow:0 0 6px rgba(10,31,68,0.2);
            outline:none;
        }

        .form-card button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:linear-gradient(135deg,#2E7D32,#142f66);
            color:white;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:all 0.25s ease;
        }

        .form-card button:hover{
            background:linear-gradient(135deg,#142f66,#1c3c82);
            transform:translateY(-2px);
            box-shadow:0 5px 12px rgba(0,0,0,0.2);
        }

        .form-card p{
            text-align:center;
            font-size:14px;
            margin-top:10px;
        }


        @media (max-width:500px){

            .form-card{
                width:90%;
                padding:30px;
            }

            .page-title{
                font-size:24px;
        }

        }
    </style>
<body>

<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header("Location: ../login.php");
        exit();
    }
    include '../includes/db.php';
    $message = "";

    if(isset($_POST['add']))
        {
        $name = trim($_POST['name']);
        $roll = trim($_POST['roll_no']);
        $stream = trim($_POST['stream']);
        $phone = trim($_POST['phone']);
        $room = trim($_POST['room_number']);


        if($name=="" || $roll=="" || $stream=="" || $room=="")
        {
            $message = "Please fill all required fields";
        }
        else
        {
            /* CHECK DUPLICATE ROLL */
            $check = $conn->prepare("SELECT roll_no FROM students WHERE roll_no=?");
            $check->bind_param("s",$roll);
            $check->execute();
            $result = $check->get_result();

            if($result->num_rows > 0)
            {
                $message = "Roll Number already exists";
            }
            else
            {
                $stmt = $conn->prepare("
                    INSERT INTO students
                    (name, roll_no, stream, phone, room_number)
                    VALUES
                    (?,?,?,?,?)
                ");
                $stmt->bind_param("sssss",
                    $name,
                    $roll,
                    $stream,
                    $phone,
                    $room
                );


                if($stmt->execute())
                    $message = "Student Added Successfully";

                else
                    $message = "Error adding student";


                $stmt->close();

            }
            $check->close();
        }
    }
?>


<div class="content content-center">
    <h2 class="page-title">Add Student</h2>
        <div class="form-card">
            <form method="POST">
                <input type="text" name="name" placeholder="Student Name" required>

                <input type="text" name="roll_no" placeholder="Roll Number" required>
                
                <select name="stream" required>
                    <option value="" disabled selected>Choose Your Stream </option>
                    <option>B.Tech CSE</option>
                    <option>B.Tech IT</option>
                    <option>B.Tech CSSE</option>
                    <option>B.Tech ECE</option>
                    <option>B.Tech Mechanical</option>
                    <option>B.Tech Civil</option>
                    <option>MBA</option>
                    <option>MCA</option>
                </select>
                
                <input type="text" name="phone" placeholder="Phone Number">
                
                <select name="room_number" required>
                    <option value="" disabled selected> Choose Room Number </option>
                    <?php
                        $sql = "
                        SELECT room_number
                        FROM rooms
                        WHERE capacity >
                        (
                        SELECT COUNT(*)
                        FROM students
                        WHERE students.room_number = rooms.room_number
                        )
                        ORDER BY room_number
                        ";

                        $result = mysqli_query($conn,$sql);

                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option value='".$row['room_number']."'>";
                            echo $row['room_number'];
                            echo "</option>";
                        }
                    ?>
                </select>
                
                <button type="submit" name="add"> Add Student </button>
            </form>

            <?php if($message!="") { ?>
            <p style="margin-top:15px; font-weight:bold; color:#2E7D32;">
                <?php echo $message; ?>
            </p>
            <?php } ?>
        </div>
    </div>
</body>
</html>

