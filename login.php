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
	$codeContents = 'Name:'.$user_name."\n"; 
	$codeContents .= 'Email:'.$email."\n"; 
	foreach($_POST['event'] as $event){
		$codeContents .= 'Event:'.$event."\n";
	}
	$codeContents .= 'Phone:'.$phone."\n"; 
	$conn = new mysqli('localhost', 'root', '', 'fest');
	$events = "SELECT * FROM events ";
	$results = $conn->query($events);
	// $codeContents = 'mailto:'.$email.'?user_name='.urlencode($user_name).'&phone='.urlencode($phone); 
	QRcode::png($codeContents, $tempDir.''.$filename.'.png', QR_ECLEVEL_L, 5);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Logo</a>  
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Link 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 2</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link 3</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
  <h2>More Equal Columns</h2>
  <div class="row">
    <div class="col bg-success">
      <div class="myoutput">
        <h3><strong>Quick Response (QR) Code Generator</strong></h3>
        <div class="input-field">
          <h3>Please Fill-out All Fields</h3>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="user_name" style="width:20em;" placeholder="Your Name" value="<?php echo @$user_name; ?>" required/>
             </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="mail" style="width:20em;" placeholder="Enter your Email" value="<?php echo @$email; ?>" required />
            </div>
            <div class="form-group">
            <label>Phone Number</label>
            <input type="number" class="form-control" name="phone" style="width:20em;" value="<?php echo @$phone; ?>" required placeholder="Enter your message"></textarea>
            </div>
			<button type="button" class="btn " id="show_events">Select Events</button>
			<div class="form-group "style="display:none;" id="events">
			<?php
			if ($result->num_rows > 0) {
				while($ads = $result->fetch_assoc()) { ?>
				<input type="checkbox" name="event[]" value="<?php echo $ads['event_name'];?>"> <?php echo $ads['event_name'];?><br><?php
				}
			}?>	
			<button type="button" class="btn " id="hide_events">Hide</button>
			</div>
            <div class="form-group">
              <input type="submit" name="submit" class="btn btn-primary submitBtn" style="width:20em; margin:0;" />
            </div>
          </form>
        </div>
      </div>
    </div>
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
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
