<?php
function getRoomOccupancy($conn, $room_id) {
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM students WHERE room_id = $room_id");
    $data = mysqli_fetch_assoc($query);
    return $data['total'];
}
?>
