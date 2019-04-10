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
			<div class="col-sm-3 p-1 m-1">
				<div class="card" style="height:400px" >
					<img class="img-thumbnail" style="height:190px" <?php echo 'src="'.$event['photo'].'"'; ?> alt="Card image">
					<div class="card-body">
						<h4 class="card-title"><?php echo $event['event_name']; ?></h4>
						<p class="card-text"><?php echo $event['about']; ?></p>
						<div class="card-footer d-flex justify-content-center">
							<a href="#" class="btn btn-primary">Details</a>
						</div>
					</div>
				</div>
			</div>
				<?php }
			}?>
		</div>
	</div>
</div>
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>