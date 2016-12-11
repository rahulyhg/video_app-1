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
					<h4 class="center-align">Design and Colours</h4>

					<?php insert("lectures/form_partials/design/surface") ?>

					<?php insert("lectures/form_partials/design/pvc_foil") ?>
				</div>


				<div class="row">
					<?php insert("lectures/form_partials/design/colours") ?>

					<?php insert("lectures/form_partials/design/panel_design") ?>
				</div>
			</form>

		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
