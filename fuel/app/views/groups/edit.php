<h1 class="page-header">Profil Ideal Kelompok Peminatan <?php echo $group->name ?></h1>
<?php echo Form::open() ?>
<div class="row">
	<div class="col-sm-4">
		<div class="form-group">
			<?php echo Form::label('Nama Kelompok Peminatan', 'name') ?>
			<?php echo Form::input('name', $group->name, array('required', 'class' => 'form-control')) ?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4">
		<?php echo Form::fieldset_open(null, 'Nilai Rata-rata Raport') ?>
		<div class="form-group">
			<?php echo Form::label('Pend. Agama Islam', 'raport_pai') ?>
			<?php echo Form::input('raport_pai', $group->raport_pai, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Bahasa Indonesia', 'raport_bin') ?>
			<?php echo Form::input('raport_bin', $group->raport_bin, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Bahasa Inggris', 'raport_big') ?>
			<?php echo Form::input('raport_big', $group->raport_big, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Matematika', 'raport_mtk') ?>
			<?php echo Form::input('raport_mtk', $group->raport_mtk, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Ilmu Pengetahuan Alam', 'raport_ipa') ?>
			<?php echo Form::input('raport_ipa', $group->raport_ipa, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Ilmu Pengetahuan Sosial', 'raport_ips') ?>
			<?php echo Form::input('raport_ips', $group->raport_ips, array('required', 'class' => 'form-control')) ?>
		</div>
		<?php echo Form::fieldset_close() ?>
	</div>
	<div class="col-sm-4">
		<?php echo Form::fieldset_open(null, 'Nilai Ujian Nasional') ?>
		<div class="form-group">
			<?php echo Form::label('Bahasa Indonesia', 'un_bin') ?>
			<?php echo Form::input('un_bin', $group->un_bin, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Bahasa Inggris', 'un_big') ?>
			<?php echo Form::input('un_big', $group->un_big, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Matematika', 'un_mtk') ?>
			<?php echo Form::input('un_mtk', $group->un_mtk, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Ilmu Pengetahuan Alam', 'un_ipa') ?>
			<?php echo Form::input('un_ipa', $group->un_ipa, array('required', 'class' => 'form-control')) ?>
		</div>
		<?php echo Form::fieldset_close() ?>
	</div>
	<div class="col-sm-4">
		<?php echo Form::fieldset_open(null, 'Nilai Kompetensi Umum') ?>
		<div class="form-group">
			<?php echo Form::label('Tes Potensi Akademik', 'tpa') ?>
			<?php echo Form::input('tpa', $group->tpa, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Baca Tulis Al-Qur\'an', 'bta') ?>
			<?php echo Form::input('bta', $group->bta, array('required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Skor IQ', 'iq') ?>
			<?php echo Form::input('iq', $group->iq, array('required', 'class' => 'form-control')) ?>
		</div>
		<?php echo Form::submit('submit', 'Simpan Perubahan', array('class' => 'btn btn-lg btn-success pull-right')) ?>
		<?php echo Form::fieldset_close() ?>
	</div>
</div>
<?php echo Form::close() ?>