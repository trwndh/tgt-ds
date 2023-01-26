<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-th-large"></i> Laporan > Laporan Prestasi > Laporan Prestasi Anggota</a></div>
</div>
<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-search"></i></span>
				<h5>Filter Anggota</h5>
			</div>

			<div class="widget-content"> 
				<form class="form-horizontal font10" id="lab_filter"> 
					<input name="nama_anggota" required id="laps_nama_anggota" placeholder="Nama Anggota" type="text" class="span3">	
					<input name="id" required id="laps_id" placeholder="ID Anggota" type="hidden" class="span3">	
					<input name="class_prestasi" readonly id="laps_cp" placeholder="Kelas Prestasi" type="text" class="span3">	
					<input name="unit" readonly id="laps_unit" placeholder="Unit" type="text" class="span3">	
					
					<button class="btn  btn-info" id="laps_btn_get"> Submit </button>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-th"></i></span>
				<h5>Data Prestasi</h5>
			</div>

			<div class="widget-content">
			
				<button id="laps_btnnew" class="btn btn-warning"><i class="icon-plus-sign"></i> Tambah Data </button>
				<table id="laps_tbl" class="table table-responsive nowrap font12">
					<thead>
						<th> No. </th>
						<th> Tipe Event </th>
						<th> Kategori </th>
						<th> Event </th>
						<th> Medali </th>
						<th> Poin </th>
						<th> &nbsp; </th>
					</thead>
					<tbody id="tebodi_laps_tbl">
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
<!-- MODAL TAMBAH DATA -->
<div id="laps_modalnew" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Data Prestasi</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form-horizontal font10" id="laps_formnew">
							<div class="span12"> 
								<div class="control-group">
									<label class="control-label">Nama Siswa</label>
									<div class="controls">
										<input required type="text" class="span8" placeholder="Nama Lengkap" name='nama_lengkap' id='laps_nama_lengkap' />
										<input required type="hidden" class="span8" placeholder="Nama Lengkap" name='id_member' id='laps_id_member' />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Event</label>
									<div class="controls">
										<textarea required class="span8" name='event_name' id='laps_nama_event'></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Event</label>
									<div class="controls">
										<select required class="span12" name='id_event' id="laps_id_event">
											<?php
												require_once '../ajax/conn.php';
												$q = $conn->query("
													SELECT * 
													FROM ytds_point_event
												");
												while($r=$q->fetch_assoc()){
													echo "<option value='".$r['id']."'>".$r['id_tipe_event']." - ".$r['kategori']." - ".$r['point']." Pts </option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Hasil</label>
									<div class="controls">
										<select required class="span8" name='hasil' id='laps_hasil' >
											<option value="3"> Juara 1 </option>
											<option value="2"> Juara 2 </option>
											<option value="1"> Juara 3 </option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Event</label>
									<div class="controls">
										<input required type="date" value="<?=date('Y-m-d')?>" class="span8" placeholder="Nama Lengkap" name='event_date' id='laps_event_date' />
									</div>
								</div>								
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
									<div class="controls">
										<input type="Submit" class="span4" value="Submit Data" />
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- MODAL TAMBAH DATA -->
<div id="laps_modaledit" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ubah Data Prestasi</h5>
				</button>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="span12">
						<form method="post" class="form-horizontal font10" id="laps_formedit">
							<div class="span12"> 
								<div class="control-group">
									<label class="control-label">Nama Siswa</label>
									<div class="controls">
										<input required type="text" class="span8" placeholder="Nama Lengkap" name='nama_lengkap' id='laps_nama_lengkape' readonly />
										<input required type="hidden" class="span8" placeholder="Nama Lengkap" name='id' id='laps_ide' readonly />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Nama Event</label>
									<div class="controls">
										<textarea required class="span8" name='event_name' id='laps_nama_evente'></textarea>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Jenis Event</label>
									<div class="controls">
										<select required class="span12" name='id_event' id="laps_id_evente">
											<?php
												require_once '../ajax/conn.php';
												$q = $conn->query("
													SELECT * 
													FROM ytds_point_event
												");
												while($r=$q->fetch_assoc()){
													echo "<option value='".$r['id']."'>".$r['id_tipe_event']." - ".$r['kategori']." - ".$r['point']." Pts </option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Hasil</label>
									<div class="controls">
										<select required class="span8" name='hasil' id='laps_hasile' >
											<option value="3"> Juara 1 </option>
											<option value="2"> Juara 2 </option>
											<option value="1"> Juara 3 </option>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Tanggal Event</label>
									<div class="controls">
										<input required type="date" value="<?=date('Y-m-d')?>" class="span8" placeholder="Nama Lengkap" name='event_date' id='laps_event_datee' />
									</div>
								</div>								
								<div class="control-group">
									<label class="control-label">&nbsp;</label>
									<div class="controls">
										<input type="Submit" class="span4" value="Submit Data" />
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$("#laps_nama_anggota").autocomplete
    ({
        source: function (request, response)
        {
            $.ajax(
            {
                url: "ajax/getter.php?act=getDataPrestasiByWord",
                data: {
                        term: request.term
                      },
                type: "get",
                dataType: "json",
                success: function (data)
                {
                    response($.map( data, function (item)
                    {
                        return {
                                id: item.id,
                                value: item.nama_lengkap,
                                label: item.nama_lengkap+' | '+item.nama_unit+' | '+item.tipe_anggota,
                                idytc: item.id_ytc,
                                unit:item.nama_unit,
                                usia:item.usia,
                                tipe_anggota:item.tipe_anggota
                                }
                    })); 
                }
            });
        },
        focus: function (event, ui)
        {
            $(this).val(ui.item.value);
            $("#laps_id").val(ui.item.id);  //put the stateProvince abbrev'n in the hidden input box
            $("#laps_cp").val(ui.item.tipe_anggota);
            $("#laps_unit").val(ui.item.unit);
            
        },
        select: function (event, ui)
        {
             $(this).val(ui.item.value);
            $("#laps_id").val(ui.item.id);  //put the stateProvince abbrev'n in the hidden input box
            $("#laps_cp").val(ui.item.tipe_anggota);
            $("#laps_unit").val(ui.item.unit);
        },
        minLength: 2
    });
</script>