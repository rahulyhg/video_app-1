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
						<h3><?php mutation("lectures.heading") ?></h3>
						<p><?php mutation("lectures.info") ?></p>
					</div>
					<div class="card-action">
						<?php if (getUser()): ?>
							<?php if (isUserAdmin()): ?>
								<a href="<?php url('lecture/create') ?>"><?php mutation("lectures.create") ?></a>
							<?php endif ?>
							<a href="<?php url('user/' . getUser()["id"] . '/lectures') ?>"><?php mutation("lectures.showMy") ?></a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
