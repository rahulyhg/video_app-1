<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<h3 class="center-align"><?php mutation("lectures.number") ?> <?php echo $lecture["id"] ?></h3>

			<form method="POST" action="<?php url('lecture') ?>" class="col s12" id="lecture-form">
				
			</form>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
