<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-list-alt"></i> Anggota > Absensi </a></div>
</div>
<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
  <div class="span4">
		<div class="widget-box">
        <a id="setDatang" class="btn btn-mini btn-info span3"><i class="icon-ok-sign"></i> Datang</a>
        <a id="setPulang" class="btn btn-mini btn-warning span3" ><i class="icon-minus-sign"></i> Pulang</a>
			<div class="widget-title">
				<span class="icon"><i class="icon-th"></i></span>
				<h5>Absensi</h5>
			</div>
			<div class="widget-content">



        <form id="form_absensi" method="POST" action="">
  				<input class="span12" type='hidden' placeholder="" id="id" readonly>
  				<input type="text" class="span12" placeholder=" Scan RFID atau Input ID TGT" id="rfid" autofocus>
  				<input type="text" class="span6" placeholder=" Absensi" id="absensitext" value="Absen" readonly>
  				<input type="text" class="span6" placeholder=" " id="absensi" readonly>
  				<input type="text" class="span12" placeholder=" Nama" id="nama_peserta" readonly>
  				<input type="text" class="span12" placeholder=" ID TGT" id="id_yetece" readonly>
  				<input type="text" class="span12" placeholder=" Unit" id="nama_unit" readonly>
  				<img id="pic" width="120"><input class="span8" type="text" id="result"><hr/>
          <input type="submit" value="Proses" >
        </form>
			</div>
		</div>
	</div>
</div>
<script>

$("#form_absensi").hide();

</script>
