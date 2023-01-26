<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-th-large"></i> Database > Database Unit</a></div>
</div>
<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
    <div class="span12">
		<button data-toggle="modal" data-target="#modal_tambah_unit" class="btn btn-warning"><i class="icon-plus-sign"></i> Tambah Data</button>
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-th"></i></span>
				<h5>Daftar Unit</h5>
			</div>
			<div class="widget-content">
				<table id="tbl_unit" class="table table-bordered nowrap responsive  font12" style="width:100%;">
					<thead>
						<tr>
						  <th>No</th>
						  <th>Nama Unit</th>
						  <th>Alamat</th>
						  <th>Pelatih</th>
						  <th>Jumlah Anggota</th>
						  <th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						 <?php
						 include '../ajax/conn.php';
							$pop = $conn->query("
								SELECT u.*, u.id as id_unit, COUNT(m.`id_sekolah`) AS total_murid, pj.`nama_lengkap` AS nama_pj
								FROM ytds_unit u
								LEFT OUTER JOIN ytds_member m
								ON m.id_sekolah = u.id
								LEFT OUTER JOIN ytds_member pj
								ON u.`penanggung_jawab` =pj.id
								GROUP BY u.id
								");
							$no=1;
							while($res = $pop->fetch_assoc()){
							echo '<tr class="gradeX">';
							echo "<td>$no</td>";
							echo "<td>".$res['nama_unit']."</td>";
							echo "<td>".$res['alamat']."</td>";
							echo "<td>".$res['nama_pj']."</td>";
							echo "<td>".$res['total_murid']."</td>";
							echo '
							<td class="center"><input type="hidden"  id="id" value="'.$res['id_unit'].'">
							<button id="btn_ubah_data_unit" class="btn btn-warning btn-mini"><i class="icon-pencil"></i>Ubah</button>
							<button id="btn_hapus_data_unit"  class="btn btn-danger btn-mini"><i class="icon-trash"></i>Hapus</button>
						  </td>
						</tr>';
						 $no++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- MODAL TAMBAH UNIT -->
<div id="modal_tambah_unit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form-horizontal font10" id="form_create_unit">
							<div class="span11">
								<div class="control-group">
									<label class="control-label">Nama Unit</label>
									<div class="controls">
										<input required type="text" class="span12" placeholder="Nama Unit" name='nama_unit' id='nama_unit' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Alamat</label>
									<div class="controls">
										<textarea required type="text" class="span12" placeholder="Masukkan Alamat Unit" name='alamat' id='alamat' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Pelatih</label>
									<div class="controls">
											<select class="span12" name='penanggung_jawab' id='penanggung_jawab'>
												<?php
												$get = $conn->query('select * from ytds_member where id_tipe_anggota="2"');
												while ($row = $get->fetch_assoc()):
													echo "<option value='".ltrim($row['id'],'0')."'>".$row['nama_lengkap']."</option>";
												endwhile;
												?>
											</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
									<div class="controls">
										<button id='btn_submit_new_unit' type="submit" class="btn btn-info pull-right"> <i class="icon-check"></i> Simpan Data</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer modal-button-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<!-- MODAL EDIT UNIT -->
<div id="modal_edit_unit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Unit</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form-horizontal font10" id="form_edit_unit">
							<div class="span11">
								<div class="control-group">
									<label class="control-label">Nama Unit</label>
									<div class="controls">
										<input required type="text" class="span12" placeholder="Nama Unit" name='nama_unit' id='e_nama_unit' />
										<input type="hidden" name='id' id='e_id_unit' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Alamat</label>
									<div class="controls">
										<textarea required type="text" class="span12" placeholder="Masukkan Alamat Unit" name='alamat' id='e_alamat' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Penanggung Jawab</label>
									<div class="controls">
											<select class="span12" name='penanggung_jawab' id='e_penanggung_jawab'>
												<?php
												$get = $conn->query('select * from ytds_member where id_tipe_anggota="2"');
												while ($row = $get->fetch_assoc()):
													echo "<option value='".ltrim($row['id'],'0')."'>".$row['nama_lengkap']."</option>";
												endwhile;
												?>
											</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
									<div class="controls">
										<button id='btn_submit_new_unit' type="submit" class="btn btn-info pull-right"> <i class="icon-check"></i> Simpan Data</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer modal-button-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<script>
$('#tbl_unit').dataTable({
		"bJQueryUI": true
});

</script>
