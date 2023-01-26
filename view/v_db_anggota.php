<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-th-large"></i> Database > Database Anggota</a></div>
</div>
<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
    <div class="span12">
		<button data-toggle="modal" data-target="#modal_tambah_data" class="btn btn-warning"><i class="icon-plus-sign"></i> Tambah Data</button>
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-th"></i></span>
				<h5>Daftar Anggota</h5>
			</div>
			<div class="widget-content">
				<table id="tbl_anggota" class="table   responsive nowrap  font12" style="width:100%;">
					<thead>
						<tr>
						  <th>No</th>
						  <th>ID YETECE</th>
						  <th>Nama Lengkap</th>
						  <th>Jenis Kelamin</th>
						  <th>Unit</th>
						  <th>Sabuk</th>
						  <th>Usia</th>
						  <th>Tinggi</th>
						  <th>Berat</th>
						  <th>TTL</th>
						  <th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						 <?php
						 include '../ajax/conn.php';
							$pop = $conn->query("
								SELECT member.*,DATE_FORMAT(member.tanggal_lahir,'%d %M %Y') AS tgl_lhr,
								DATE_FORMAT(member.tanggal_gabung,'%d-%M-%Y') AS tgl_gbg,
								FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) AS usia, geup.geup, agt.tipe_anggota, unit.nama_unit
								FROM ytds_member member
								LEFT JOIN ytds_geup geup
									ON geup.id = member.id_geup
								LEFT JOIN ytds_tipe_anggota agt
									ON agt.id = member.id_tipe_anggota
								LEFT JOIN ytds_unit unit
									ON unit.id = member.id_sekolah
								");
							$no=1;
							while($res = $pop->fetch_assoc()){
							echo '<tr class="gradeX">';
							echo "<td>$no</td>";
							echo "<td>".$res['id_ytc']."</td>";
							echo "<td>".$res['nama_lengkap']."</td>";
							echo "<td>".$res['gender']."</td>";
							echo "<td>".$res['nama_unit']."</td>";
							echo "<td>".$res['geup']."</td>";
							echo "<td>".$res['usia']."</td>";
							echo "<td>".$res['tinggi_badan']."</td>";
							echo "<td>".$res['berat_badan']."</td>";
							echo "<td>".$res['tempat_lahir'].', '.$res['tgl_lhr']."</td>";
							echo '
						  <td class="center"><input type="hidden"  id="id_member" value="'.$res['id'].'">
							<button id="btn_detail_data" class="btn btn-info btn-mini"><i class="icon-list-alt"></i>Detail</button>
							<button id="btn_ubah_data" class="btn btn-warning btn-mini"><i class="icon-pencil"></i>Ubah</button>
							<button id="btn_hapus_data"  class="btn btn-danger btn-mini"><i class="icon-trash"></i>Hapus</button>
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

<!-- MODAL TAMBAH DATA -->
<div id="modal_tambah_data" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form-horizontal font10" id="form_create_member">
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Nama Lengkap</label>
									<div class="controls">
										<input required type="text" class="span12" placeholder="Nama Lengkap" name='nama_lengkap' id='nama_lengkap' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Kelamin</label>
									<div class="controls">
											<select class="span12" name='gender' id='gender'>
												<option value='Laki-laki'>Laki-laki</option>
												<option value='Perempuan'>Perempuan</option>
											</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sekolah</label>
									<div class="controls">
											<select required class="span12" name='id_sekolah' id='id_sekolah'>
												<?php
												$get = $conn->query('select * from ytds_unit');
												$lv = "loadView('v_db_unit.php');";
												if($get->num_rows < 1)
													echo "<option disabled selected hidden value=''>Tidak Ada Unit.</option>";
												while ($row = $get->fetch_assoc()):
													echo "<option value='".$row['id']."'>".$row['nama_unit']."</option>";
												endwhile;
												?>
											</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tempat Lahir</label>
									<div class="controls">
										<input required type="text"  class="span12" placeholder="Tempat Lahir"   name='tempat_lahir' id='tempat_lahir'/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input required name='tanggal_lahir' id='tanggal_lahir' type="text" data-date="1990-01-01" data-date-format="yyyy-mm-dd" value="1990-01-01" class="datepicker span12">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tinggi Badan</label>
									<div class="controls">
										<div class="input-prepend">
											<input required type="text" placeholder="" class="span5"  name='tinggi_badan' id='tinggi_badan'>
											<span class="add-on">CM</span>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Berat Badan</label>
									<div class="controls">
										<div class="input-prepend">
											<input required type="text" placeholder="" class="span5"  name='berat_badan' id='berat_badan'>
											<span class="add-on">KG</span>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">No. HP</label>
									<div class="controls">
											<input required type='text' class="span12" placeholder='No. Handphone'  name='no_hp' id='no_hp'>
									</div>
								</div>
							</div>
							<!-- KOLOM 2 -->
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Nama Orang Tua</label>
									<div class="controls">
											<input required type='text' class="span12" placeholder='Nama Orang Tua'  name='nama_orang_tua' id='nama_orang_tua'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Alamat</label>
									<div class="controls">
											<textarea required class="span12" placeholder='Alamat' name='alamat' id='alamat'></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Reg. PBTI</label>
									<div class="controls">
											<input class="span12" placeholder='Registrasi PBTI'  name='reg_pbti' id='reg_pbti'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sabuk</label>
									<div class="controls">
										<select class="span12"  name='id_geup' id='id_geup'>
											<?php
											$get = $conn->query('select * from ytds_geup');
											while ($row = $get->fetch_assoc()):
												echo "<option value='".$row['id']."'>".$row['geup']."</option>";
											endwhile;
											?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Gabung</label>
									<div class="controls">
											<input required name='tanggal_gabung' id='tanggal_gabung' type='text' date-format='2018-01-01' data-date-format="yyyy-mm-dd" value="2018-01-01" class="datepicker span12">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tipe Anggota</label>
									<div class="controls">
										<select class="span12"  name='id_tipe_anggota' id='id_tipe_anggota'>
											<?php
											$get = $conn->query('select * from ytds_tipe_anggota where id <> \'99\'');
											while ($row = $get->fetch_assoc()):
												echo "<option value='".$row['id']."' ".($row['id']==6?'selected':'').">".$row['tipe_anggota']."</option>";
											endwhile;
											?>
										</select>
									</div>
								</div>
							</div>
							<!-- KOLOM 3 -->
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Foto</label>
									<div class="controls">
										<input type="file" id='path_foto' name='path_foto' onChange='PreviewImage();'>
									</div>
									<div class="controls">
										<img id='foto_preview' width="120" height="80" >
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">RFID / Kartu Anggota</label>
									<div class="controls">
										<input type="text" class="span12" placeholder="Kosongkan jika belum ada"  name='id_rfid' id='id_rfid'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
									<div class="controls">
										<button id='btn_submit_new_member' type="submit" class="btn btn-info pull-right"> <i class="icon-check"></i> Simpan Data</button>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
			<div class="modal-footer modal-button-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<!-- MODAL EDIT -->
<div id="modal_edit_data" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data Anggota</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form-horizontal font10" id="form_update_member">
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Nama Lengkap</label>
									<div class="controls">
										<input type="hidden" name='id' id="e_id_member">
										<input type="hidden" name='id_ytc' id="e_id_ytc">
										<input type="hidden" name='path_foto' id="e_path_foto_string">
										<input required type="text" class="span12" placeholder="Nama Lengkap" name='nama_lengkap' id='e_nama_lengkap' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Kelamin</label>
									<div class="controls">
											<select class="span12" name='gender' id='e_gender'>
												<option value='Laki-laki'>Laki-laki</option>
												<option value='Perempuan'>Perempuan</option>
											</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sekolah</label>
									<div class="controls">
											<select required class="span12" name='id_sekolah' id='e_id_sekolah'>
												<?php
												$get = $conn->query('select * from ytds_unit');
												if($get->num_rows < 1)
													echo "<option disabled selected hidden value=''>Tidak Ada Unit.</option>";
												while ($row = $get->fetch_assoc()):
													echo "<option value='".$row['id']."'>".$row['nama_unit']."</option>";
												endwhile;
												?>
											</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tempat Lahir</label>
									<div class="controls">
										<input required type="text"  class="span12" placeholder="Tempat Lahir"   name='tempat_lahir' id='e_tempat_lahir'/>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Lahir</label>
									<div class="controls">
										<input required name='tanggal_lahir' id='e_tanggal_lahir' type="text" data-date="1990-01-01" data-date-format="yyyy-mm-dd" value="1990-01-01" class="datepicker span12">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tinggi Badan</label>
									<div class="controls">
										<div class="input-prepend">
											<input required type="text" placeholder="" class="span5"  name='tinggi_badan' id='e_tinggi_badan'>
											<span class="add-on">CM</span>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Berat Badan</label>
									<div class="controls">
										<div class="input-prepend">
											<input required type="text" placeholder="" class="span5"  name='berat_badan' id='e_berat_badan'>
											<span class="add-on">KG</span>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">No. HP</label>
									<div class="controls">
											<input required type='text' class="span12" placeholder='No. Handphone'  name='no_hp' id='e_no_hp'>
									</div>
								</div>
							</div>
							<!-- KOLOM 2 -->
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Nama Orang Tua</label>
									<div class="controls">
											<input required type='text' class="span12" placeholder='Nama Orang Tua'  name='nama_orang_tua' id='e_nama_orang_tua'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Alamat</label>
									<div class="controls">
											<textarea required class="span12" placeholder='Alamat' name='alamat' id='e_alamat'></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Registrasi PBTI</label>
									<div class="controls">
											<input class="span12" placeholder='Prestasi'  name='reg_pbti' id='e_reg_pbti'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Sabuk</label>
									<div class="controls">
										<select class="span12"  name='id_geup' id='e_id_geup'>
											<?php
											$get = $conn->query('select * from ytds_geup');
											while ($row = $get->fetch_assoc()):
												echo "<option value='".$row['id']."'>".$row['geup']."</option>";
											endwhile;
											?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Gabung</label>
									<div class="controls">
											<input required name='tanggal_gabung' id='e_tanggal_gabung' type='text' date-format='2018-01-01' data-date-format="yyyy-mm-dd" value="2018-01-01" class="datepicker span12">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tipe Anggota</label>
									<div class="controls">
										<select class="span12"  name='id_tipe_anggota' id='e_id_tipe_anggota'>
											<?php
											$get = $conn->query('select * from ytds_tipe_anggota where id <> \'99\'');
											while ($row = $get->fetch_assoc()):
												echo "<option value='".$row['id']."'>".$row['tipe_anggota']."</option>";
											endwhile;
											?>
										</select>
									</div>
								</div>
							</div>
							<!-- KOLOM 3 -->
							<div class="span4">
								<div class="control-group">
									<label class="control-label">Foto</label>
									<div class="controls">
										<input type="file" id='e_path_foto' name='path_foto' onChange='PreviewImage();'>
									</div>
									<div class="controls">
										<img id='e_foto_preview' width="100"  >
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">RFID / Kartu Anggota</label>
									<div class="controls">
										<input type="text" class="span12" placeholder="Kosongkan jika belum ada"  name='id_rfid' id='e_id_rfid'>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
									<div class="controls">
										<button id='btn_update_member' type="submit" class="btn btn-info pull-right"> <i class="icon-check"></i> Perbarui Data</button>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
			<div class="modal-footer modal-button-center">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>


<!-- MODAL DETAIL -->
<div id="modal_detail_data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> Detail</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form class="form-horizontal font12">
								<div class="span6">

									<div class="span12">
										<div class="span6"><b>&nbsp;</b></div>
										<div class="span6">&nbsp;</div>
									</div>
									<div class="span12">
										<img id='foto_member' width="100">
									</div>

								</div> <!-- KANAN/FOTO -->
								<div class="span6"><!-- KIRI/DETAIL -->
									<div class="span12">
										<div class="span6"><b>&nbsp;</b></div>
										<div class="span6">&nbsp;</div>
									</div>
									<div class="span12">
										<div class="span6"><b>ID YTC</b></div>
										<div class="span6"> <span id="d_id_ytc"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Nama Lengkap</b></div>
										<div class="span6"> <span id="d_nama_lengkap"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Jenis Kelamin</b></div>
										<div class="span6"> <span id="d_gender"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Tempat, Tgl Lahir</b></div>
										<div class="span6"> <span id="d_ttl"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Alamat</b></div>
										<div class="span6"> <span id="d_alamat"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>No HP</b></div>
										<div class="span6"> <span id="d_no_hp"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Tanggal Bergabung</b></div>
										<div class="span6"> <span id="d_tanggal_gabung"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Tinggi / Berat Badan</b></div>
										<div class="span6"> <span id="d_tb_bb"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Unit</b></div>
										<div class="span6"> <span id="d_unit"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Sabuk</b></div>
										<div class="span6"> <span id="d_geup"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Tipe Keanggotaan</b></div>
										<div class="span6"> <span id="d_tipe_anggota"></span></div>
									</div>
									<div class="span12">
										<div class="span6"><b>Registrasi PBTI</b></div>
										<div class="span6"> <span id="d_reg_pbti"></span></div>
									</div>
								</div>
						</form>
					</div>
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
//loadDT(idTable);
$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
$('#tbl_anggota').dataTable({
		responsive:true,
		"bJQueryUI": true,
		 "columnDefs": [
		  { "width": "5%", "targets": 0 },
		  { "width": "auto", "targets": 1 },
		  { "width": "auto", "targets": 2 },
		  { "width": "auto", "targets": 3 },
		  { "width": "auto", "targets": 4 },
		  { "width": "auto", "targets": 5 },
		  { "width": "auto", "targets": 6 },
		  { "width": "auto", "targets": 7 },
		  { "width": "auto", "targets": 8 },
		  { "width": "5%", "targets": 9 }
		],
	});
$('.datepicker').datepicker({
	dateFormat:'yy-mm-dd',
	autoclose:true,
	changeMonth: true,
    changeYear: true,
	 yearRange: '1970:2022'
});
$('#modal_tambah_data').on('show', function () {
	$.fn.modal.Constructor.prototype.enforceFocus = function () { };
});

</script>
