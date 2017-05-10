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
				<div class="card">
					<div class="card-content">
						<h3><?php mutation("archive.settings") ?></h3>

						<div class="row">
							<div class="col s12 m12 l12">
								<input type="date" class="archiveDatepicker" id="date" name="date" placeholder="<?php mutation("archive.day") ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" id="archive_camera_holder">
			<div class="col s12 m12 l12">
				<img src="<?php echo $camera["stream_address"] ?>" id="archive_camera_stream">

				<!-- image url test -->
				<img style="display: none" id="imageTester" onerror="errorCallback()" onload="loadCallback()" />
				<!-- image url test -->
			</div>
		</div>

		<div class="row">
			<div class="col s12 m12 l12 center-align">
				<i class="material-icons archive_button" id="archive_play_button">play_circle_outline</i>
				<i class="material-icons archive_button" id="archive_pause_button">pause_circle_outline</i>
				<input type="range" id="archiveSlider" min="0" max="86400" value="0" />
			</div>

			<div class="col s12 m6 l6 center-align">
				<input type="text" id="achiveTimeFormatted" disabled>
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
	<script type="text/javascript"> getIpAddress("<?php echo $camera["stream_address"]; ?>"); </script>
</body>
</html>
