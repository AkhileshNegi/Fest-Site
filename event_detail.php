<?php
$id = $_POST['id'] ;
$conn = new mysqli('localhost', 'root', '', 'fest');
$sql = "SELECT * FROM events WHERE event_id= '$id'";
$result = mysqli_query($conn,$sql);
$event = mysqli_fetch_assoc($result);
echo json_encode($event);
?>