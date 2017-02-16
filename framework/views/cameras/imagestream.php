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

		<div class="row" id="image_stream_holder">
			<div class="col s12 m12 l12">
				<img src="<?php echo $camera["stream_address"] ?>" id="image_stream">
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
	<script type="text/javascript"> getIpAddress("<?php echo $camera["stream_address"]; ?>"); </script>
</body>
</html>
