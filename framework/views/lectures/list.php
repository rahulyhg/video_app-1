<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<?php mutation("lectures.heading") ?>
		</div>

		<div class="row">
			<h4><?php mutation("lectures.noSubscriptions") ?></h4>

			<div class="row">
				<?php foreach ($lectures as $lecture): ?>
					<div class="col s12 m6 l4">
						<div class="card-panel grey lighten-5 z-depth-1">
							<div class="row valign-wrapper">
								<div class="col s2">
									<i class="material-icons left">library_books</i>
								</div>
								<div class="col s10">
									<span class="black-text concat">
										<?php echo $lecture["title"] ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
