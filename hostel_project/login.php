<?php
    session_start();
    $page_title = "Admin Login | Scholars' Nest Hostel";
    include 'includes/db.php';
    $error = "";
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM admin WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
            if($result->num_rows == 1)
                {
                    $row = $result->fetch_assoc();
                    if($password == $row['password'])
                        {
                        $_SESSION['admin'] = $username;
                        header("Location: admin/dashboard.php");
                        exit();
                        }
                    else
                        {
                        $error = "Invalid Password";
                        }
                }
            else
                {
                    $error = "Invalid Username";
                }
    }
?>

<style>
.login-container
{
    display:flex;
    justify-content:center;
    align-items:center;
    height:80vh;
}

.login-box
{
    background:white;
    padding:40px;
    border-radius:15px;
    width:350px;
    box-shadow:0 20px 40px rgba(0,0,0,0.3);
}

.login-box h2
{
    text-align:center;
    margin-bottom:20px;
}

input
{
    width:93%;
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ccc;
}

button
{
    width:100%;
    padding:12px;
    background:#2E7D32;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover
{
    background:#66BB6A;
    color:black;
}

.error
{
    color:red;
    text-align:center;
    margin-bottom:10px;
}
</style>


<div class="content">
    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
                <div class="error">
                    <?php echo $error; ?>
                </div>
                
                <form method="POST">
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button name="login">Login</button>
                </form>
        </div>
    </div>
</div>
