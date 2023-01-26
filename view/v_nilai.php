<div id="content-header">
    <div id="breadcrumb"> <a><i class="icon-list-alt"></i> Anggota > Penilaian </a></div>
</div>
<div class="row-fluid">
&nbsp;
</div>
<div class="row-fluid">
    <div class="span3">
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-th"></i></span>
				<h5>Data Member</h5>
			</div>
			<div class="widget-content">
				<input class="span12" type='hidden' placeholder="" id="id" readonly>
				<input type="text" class="span12" placeholder=" Input Nama Peserta" id="nama_peserta">
				<input type="text" class="span12" placeholder=" ID TGT" id="id_yetece" readonly>
				<input type="text" class="span12" placeholder=" Unit" id="nama_unit" readonly>
				<input type="text" class="span12" placeholder=" Jenis Kelamin" id="jenis_kelamin" readonly>
				<div class="input-append">
				  <input class="span5" id="usia" type="text" readonly>
				  <span class="add-on">Tahun</span>
				</div>
				  <button id="btn_proses_penilaian" class="btn btn-info"> Proses </button>
				  <button id="btn_cancel" class="btn btn-danger"> Selesai </button>
			</div>
		</div>
	</div>

    <div class="span8 aspek_penilaian" >
		<div class="widget-box">
			<div class="widget-title">
				<span class="icon"><i class="icon-th"></i></span>
				<h5>Komponen Biomotorik </h5>
			</div>
      <div class="widget-content tab-content">

        <ul class="nav nav-tabs">
            <li class="active"><a id='tabspeed' data-toggle="tab" href="#tab1">Speed</a></li>
            <li><a id="tabend" data-toggle="tab" href="#tab2">Endurance</a></li>
            <li><a id="tabflex" data-toggle="tab" href="#tab3">Flexibility</a></li>
            <li><a id="tabbalance" data-toggle="tab" href="#tab4">Balance</a></li>
            <li><a id="tabagi" data-toggle="tab" href="#tab5">Agility</a></li>
            <li><a id='tabvjump' data-toggle="tab" href="#tab6">Power</a></li>
            <li><a id='tabsitup' data-toggle="tab" href="#tab7">Strength</a></li>
        </ul>
        <div class="tab-content">
          <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB SPEED ''''''''''''''''''''''''''''''''''''''''''' -->
          <div id="tab1" class="tab-pane active">
            <div class="span6">
              <table>
                <tr>
                  <td>Kelompok Umur</td>
                  <td>&nbsp;</td>
                  <td><input type="text" readonly id="kelompok_umur_speed"></td>
                </tr>
                <tr>
                  <td>Jarak Tempuh</td>
                  <td>&nbsp;</td>
                  <td><input type="text" readonly id="jarak_tempuh_speed"></td>
                </tr>
              </table>

            </div>

            <div class="span6">
              <table>
                <tr>
                  <td><b><u>Waktu</u></b></td>
                  <td>&nbsp;</td>
                  <td><div class="input-append">
                    <input class="span4" type="number" step="0.1" min="0.0" id="val_speed" value="0.0">
                    <span class="add-on">Detik</span>
                  </div></td>
                </tr>
                <tr>
                  <td><b>Nilai</b></td>
                  <td>&nbsp;</td>
                  <td><input type="text" class="span3" readonly id="nilai_speed" value=""> dari 5</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><button id="btn_simpan_speed" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                </tr>
              </table>
            </div>

              Histori Penilaian
              <table id='tbl_his_speed'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Penilaian</th>
                    <th>Usia Saat Test</th>
                    <th>Penilai</th>
                    <th>Kecepatan (detik)</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody id='tebodi'>

                </tbody>
              </table>
          </div>

          <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB ENDURANCE ''''''''''''''''''''''''''''''''''''''''''' -->
          <div id="tab2" class="tab-pane">
            <div class="span6">
              <table>
                <tr>
                  <td>Kelompok Umur</td>
                  <td>&nbsp;</td>
                  <td><input type="text" readonly id="kelompok_umur_end"></td>
                </tr>
              </table>

            </div>

            <div class="span6">
              <table>
                <tr>
                  <td><b><u>Nilai</u></b></td>
                  <td>&nbsp;</td>
                  <td>
                  <select id="val_end">
                    <?php $i=1; for($i;$i<=5;$i++): echo "<option value='$i'>$i</option>"; endfor;?>
                  </select></td>
                </tr>
                <tr>
                  <td><b>Nilai</b></td>
                  <td>&nbsp;</td>
                  <td><input type="text" class="span3" readonly id="nilai_end" value="1"> dari 5</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><button id="btn_simpan_end" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                </tr>
              </table>
            </div>
            Histori Penilaian
            <table id='tbl_his_end'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Penilaian</th>
                  <th>Usia Saat Test</th>
                  <th>Penilai</th>
                  <th>Poin</th>
                  <th>Nilai</th>
                </tr>
              </thead>
              <tbody id='tebodi_end'>

              </tbody>
            </table>
          </div>
          <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB Flexibility ''''''''''''''''''''''''''''''''''''''''''' -->
          <div id="tab3" class="tab-pane">
            <div class="span6">
              <table>
                <tr>
                  <td>Kelompok Umur</td>
                  <td>&nbsp;</td>
                  <td><input type="text" readonly id="kelompok_umur_flex"></td>
                </tr>
              </table>

            </div>

            <div class="span6">
              <table>
                <tr>
                  <td><b><u>Jangkauan</u></b></td>
                  <td>&nbsp;</td>
                  <td><div class="input-append">
                    <input class="span4" type="number" step="1" min="0.0" id="val_flex" value="0.0">
                    <span class="add-on"> cm</span>
                  </div></td>
                </tr>
                <tr>
                  <td><b>Nilai</b></td>
                  <td>&nbsp;</td>
                  <td><input type="text" class="span3" readonly id="nilai_flex" value="5"> dari 5</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><button id="btn_simpan_flex" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                </tr>
              </table>
            </div>
            Histori Penilaian
            <table id='tbl_his_flex'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Penilaian</th>
                  <th>Usia Saat Test</th>
                  <th>Penilai</th>
                  <th>Jangkauan (cm)</th>
                  <th>Nilai</th>
                </tr>
              </thead>
              <tbody id='tebodi_flex'>

              </tbody>
            </table>
          </div>

            <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB BALANCE ''''''''''''''''''''''''''''''''''''''''''' -->

            <div id="tab4" class="tab-pane">
            	<div class="span6">
                <table>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <td>&nbsp;</td>
                    <td><input type="text" readonly id="jenis_kelamin_bal"></td>
                  </tr>
                </table>

              </div>

              <div class="span6">
                <table>
                  <tr>
                    <td><b><u>Waktu</u></b></td>
                    <td>&nbsp;</td>
                    <td><div class="input-append">
                      <input class="span4" type="number" step="0.1" min="0.0" id="val_bal" value="0.0">
                      <span class="add-on">Detik</span>
                    </div></td>
                  </tr>
                  <tr>
                    <td><b>Nilai</b></td>
                    <td>&nbsp;</td>
                    <td><input type="text" class="span3" readonly id="nilai_bal" value=""> dari 5</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><button id="btn_simpan_bal" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                  </tr>
                </table>
              </div>

                Histori Penilaian
                <table id='tbl_his_bal'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Penilaian</th>
                      <th>Usia Saat Test</th>
                      <th>Penilai</th>
                      <th>Waktu (Detik)</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody id='tebodi_bal'>

                  </tbody>
                </table>

            </div>

            <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB AGILITY ''''''''''''''''''''''''''''''''''''''''''' -->
            <div id="tab5" class="tab-pane">
              <div class="span6">
                <table>
                  <tr>
                    <td>Kelompok Umur</td>
                    <td>&nbsp;</td>
                    <td><input type="text" readonly id="kelompok_umur_agi"></td>
                  </tr>
                </table>

              </div>

              <div class="span6">
                <table>
                  <tr>
                    <td><b><u>Waktu</u></b></td>
                    <td>&nbsp;</td>
                    <td><div class="input-append">
                      <input class="span4" type="number" step="0.1" min="0.0" id="val_agi" value="0.0">
                      <span class="add-on">Detik</span>
                    </div></td>
                  </tr>
                  <tr>
                    <td><b>Nilai</b></td>
                    <td>&nbsp;</td>
                    <td><input type="text" class="span3" readonly id="nilai_agi" value=""> dari 5</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><button id="btn_simpan_agi" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                  </tr>
                </table>
              </div>

                Histori Penilaian
                <table id='tbl_his_agi'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Penilaian</th>
                      <th>Usia Saat Test</th>
                      <th>Penilai</th>
                      <th>Kecepatan (detik)</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody id='tebodi_agi'>

                  </tbody>
                </table>

            </div>



            <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB VJUMP ''''''''''''''''''''''''''''''''''''''''''' -->
            <div id="tab6" class="tab-pane">
              <div class="span6">
                <table >
                  <tr>
                    <td>Kelompok Umur</td>
                    <td>&nbsp;</td>
                    <td><input type="text" readonly id="kelompok_umur_vjump"></td>
                  </tr>
                </table>
              </div>
              <div class="span6">
                <table>
                  <tr>
                    <td><b><u>Tinggi Lompatan</u></b></td>
                    <td>&nbsp;</td>
                    <td><div class="input-append">
                      <input class="span4" type="number" step="1" min="0" id="val_vjump" value="0">
                      <span class="add-on"> cm</span>
                    </div></td>
                  </tr>
                  <tr>
                    <td><b>Nilai</b></td>
                    <td>&nbsp;</td>
                    <td><input type="text" class="span3" readonly id="nilai_vjump" value=""> dari 5</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><button id="btn_simpan_vjump" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                  </tr>
                </table>
              </div>

              Histori Penilaian
              <table id='tbl_his_vjump'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Penilaian</th>
                    <th>Usia Saat Test</th>
                    <th>Penilai</th>
                    <th>Lompatan (cm)</th>
                    <th>Nilai</th>
                  </tr>
                </thead>
                <tbody id='tebodi_vjump'>

                </tbody>
              </table>
            </div>




            <!-- ''''''''''''''''''''''''''''''''''''''''''' TAB SITUP ''''''''''''''''''''''''''''''''''''''''''' -->
            <div id="tab7" class="tab-pane">
              <div class="span6">
                <table >
                  <tr>
                    <td>Kelompok Umur</td>
                    <td>&nbsp;</td>
                    <td><input type="text" readonly id="kelompok_umur_situp"></td>
                  </tr>
                  <tr>
                    <td>Waktu</td>
                    <td>&nbsp;</td>
                    <td><input type="text" readonly id="waktu_situp" value="60 Detik"></td>
                  </tr>
                </table>

              </div>

              <div class="span6">
                <table>
                  <tr>
                    <td><b><u>Jumlah Sit Up</u></b></td>
                    <td>&nbsp;</td>
                    <td><div class="input-append">
                      <input class="span4" type="number" step="1" min="0" id="val_situp" value="0">
                      <span class="add-on">Kali</span>
                    </div></td>
                  </tr>
                  <tr>
                    <td><b>Nilai</b></td>
                    <td>&nbsp;</td>
                    <td><input type="text" class="span3" readonly id="nilai_situp" value=""> dari 5</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><button id="btn_simpan_situp" class="btn btn-success"> <span class="icon-ok"></span> Simpan Data  </button></td>
                  </tr>
                </table>
              </div>
                  Histori Penilaian
                  <table id='tbl_his_situp'  class="table table-bordered  responsive nowrap  font10" style="width:99%;" >
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal Penilaian</th>
                        <th>Usia Saat Test</th>
                        <th>Penilai</th>
                        <th>Jumlah</th>
                        <th>Nilai</th>
                      </tr>
                    </thead>
                    <tbody id='tebodi_situp'>

                    </tbody>
                  </table>
            </div>


            <!-- '''''''''''''''''''''''''''''''''''''''''''''''''''''END TAB''''''''''''''''''''''''''''''''''''''' -->
          </div>
      </div>
    </div>
  </div>
</div>

<script>
    var proses = 0;
    $(".aspek_penilaian").hide();
    var kategori_penilaian = '';
    var nilai = '';
    var data ='';

    $("#btn_cancel").prop('disabled',true);

	$("#nama_peserta").autocomplete
    ({
        source: function (request, response)
        {
            $.ajax(
            {
                url: "ajax/getter.php?act=getDataMemberByWord",
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
                                label: item.nama_lengkap+' | '+item.nama_unit,
                                idytc: item.id_ytc,
                                unit:item.nama_unit,
                                usia:item.usia,
                                jenis_kelamin:item.gender
                                }
                    }));
                }
            });
        },
        focus: function (event, ui)
        {
            $(this).val(ui.item.value);
            $("#id").val(ui.item.id);  //put the stateProvince abbrev'n in the hidden input box
            $("#id_yetece").val(ui.item.idytc);
            $("#nama_unit").val(ui.item.unit);
            $("#usia").val(ui.item.usia);
            $("#jenis_kelamin").val(ui.item.jenis_kelamin);
        },
        select: function (event, ui)
        {
            $(this).val(ui.item.value);
            $("#id").val(ui.item.id);  //put the stateProvince abbrev'n in the hidden input box
            $("#id_yetece").val(ui.item.idytc);
            $("#nama_unit").val(ui.item.unit);
            $("#usia").val(ui.item.usia);
            $("#jenis_kelamin").val(ui.item.jenis_kelamin);
        },
        minLength: 2
    });

</script>
