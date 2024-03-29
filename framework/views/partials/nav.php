<nav>
	<div class="nav-wrapper">
		<a href="/" class="brand-logo"><?php mutation('nav.title') ?></a>
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<?php if (getUser()): ?>
				<li>
					<a href="<?php url('cameras') ?>">
						<i class="material-icons left">camera_enhance</i>
						<?php mutation('nav.cameras') ?>
					</a>
				</li>
				<?php if (isAdmin(getUser()["id"])): ?>
					<li>
						<a href="<?php url('users') ?>">
							<i class="material-icons left">supervisor_account</i>
							<?php mutation('nav.manageUsers') ?>
						</a>
					</li>
				<?php endif ?>
				<li>
					<a href="<?php url('lecture') ?>">
						<i class="material-icons left">receipt</i>
						<?php mutation('nav.lectures') ?>
					</a>
				</li>
				<li>
					<a href="<?php url('settings') ?>">
						<i class="material-icons left">settings</i>
						<?php mutation('nav.settings') ?>
					</a>
				</li>
				<li>
					<a href="<?php url('logout') ?>">
						<i class="material-icons left">input</i>
						<?php mutation('nav.logout') ?>
					</a>
				</li>
			<?php else: ?>
				<li>
					<a href="<?php url('login') ?>">
						<i class="material-icons left">person_pin</i>
						<?php mutation('nav.login') ?>
					</a>
				</li>
			<?php endif ?>
		</ul>

		<ul class="side-nav" id="mobile-demo">
			<li>
				<a href="<?php url('cameras') ?>">
					<i class="material-icons left">camera_enhance</i>
					<?php mutation('nav.cameras') ?>
				</a>
			</li>
			<?php if (getUser()): ?>
				<?php if (isAdmin(getUser()["id"])): ?>
					<li>
						<a href="<?php url('users') ?>">
							<i class="material-icons left">supervisor_account</i>
							<?php mutation('nav.manageUsers') ?>
						</a>
					</li>
				<?php endif ?>
				<li>
					<a href="<?php url('lecture') ?>">
						<i class="material-icons left">receipt</i>
						<?php mutation('nav.lectures') ?>
					</a>
				</li>
				<li>
					<a href="<?php url('logout') ?>">
						<i class="material-icons left">input</i>
						<?php mutation('nav.logout') ?>
					</a>
				</li>
				<li>
					<a href="<?php url('settings') ?>">
						<i class="material-icons left">settings</i>
						<?php mutation('nav.settings') ?>
					</a>
				</li>
			<?php else: ?>
				<li>
					<a href="<?php url('login') ?>">
						<i class="material-icons left">person_pin</i>
						<?php mutation('nav.login') ?>
					</a>
				</li>
			<?php endif ?>
		</ul>
	</div>
</nav>
