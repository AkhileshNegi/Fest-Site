<?php
$conn = new mysqli('localhost', 'root', '', 'fest');
$sql="SELECT * FROM events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<title>Events</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">CIEZYC</a>
  <ul class="navbar-nav">
	<li class="nav-item">
	<a class="nav-link" href="#">Login</a>
	</li>
    <li class="nav-item">
      <a class="nav-link" href="#">Decoder</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="events.php">Events</a>
    </li>
  </ul>
</nav>
<div class="container-fluid">
	<h2>EVENTS</h2>
	<div class="container">
		<div class="row d-flex justify-content-center">
			<?php 
			if ($result->num_rows > 0) {
				while($event = $result->fetch_assoc()) { 
					?>
			<div class="col-md-auto p-1 m-1">
				<div class="card" style="height:400px" >
					<img class="img-thumbnail" style="height:190px" <?php echo 'src="'.$event['photo'].'"'; ?> alt="Card image">
					<div class="card-body">
						<h4 class="card-title"><?php echo $event['event_name']; ?></h4>
						<p class="card-text"><?php echo $event['about']; ?></p>
						<div class="card-footer d-flex justify-content-center">
							<?php
	echo '<input type="button" name="theButton" value="Details"  class="event_details m-1 btn btn-success respond" data-toggle="modal" data-eventid ="'.$event['event_id'].'" data-target="#myModal" />';
?>
						</div>
						<div id="details"></div>
					</div>
				</div>
			</div>
				<?php }
			}?>
		</div>
	</div>
</div>
<div class="container">
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          Modal body..
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>  
      </div>
    </div>
  </div>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>