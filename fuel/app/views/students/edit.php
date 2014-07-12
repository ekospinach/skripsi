<h1 class="page-header"><?php echo $student->name ?></h1>
<?php echo Form::open() ?>
<div class="row">
	<div class="col-sm-5">
		<div class="form-group">
			<?php echo Form::label('Nama Lengkap', 'name') ?>
			<?php echo Form::input('name', $student->name, array('autofocus', 'required', 'class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Pilihan I', 'group_1') ?>
			<?php echo Form::select('group_1', $student->group_1, $group, array('class' => 'form-control')) ?>
		</div>
		<div class="form-group">
			<?php echo Form::label('Pilihan II', 'group_2') ?>
			<?php echo Form::select('group_2', $student->group_2, $group, array('class' => 'form-control')) ?>
		</div>
		<?php echo Html::anchor('students', 'Kembali', array('class' => 'btn btn-lg btn-default')) ?>
	</div>
	<div class="col-sm-7">
		<div class="form-group">
			<label>Nilai Rata-rata Raport</label>
			<div class="row">
				<div class="col-sm-2">
					<?php echo Form::input('raport_pai', $student->score->raport_pai, array('required', 'placeholder' => 'PAI', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_bin', $student->score->raport_bin, array('required', 'placeholder' => 'BIN', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_big', $student->score->raport_big, array('required', 'placeholder' => 'BIG', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_mtk', $student->score->raport_mtk, array('required', 'placeholder' => 'MTK', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_ipa', $student->score->raport_ipa, array('required', 'placeholder' => 'IPA', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-2">
					<?php echo Form::input('raport_ips', $student->score->raport_ips, array('required', 'placeholder' => 'IPS', 'class' => 'form-control')) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Nilai Ujian Nasional</label>
			<div class="row">
				<div class="col-sm-3">
					<?php echo Form::input('un_bin', $student->score->un_bin, array('required', 'placeholder' => 'BIN', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-3">
					<?php echo Form::input('un_big', $student->score->un_big, array('required', 'placeholder' => 'BIG', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-3">
					<?php echo Form::input('un_mtk', $student->score->un_mtk, array('required', 'placeholder' => 'MTK', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-3">
					<?php echo Form::input('un_ipa', $student->score->un_ipa, array('required', 'placeholder' => 'IPA', 'class' => 'form-control')) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Nilai Kompetensi Umum</label>
			<div class="row">
				<div class="col-sm-4">
					<?php echo Form::input('tpa', $student->score->tpa, array('required', 'placeholder' => 'Potensi Akademik', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-4">
					<?php echo Form::input('bta', $student->score->bta, array('required', 'placeholder' => 'BTA', 'class' => 'form-control')) ?>
				</div>
				<div class="col-sm-4">
					<?php echo Form::input('iq', $student->score->iq, array('required', 'placeholder' => 'IQ', 'class' => 'form-control')) ?>
				</div>
			</div>
		</div>
		<?php echo Form::submit('submit', 'Simpan Perubahan', array('class' => 'btn btn-lg btn-success pull-right')) ?>
	</div>
</div>
<?php echo Form::close() ?>