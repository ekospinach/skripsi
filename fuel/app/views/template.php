<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title ?></title>
		<?php echo Asset::css(array('bootstrap.css', 'bootstrap-theme.css', 'dashboard.css')) ?>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="#" class="navbar-brand">Skripsi</a>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 sidebar">
					<ul class="nav nav-sidebar">
						<li class="<?php echo Uri::current() == Uri::base() ? 'active' : '' ?>"><?php echo Html::anchor('/', 'Beranda') ?></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li><?php echo Html::anchor('students', 'Daftar Siswa') ?></li>
						<li><?php echo Html::anchor('students/create', 'Siswa Baru') ?></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li><?php echo Html::anchor('students/group/AGAMA', 'Kelompok AGAMA') ?></li>
						<li><?php echo Html::anchor('students/group/MIA', 'Kelompok MIA') ?></li>
						<li><?php echo Html::anchor('students/group/IIS', 'Kelompok IIS') ?></li>
					</ul>
					<ul class="nav nav-sidebar">
						<li><?php echo Html::anchor('settings', 'Pengaturan') ?></li>
						<li><?php echo Html::anchor('groups', 'Kelompok Peminatan') ?></li>
					</ul>
				</div>
				<div class="col-sm-9 col-sm-offset-3 main">
					<?php if (Session::get_flash('success')): ?>
						<div class="alert alert-success alert-dismissable">
							<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">&times;</span></button>
							<?php echo Session::get_flash('success') ?>
						</div>
					<?php endif ?>
					<?php if (Session::get_flash('danger')): ?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">&times;</span></button>
							<?php echo Session::get_flash('danger') ?>
						</div>
					<?php endif ?>
					<?php if(isset($messages) and count($messages)>0): ?>
						<ul class="list-group">
							<?php
							foreach($messages as $message)
							{
								echo '<li class="list-group-item list-group-item-danger">', $message,'</li>';
							}
							?>
						</ul>
					<?php endif; ?>
					<?php echo $content ?>
				</div>
			</div>
		</div>
		<?php echo Asset::js(array('jquery.js', 'bootstrap.js')) ?>
	</body>
</html>