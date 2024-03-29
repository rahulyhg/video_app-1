<!DOCTYPE html>
<html>
<head>
	<?php insert("partials/head") ?>
</head>
<body>
	<div class="container">
		<?php insert("partials/nav") ?>

		<div class="row">
			<div class="col s6 m6 l6">
				<?php insert("partials/buttons/_newUser") ?>
			</div>
			<div class="col s6 m6 l6">
				<?php insert("partials/buttons/_newAdmin") ?>
			</div>
		</div>

		<div class="row">
			<?php foreach ($users as $user): ?>
				<div class="col s12 m4 l4">
					<div class="card blue-grey darken-1">
						<div class="card-content white-text">
							<span class="card-title truncate"><?php echo $user["email"] ?></span>
							<p class="truncate"><?php echo $user["description"] ?></p>
						</div>
						<div class="card-action">
							<a href="<?php url('user/' . $user["id"]) ?>"><?php mutation("users.detail") ?></a>

							<?php if ($user["access_level"] == 1): ?>
								<span href="#" style="color: #64ffda;">ADMIN</span>
							<?php endif ?>
						</div>
					</div>
				</div>				
			<?php endforeach ?>
		</div>
	</div>

	<script src="<?php asset("js/app.min.js") ?>" type="text/javascript"></script>
</body>
</html>
