<?php
$id = $_POST['id'] ;
$conn = new mysqli('localhost', 'root', '', 'fest');
$sql="SELECT * FROM events";
$sql = "SELECT * FROM events t1 LEFT JOIN participants t2 ON t1.event_id = t2.event_id WHERE t2.unique_id = '$id' UNION SELECT * FROM events t1 RIGHT JOIN participants t2 ON t1.event_id = t2.event_id WHERE t2.unique_id = '$id'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result))
    {
    $events[] = $row['event_name']; 
}
echo json_encode($events);
?>