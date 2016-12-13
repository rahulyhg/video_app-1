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
						<h3><?php echo $lecture["title"] ?></h3>
						<p><?php echo $lecture["note"] ?></p>
					</div>

					<div class="card-action">
						<?php if (getUser()): ?>
							<?php if (isUserSubscribedToLecture($lecture["id"])): ?>
								<a href="<?php url("unsubscribe/$lecture[id]") ?>" class="modal-action modal-close waves-effect waves-green btn-flat"><?php mutation("lectures.unsubscribe") ?></a>
							<?php else: ?>
								<a href="<?php url("subscribe/$lecture[id]") ?>" class="modal-action modal-close waves-effect waves-green btn-flat"><?php mutation("lectures.subscribe") ?></a>
							<?php endif ?>
						<?php endif ?>
					</div>

				</div>
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
