<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<h3 class="center-align"><?php mutation("lectures.create") ?></h3>

			<form method="POST" action="<?php url('lecture') ?>" class="col s12" id="lecture-form">

				<div class="row">
					<div class="input-field col s12 m12 l12">
						<input id="title" type="text" class="validate" id="title" name="title">
						<label for="title">Názov</label>
					</div>
				</div>

				<div class="row">
					<div class="col s12 m6 l6">
						<input type="date" class="datepicker" id="date" name="date" placeholder="Dátum">
					</div>
					<div class="col s12 m3 l3">
						<label for="time">Čas začiatku</label>
						<input type="time" class="timepicker" id="starts_at" name="starts_at" placeholder="Čas začiatku">
					</div>

					<div class="col s12 m3 l3">
						<label for="time">Čas konca</label>
						<input type="time" class="timepicker" id="ends_at" name="ends_at">
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12 m12 l12">
						<textarea id="note" name="note" class="materialize-textarea validate"></textarea>
						<label for="note">Poznámka</label>
					</div>
				</div>


				<div class="col s12 m4 l4 offset-m4 offset-l4">
					<button class="waves-effect waves-light btn" type="submit">Uložiť prednášku</button>
				</div>
			</form>

		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
