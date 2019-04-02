<?php
include('libs/phpqrcode/qrlib.php'); 
function getUsernameFromEmail($email) {
  $find = '@';
  $pos = strpos($email, $find);
  $username = substr($email, 0, $pos);
  return $username;
}
if(isset($_POST['submit']) ) {
  $tempDir = 'temp/'; 
  $email = $_POST['mail'];
  $subject =  $_POST['subject'];
  $filename = getUsernameFromEmail($email);
  $body =  $_POST['msg'];
  $rating = "5star";
$codeContents = 'Email:'.$email."\n"; 
$codeContents .= 'Subject:'.$subject."\n"; 
$codeContents .= 'Body:'.$body."\n"; 
$codeContents .= 'Star:'.$rating."\n"; 
  // $codeContents = 'mailto:'.$email.'?subject='.urlencode($subject).'&body='.urlencode($body); 
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
              <label>Email</label>
              <input type="email" class="form-control" name="mail" style="width:20em;" placeholder="Enter your Email" value="<?php echo @$email; ?>" required />
            </div>
            <div class="form-group">
              <label>Subject</label>
              <input type="text" class="form-control" name="subject" style="width:20em;" placeholder="Enter your Email Subject" value="<?php echo @$subject; ?>" required pattern="[a-zA-Z .]+" />
             </div>
            <div class="form-group">
            <label>Message</label>
            <input type="text" class="form-control" name="msg" style="width:20em;" value="<?php echo @$body; ?>" required pattern="[a-zA-Z0-9 .]+" placeholder="Enter your message"></textarea>
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
</body>
</html>
