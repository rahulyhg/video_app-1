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
				<h3><?php mutation("cameras.title") ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m12 l12">
				<?php insert("partials/buttons/_newCamera") ?>
			</div>
		</div>

		<div class="row">

			<?php foreach ($cameras as $camera): ?>
				<?php
					$disabledClass = "";
					if ($camera["type"] === "disabled") {
						$disabledClass = "disabled";
					}
				?>
				<div class="col s12 m4 l4">
					<div class="card blue-grey darken-1 <?php echo $disabledClass ?>">
						<div class="card-content white-text">
							<span class="card-title truncate"><?php echo $camera["name"] ?></span>
						</div>
						<div class="card-action">
							<a href="<?php url('camera/' . $camera["id"]) ?>"><?php mutation("cameras.show") ?></a>
							<a href="<?php url('camera/' . $camera["id"] . '/archive') ?>"><?php mutation("nav.archive") ?></a>
							<a href="<?php url('camera/delete/' . $camera["id"]) ?>">delete</a>
							<?php if ($disabledClass == "disabled"): ?>
								<span class="deep-orange darken-2">disabled camera</span>
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
