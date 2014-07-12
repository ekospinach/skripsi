<h1 class="page-header">Tambah Siswa</h1>
<?php echo Form::open() ?>
<div class="row">
	<div class="col-sm-5">
		<div class="form-group">
			<?php echo Form::label('Nama Lengkap', 'name') ?>
			<?php echo Form::input('name', Input::post('name'), array('autofocus', 'required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Pilihan I', 'group_1') ?>
			<?php echo Form::select('group_1', Input::post('group_1'), $group, array('class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Pilihan II', 'group_2') ?>
			<?php echo Form::select('group_2', Input::post('group_2'), $group, array('class' => 'form-control')) ?>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="form-group">
			<label>Nilai Rata-rata Raport</label>
			<div class="row">
				<div class="col-sm-2">
					<?php echo Form::input('raport_pai', Input::post('raport_pai'), array('required', 'placeholder' => 'PAI', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_bin', Input::post('raport_bin'), array('required', 'placeholder' => 'BIN', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_big', Input::post('raport_big'), array('required', 'placeholder' => 'BIG', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_mtk', Input::post('raport_mtk'), array('required', 'placeholder' => 'MTK', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_ipa', Input::post('raport_ipa'), array('required', 'placeholder' => 'IPA', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_ips', Input::post('raport_ips'), array('required', 'placeholder' => 'IPS', 'class' => 'form-control')) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Nilai Ujian Nasional</label>
			<div class="row">
				<div class="col-sm-3">
					<?php echo Form::input('un_bin', Input::post('un_bin'), array('required', 'placeholder' => 'BIN', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-3">
					<?php echo Form::input('un_big', Input::post('un_big'), array('required', 'placeholder' => 'BIG', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-3">
					<?php echo Form::input('un_mtk', Input::post('un_mtk'), array('required', 'placeholder' => 'MTK', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-3">
					<?php echo Form::input('un_ipa', Input::post('un_ipa'), array('required', 'placeholder' => 'IPA', 'class' => 'form-control')) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Nilai Kompetensi Umum</label>
			<div class="row">
				<div class="col-sm-4">
					<?php echo Form::input('tpa', Input::post('tpa'), array('required', 'placeholder' => 'Potensi Akademik', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-4">
					<?php echo Form::input('bta', Input::post('bta'), array('required', 'placeholder' => 'BTA', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-4">
					<?php echo Form::input('iq', Input::post('iq'), array('required', 'placeholder' => 'IQ', 'class' => 'form-control')) ?>
				</div>
			</div>
		</div>
		<?php echo Form::submit('submit', 'Tambahkan', array('class' => 'btn btn-lg btn-primary pull-right')) ?>
	</div>
</div>
<?php echo Form::close() ?>