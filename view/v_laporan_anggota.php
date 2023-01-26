<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-list-alt"></i> Laporan > Laporan Anggota </a></div>
</div>

<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
	<div class="span3">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-search"></i></span>
				<h5>Filter Data</h5>
			</div>

			<div class="widget-content"> 
			 <form id="la_formfilter" method="get" class="form-horizontal">
              <div class="control-group">
                 <select name="nama_unit" required id="la_select_unit" class="span12">
						<option selected hidden disabled value=''>  -- Pilih Unit -- </option>
						<?php require_once '../ajax/conn.php';
							$g = $conn->query("SELECT * FROM ytds_unit");
							while($r=$g->fetch_assoc()){
								echo "<option value='".$r['id']."'>".$r['nama_unit'].' | '.$r['alamat']."</option>";
							}
						?>
					</select>
              </div>
              <div class="control-group">
					<select name="id_geup" required id="la_select_geup" class="span12">
						<option selected value='%' > -- Semua Geup -- </option>
						<?php 
							$g= $conn->query("SELECT * FROM ytds_geup");
							while($r=$g->fetch_assoc()){
								echo "<option value='".$r['id']."'>".$r['geup']."</option>";
							}
						?>
					</select>
              </div>
              <div class="control-group">
					<select name="id_tipe_anggota" required id="la_select_tipe_anggota" class="span12">
						<option selected value='%' > -- Semua Tipe Keanggotaan -- </option>
						<?php 
							$g= $conn->query("SELECT * FROM ytds_tipe_anggota");
							while($r=$g->fetch_assoc()){
								echo "<option value='".$r['id']."'>".$r['tipe_anggota']."</option>";
							}
						?>
					</select>
              </div>
              <div class="control-group">
                  <select name="gender" required id="la_select_gender" class="span12">
						<option selected value='%' > -- Semua Gender -- </option>
						<option value='Laki-laki' > Laki-laki</option>
						<option value='Perempuan' > Perempuan </option>
					</select>
              </div>
              <div class="control-group">
                  Usia:
					<select name="filter_umur" required id="la_filter_umur" class="span5">
						<option selected value='%' > Semua Usia </option>
						<option value='lbs' > >= </option>
						<option value='lb' > > </option>
						<option value='kds' > <=  </option>
						<option value='kd' > <  </option>
						<option value='sd' > =  </option>
					</select>
					<input name="usia" id="la_usia" placeholder="Usia" type="number" class="span5">	
              </div>
              <div class="control-group">
                  TB:
					<select name="filter_tb" required id="la_filter_tb" class="span5">
						<option selected value='%' > Semua TB </option>
						<option value='lbs' > >= </option>
						<option value='lb' > > </option>
						<option value='kds' > <=  </option>
						<option value='kd' > <  </option>
						<option value='sd' > =  </option>
					</select>
					<input name="tinggi_badan" id="la_tinggi" placeholder="Tinggi (CM)" type="number" class="span5">	
              </div>
              <div class="control-group">
                  BB: 
					<select name="filter_bb" required id="la_filter_bb" class="span5">
						<option selected value='%' > Semua BB </option>
						<option value='lbs' > >= </option>
						<option value='lb' > > </option>
						<option value='kds' > <=  </option>
						<option value='kd' > <  </option>
						<option value='sd' > =  </option>
					</select>
					<input name="berat_badan" id="la_berat" placeholder="Berat (KG)" type="number" class="span5">	
              </div>
              <div class="control-group">
              </div>
             
              <div class="control-group">
                <button type="submit" class="btn btn-success span10">Set Filter</button>
              </div>
            </form>
				
			</div>
		</div>
	</div>
	<div class="span9">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-list"></i></span>
				<h5>Result</h5>
			</div>
			<div class="widget-box">
				<table id="la_tbl_anggota" class="table  responsive nowrap  font12" style="width:100%;">
					<thead>
						<tr>
						  <th>No</th>
						  <th>ID TGT</th>
						  <th>Nama Lengkap</th>
						  <th>Jenis Kelamin</th>
						  <th>Unit</th>
						  <th>Sabuk</th>
						  <th>Usia</th>
						  <th>Tinggi</th>
						  <th>Berat</th>
						  <th>TTL</th>
						</tr>
					</thead>
					<tbody id="la_tebodi_tbl_anggota"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>