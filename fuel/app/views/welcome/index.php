<h1 class="page-header">Memulai Aplikasi</h1>
<p class="lead">Menggunakan Sistem Pendukung Keputusan untuk membantu Peminatan Siswa Kelas X sangat mudah. Anda dapat menambahkan data siswa atau langsung melihat daftar siswa yang telah Anda tambahkan melalui menu cepat di bawah ini atau melalui pilihan menu di samping.</p>
<div class="row">
	<div class="col-sm-4">
		<?php echo Html::anchor('students', 'Daftar Siswa', array('class' => 'btn btn-lg btn-block btn-primary')) ?>
	</div>
	<div class="col-sm-4">
		<?php echo Html::anchor('students/create', 'Tambah Siswa', array('class' => 'btn btn-lg btn-block btn-success')) ?>
	</div>
	<div class="col-sm-4"></div>
</div>