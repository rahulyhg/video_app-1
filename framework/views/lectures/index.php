<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<?php if (getUser()["id"] == $user["id"]): ?>
				<h3><?php mutation("lectures.showMy") ?></h3>
			<?php else: ?>
				<h3><?php mutation("lectures.show") ?> <?php echo $user["email"] ?></h3>
			<?php endif ?>
		</div>

		<div class="row">
			<?php if (count($lectures) == 0): ?>
				<h4><?php mutation("lectures.noSubscriptions") ?></h4>
			<?php endif ?>

			<?php foreach ($lectures as $lecture): ?>
				<div class="col s12 m4 l4">
					<div class="card blue-grey darken-1">
						<div class="card-content white-text">
							<span class="card-title truncate"><?php echo $lecture["title"] ?></span>
							<p class="truncate"><?php echo $lecture["note"] ?></p>
						</div>
						<div class="card-action">
							<a href="<?php url('lecture/' . $lecture["id"]) ?>"><?php mutation("lectures.detail") ?></a>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
