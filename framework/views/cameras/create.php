<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<h3 class="center-align"><?php mutation("cameras.create") ?></h3>

			<form method="POST" action="<?php url('cameras') ?>" class="col s12" id="lecture-form">

				<div class="row">
					<div class="input-field col s12 m12 l12">
						<input id="name" type="text" class="validate" name="name">
						<label for="name"><?php mutation("cameras.name") ?></label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12 m12 l12">
						<input id="stream_address" type="text" name="stream_address">
						<label for="name"><?php mutation("cameras.address") ?></label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12 m12 l12">
						<select id="type" name="type" class="browser-default">
							<option value="image">image</option>
							<option value="stream">stream</option>
						</select>
					</div>
				</div>

				<div class="col s12 m12 l12 offset-m5 offset-l5">
					<button class="waves-effect waves-light btn" type="submit"><?php mutation("cameras.save") ?></button>
				</div>
			</form>

		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
