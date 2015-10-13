<?php
	ini_set('display_errors',1); 
	error_reporting(E_ALL);

	session_start();
	$db = mysqli_connect("localhost", "admin",  "admin", "museum") or die (mysql_error());
	$db->set_charset("utf8");
?>

<!DOCTYPE html>
<html>
<head>
	<title>DHBW Museum</title>
	<link rel="icon" type="image/png" href="images/favicon.ico">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/fonts.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body>
	<div class="page-wrap">
		<?php include('include/header.php'); ?>

		<div class="content">
			<?php $persons = mysqli_query($db, "SELECT * FROM person") or die(mysql_error()); ?>
			<?php $count = mysqli_num_rows($persons); ?>

			<?php if($count > 0): ?>
				<div class="persons">
					<?php while($person = mysqli_fetch_array($persons)): ?>
						<div class="person">

							<div class="person-data name">
								<span class="data">
									<h2>
										<i class="fa fa-user"></i> 
										<?php if($person['titel'] != null): ?> 
											<?php echo $person['titel']; ?> 
										<?php endif; ?>
										<?php echo $person['vorname']; ?> 
										<?php echo $person['nachname']; ?>
									</h2>
								</span>
							</div>

							<div class="person-data birth">
								<span class="title">
									 Geboren:
								</span>
								<span class="data">
									<?php 
										$date = date_create($person['geburtsdatum']);
										echo date_format($date, "d.m.Y"); 
									?> - 
									<?php echo $person['geburtsort']; ?> 
								</span>
							</div>

							<div class="person-data death">
								<span class="title">
									Gestorben:
								</span>
								<span class="data">
									<?php 
										$date = date_create($person['todesdatum']);
										echo date_format($date, "d.m.Y"); 
									?> - 
									<?php echo $person['todesort']; ?> 
								</span>
							</div>

							<div class="person-data short-description">
								<span class="data">
									<?php echo $person['k_beschreibung']; ?> 
								</span>
							</div>

							<div class="person-data long-description">
								<span class="data">
									<?php echo $person['l_beschreibung']; ?> 
								</span>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

	<footer>© 2015 Museum</footer>
</body>
</html>