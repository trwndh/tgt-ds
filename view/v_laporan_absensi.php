<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-list-alt"></i> Laporan > Laporan Absensi </a></div>
</div>
<div class="row-fluid">
	<div class="span12">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-search"></i></span>
				<h5>Filter Data</h5>
			</div>
			<div class="widget-content">
			  
				<form class="form-horizontal font10" id="lab_filter"> 
					<select id="lab_select_unit" name="id_unit" class="span3" >
						<option selected disabled hidden> -- Pilih Unit -- </option>
						<?php
							include '../ajax/conn.php';
							$namunit = '';
							$q = $conn->query("SELECT * FROM ytds_unit ORDER BY nama_unit ASC ");
							while($res=$q->fetch_assoc()){
								echo "<option value = '".$res['id']."'>".$res['nama_unit']."</option>";
								$namunit = $res['nama_unit'];
							}
						?>
					</select>	<input type="hidden" id="lab_namaunit">
					<select name="bulan" id="lab_bulan">
						<option selected="selected" hidden disabled> -- Bulan --</option>
						<?php
						$bln=array(1=>"Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
						for($bulan=1; $bulan<=12; $bulan++){
							echo "<option value='$bulan'>$bln[$bulan]</option>"; 
						
						}
						?>
					</select>
					<select name="id_tipe_anggota" id="">
						<?php
							$query = $conn->query("select * from ytds_tipe_anggota where id not in(1,99)");
							while($res=$query->fetch_assoc()){
								echo "<option value='".$res['id']."'>".$res['tipe_anggota']."</option>";
							}
						?>
					</select>
					<input name="tahun" value="2018" required id="lab_tahun" placeholder="Tahun" type="number" min="2018" class="span1">	
					<button class="btn  btn-info" id="lab_btn_get"> Submit </button>
				</form>
				
			</div>
		</div>
	</div>
</div>
<div class="row-fluid">
  <div class="span12">
		<div class="widget-box">
			
			<div class="widget-content">
				<div id="lab_result"> <h5> Masukkan Parameter Di Kotak Filter </div>
			</div>
		</div>
	</div>
</div>