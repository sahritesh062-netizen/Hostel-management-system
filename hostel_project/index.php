<html>
    <head>
        <title>About us</title>
        <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
$page_title = "About Us | Scholars' Nest Hostel";
include 'includes/db.php';

/* ============================
   FETCH STATISTICS
============================ */

// Total Rooms
$total_rooms = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM rooms");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_rooms = $row['total'];
}
// Total Students
$total_students = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_students = $row['total'];
}

// AC Rooms
$ac_rooms = 0;
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM rooms WHERE ac_type='AC'");
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $ac_rooms = $row['total'];
}

// Available Rooms
$available_rooms = 0;

$query = "
SELECT 
    r.room_number,
    r.capacity,
    COUNT(s.roll_no) as total_students
FROM rooms r
LEFT JOIN students s 
ON r.room_number = s.room_number
GROUP BY r.room_number, r.capacity
";

$result = mysqli_query($conn, $query);

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {

        if ($row['total_students'] < $row['capacity']) {

            $available_rooms++;

        }

    }

}

?>

<div class="content">

    <!-- Welcome Section -->
    <div class="card">
        <h2>Welcome to Scholars' Nest Hostel</h2>
        <p>
            Scholars' Nest Hostel offers a secure and comfortable living 
            environment designed for academic excellence. With structured 
            facilities, hygienic mess services, and organized room allotment, 
            we ensure a disciplined and peaceful stay for all residents.
        </p>
    </div>

    <!-- Important Notice -->
    <div class="alert-box">
        ⚠ <strong>Important Notice:</strong> Hostel In-Time is strictly 
        <strong>8:00 PM</strong>. Late entry without prior permission is not allowed.
    </div>

    <!-- Statistics -->
    <div class="stats-container">

        <div class="stat-card">
            <h3><?php echo $total_rooms; ?></h3>
            <p>Total Rooms</p>
        </div>

        <div class="stat-card">
            <h3><?php echo $ac_rooms; ?></h3>
            <p>AC Rooms</p>
        </div>

        <div class="stat-card">
            <h3><?php echo $total_students; ?></h3>
            <p>Total Students</p>
        </div>

        <div class="stat-card">
            <h3><?php echo $available_rooms; ?></h3>
            <p>Rooms Available</p>
        </div>

    </div>

    <!-- Information Section -->
    <div class="info-container">

        <!-- Hostel Structure -->
        <div class="info-card">
            <h3>🏢 Hostel Structure</h3>
            <ul>
                <li><strong>Block A:</strong> 2-Seater Rooms | 5 Floors | 10 Rooms per Floor</li>
                <li><strong>Block B:</strong> 3-Seater Rooms | 5 Floors | 8 Rooms per Floor</li>
                <li><strong>AC Rooms:</strong> 4th & 5th Floors</li>
                <li>Total Rooms: 90</li>
            </ul>
        </div>

        <!-- Facilities -->
        <div class="info-card">
            <h3>✨ Facilities Provided</h3>
            <ul>
                <li>24x7 Security Surveillance</li>
                <li>Hygienic Mess Services</li>
                <li>High-Speed Wi-Fi</li>
                <li>Power Backup</li>
                <li>Regular Maintenance</li>
            </ul>
        </div>

        <!-- Rules -->
        <div class="info-card">
            <h3>📜 Hostel Rules</h3>
            <ul>
                <li>In-Time: <strong>8:00 PM</strong></li>
                <li>ID Card Mandatory</li>
                <li>No loud music after 10 PM</li>
                <li>Maintain Room Cleanliness</li>
                <li>Strict Discipline Required</li>
            </ul>
        </div>

    </div>

</div>

</body>
</html>
