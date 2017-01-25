<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<div class="col s12 m12 l12">
				<h3><?php mutation("cameras.single") ?>: <?php echo $camera["name"] ?></h3>				
			</div>
		</div>

		<div class="row" id="camera_stream_holder">
			<img src="<?php echo $camera["stream_address"] ?>" id="camera_stream">
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
	<!-- <script type="text/javascript">getTheCameraStream('<?php echo $camera["ip_address"] ?>');</script> -->
</body>
</html>
