<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<?php insert("partials/flash_message") ?>

		<div class="row">
			<div class="col s12 m12 l12">
				<div class="card">
					<div class="card-content">
						<h3><?php mutation("index.welcomeMessage") ?></h3>
						<p><?php mutation("index.info") ?></p>
					</div>

					<div class="card-action">
						<?php if (! getUser()): ?>
							<a href="<?php url('login') ?>"><?php mutation("index.login") ?></a>
						<?php else: ?>
							<?php if (isAdmin(getUser()["id"])): ?>
								<a href="<?php url('users') ?>"><?php mutation("nav.manageUsers") ?></a>
							<?php endif ?>
								<a href="<?php url('lecture') ?>"><?php mutation("nav.lectures") ?></a>
						<?php endif ?>
					</div>

					<div class="card-action">
						<div id="calendar"></div>
					</div>

					<!-- modals for lectures -->
					<?php foreach ($lectures as $lecture): ?>
						<div id="modal_<?php echo $lecture["id"] ?>" class="modal bottom-sheet">
							<div class="modal-content">
								<h4><?php echo $lecture["title"] ?></h4>
								<p><?php echo $lecture["note"] ?></p>
							</div>
							<?php if (getuser()): ?>
								<div class="modal-footer">
									<a href="<?php url("lecture/$lecture[id]") ?>" class="modal-action modal-close waves-effect waves-green btn-flat"><?php mutation("lectures.detail") ?></a>
									<?php if (isUserSubscribedToLecture($lecture["id"])): ?>
										<a href="<?php url("unsubscribe/$lecture[id]") ?>" class="modal-action modal-close waves-effect waves-green btn-flat"><?php mutation("lectures.unsubscribe") ?></a>
									<?php else: ?>
										<a href="<?php url("subscribe/$lecture[id]") ?>" class="modal-action modal-close waves-effect waves-green btn-flat"><?php mutation("lectures.subscribe") ?></a>
									<?php endif ?>
								</div>
							<?php endif ?>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
