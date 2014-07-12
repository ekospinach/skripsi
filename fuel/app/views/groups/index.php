<h1 class="page-header">Kelompok Peminatan</h1>
<?php if ($groups == false): ?>
	<div class="alert alert-info">Belum ada Kelompok Peminatan yang ditambahkan. <?php echo Html::anchor('groups/create', 'Tambahkan Kelompok Peminatan', array('class' => 'alert-link')) ?> untuk mengisi daftar Kelompok Peminatan.</div>
<?php else: ?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nama</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; foreach ($groups as $item): ?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $item->name ?></td>
				<td>
					<a href="<?php echo Uri::create('groups/edit/'.$item->id) ?>">Sunting</a>
				</td>
			</tr>
		<?php $no++; endforeach ?>
		</tbody>
	</table>
<?php endif ?>