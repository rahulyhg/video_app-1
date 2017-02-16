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
				<h3><?php mutation("nav.archive") ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m12 l12">
				<div class="card">
					<div class="card-content">
						<h3><?php mutation("archive.settings") ?></h3>

						<div class="row">
							<div class="col s12 m12 l12">
								<input type="date" class="archiveDatepicker" id="date" name="date" placeholder="<?php mutation("archive.day") ?>">
							</div>
						</div>

						<div class="row">
							<div class="col s12 m12 l12">
								<input type="range" id="archiveSlider" min="0" max="86400" />
							</div>
						</div>
					</div>
					<div class="card-action"></div>
				</div>
			</div>
		</div>

		<div class="row" id="archive_camera_holder">
			<img src="<?php echo $camera["stream_address"] ?>" id="archive_camera_stream">
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
	<script type="text/javascript"> getIpAddress("<?php echo $camera["stream_address"]; ?>"); </script>
</body>
</html>
