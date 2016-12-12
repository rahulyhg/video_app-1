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

				</div>
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
