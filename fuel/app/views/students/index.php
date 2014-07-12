<h1 class="page-header">Daftar Siswa</h1>
<?php if ($students == false): ?>
	<div class="alert alert-info">Belum ada siswa yang ditambahkan. <?php echo Html::anchor('students/create', 'Tambahkan siswa', array('class' => 'alert-link')) ?> untuk mengisi daftar siswa.</div>
<?php else: ?>
<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama Siswa</th>
			<th>Pilihan I</th>
			<th>Nilai I</th>
			<th>Pilihan II</th>
			<th>Nilai II</th>
			<th>Saran</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; foreach ($students as $item): ?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo Html::anchor('students/detail/'.$item->id, $item->name) ?></td>
				<td><?php echo $item->group_1 ?></td>
				<td><?php echo $item->result->total_1 ?></td>
				<td><?php echo $item->group_2 ?></td>
				<td><?php echo $item->result->total_2 ?></td>
				<td><?php echo $item->suggestion ?></td>
				<td>
					<a href="<?php echo Uri::create('students/edit/'.$item->id) ?>"><span class="glyphicon glyphicon-edit"></span></a> | 
					<a href="<?php echo Uri::create('students/delete/'.$item->id) ?>"><span class="glyphicon glyphicon-remove-circle"></span></a>
				</td>
			</tr>
		<?php $no++; endforeach ?>
	</tbody>
</table>
<?php endif ?>