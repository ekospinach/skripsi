<h1 class="page-header">
	<?php echo $student->name ?>
	<div class="btn-group pull-right">
		<?php echo Html::anchor('students/edit/'.$student->id, 'Sunting', array('class' => 'btn btn-warning')); ?>
		<?php echo Html::anchor('students', 'Kembali', array('class' => 'btn btn-default')); ?>
	</div>
</h1>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title text-center">Kelompok Peminatan yang disarankan adalah</h3>
	</div>
	<div class="panel-body">
		<h3 class="text-center"><?php echo $student->suggestion ?></h3>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="panel <?php echo $student->result->total_1 >= $student->result->total_2 ? 'panel-primary' : 'panel-info' ?>">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Pilihan I</h3>
			</div>
			<ul class="list-group text-center">
				<li class="list-group-item"><strong><?php echo $student->group_1 ?></strong></li>
				<li class="list-group-item"><h3><?php echo $student->result->total_1 ?></h3></li>
				<li class="list-group-item">Kriteria Nilai Raport: <strong><?php echo $student->result->raport_1 ?></strong></li>
				<li class="list-group-item">Kriteria Nilai UN: <strong><?php echo $student->result->un_1 ?></strong></li>
				<li class="list-group-item">Kriteria Nilai Umum: <strong><?php echo $student->result->umum_1 ?></strong></li>
			</ul>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="panel <?php echo $student->result->total_1 <= $student->result->total_2 ? 'panel-primary' : 'panel-info' ?>">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Pilihan II</h3>
			</div>
			<ul class="list-group text-center">
				<li class="list-group-item"><strong><?php echo $student->group_2 ?></strong></li>
				<li class="list-group-item"><h3><?php echo $student->result->total_2 ?></h3></li>
				<li class="list-group-item">Kriteria Nilai Raport: <strong><?php echo $student->result->raport_2 ?></strong></li>
				<li class="list-group-item">Kriteria Nilai UN: <strong><?php echo $student->result->un_2 ?></strong></li>
				<li class="list-group-item">Kriteria Nilai Umum: <strong><?php echo $student->result->umum_2 ?></strong></li>
			</ul>
		</div>
	</div>
</div>
<table class="table table-bordered table-condensed">
	<thead>
		<tr class="success">
			<th class="text-center" colspan="6">Nilai Rata-rata Raport</th>
			<th class="text-center" colspan="4">Nilai Ujian Nasional</th>
			<th class="text-center" colspan="3">Nilai Kompetensi Umum</th>
		</tr>
		<tr class="success">
			<th>PAI</th>
			<th>BIN</th>
			<th>BIG</th>
			<th>MTK</th>
			<th>IPA</th>
			<th>IPS</th>
			<th>BIN</th>
			<th>BIG</th>
			<th>MTK</th>
			<th>IPA</th>
			<th>TPA</th>
			<th>BTA</th>
			<th>IQ</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $student->score->raport_pai ?></td>
			<td><?php echo $student->score->raport_bin ?></td>
			<td><?php echo $student->score->raport_big ?></td>
			<td><?php echo $student->score->raport_mtk ?></td>
			<td><?php echo $student->score->raport_ipa ?></td>
			<td><?php echo $student->score->raport_ips ?></td>
			<td><?php echo $student->score->un_bin ?></td>
			<td><?php echo $student->score->un_big ?></td>
			<td><?php echo $student->score->un_mtk ?></td>
			<td><?php echo $student->score->un_ipa ?></td>
			<td><?php echo $student->score->tpa ?></td>
			<td><?php echo $student->score->bta ?></td>
			<td><?php echo $student->score->iq ?></td>
		</tr>
	</tbody>
</table>