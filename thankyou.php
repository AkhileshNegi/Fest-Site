<?php
include('libs/phpqrcode/qrlib.php'); 
$conn = new mysqli('localhost', 'root', '', 'fest');
$sql="SELECT * FROM events";
$result = $conn->query($sql);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
function getUsernameFromEmail($email) {
	$find = '@';
	$pos = strpos($email, $find);
	$username = substr($email, 0, $pos);
	return $username;
}
if(isset($_POST['submit']) ) {
	$tempDir = 'temp/'; 
	$email = $_POST['mail'];
	$user_name =  $_POST['user_name'];
	$filename = getUsernameFromEmail($email);
	$phone =  $_POST['phone'];
  $sql="SELECT * FROM participant_details WHERE email='$email'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    die();
  }
  else{
    $codeContents = 'Name:'.$user_name."\n"; 
  	$codeContents .= 'Email:'.$email."\n"; 
    $participant_details = "INSERT INTO participant_details (name, email, phone) VALUES ('$user_name','$email','$phone')";
    if ($conn->query($participant_details) === TRUE) {
      echo "You have successfully registered \n";
    } else {
        echo "Error: " . $participant_details . "<br>" . $conn->error;
      }
    $codeContents .= 'Phone:'.$phone.""; 
    
    if(isset($_POST['event']) ) {
    	foreach($_POST['event'] as $event){
    		$codeContents .= 'Event:'.$event."\n";
        $get_event="SELECT event_id FROM events WHERE event_name='$event'";
        $result_event = $conn->query($get_event);
        $event_id = $result_event->fetch_assoc();
        $id = $event_id['event_id'];
      

        $unique_id="SELECT unique_id FROM participant_details WHERE email='$email'";
        $result_id = $conn->query($unique_id);
        $user_id = $result_id->fetch_assoc();
        $userid = $user_id['unique_id'];

        $event_registration = "INSERT INTO participants (unique_id, name, event_id) VALUES ('$userid','$user_name','$id')";
        if ($conn->query($event_registration) === TRUE) {
        echo "You have successfully registered for the event";
        } else {
          echo "Error: " . $event_registration . "<br>" . $conn->error;
        }
      }
    }	
    QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Thankyou</title>
</head>
<body>

    <div class="col bg-warning">
      <?php
      if(!isset($filename)){
        $filename = "author";
      }
      ?>
      <div class="qr-field">
        <h2 style="text-align:center">QR Code Result: </h2>
        <center>
          <div class="qrframe" style="border:2px solid black; width:210px; height:210px;">
              <?php echo '<img src="temp/'. @$filename.'.png" style="width:200px; height:200px;"><br>'; ?>
          </div>
          <a class="btn btn-primary submitBtn" style="width:210px; margin:5px 0;" href="download.php?file=<?php echo $filename; ?>.png ">Download QR Code</a>
        </center>
      </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/main.js"></script>  
</body>
</html>