$(document).ready(function(){
$(window).on('beforeunload',function(){
      return '';
    });
	//loading ajax
	var loading = $.loading();
	
	if(location.hash.length>1){
        var loc = location.hash
        var topage = loc.replace("#","v_")
	    $("#main_view").load('view/'+topage+".php");
	}else{
	    
	    $("#main_view").load('view/v_front_page.php');
	}
	
    $(window).hashchange(function(){
        var loc = location.hash
        var topage = loc.replace("#","v_")
	    $("#main_view").load('view/'+topage+".php");
    });

	// === Sidebar navigation === //

	$('.submenu > a').click(function(e)
	{
		if($(".visible-phone").css('display')=='block'){
			e.preventDefault();
			var submenu = $(this).siblings('ul');
			var li = $(this).parents('li');
			var submenus = $('#sidebar li.submenu ul');
			var submenus_parents = $('#sidebar li.submenu');
			if(li.hasClass('open'))
			{
				if(($(window).width() > 768) || ($(window).width() < 479)) {
					submenu.slideUp();
				} else {
					submenu.fadeOut(250);
				}
				li.removeClass('open');
			} else
			{
				if(($(window).width() > 768) || ($(window).width() < 479)) {
					submenus.slideUp();
					submenu.slideDown();
				} else {
					submenus.fadeOut(250);
					submenu.fadeIn(250);
				}
				submenus_parents.removeClass('open');
				li.addClass('open');
			}
		}
	});

	var ul = $('#sidebar > ul');

	$('#sidebar > a').click(function(e)
	{
		var sidebar = $('#sidebar');
		if(sidebar.hasClass('open'))
		{
			sidebar.removeClass('open');
			ul.slideUp(250);
		} else
		{
			sidebar.addClass('open');
			ul.slideDown(250);
		}
	});

	// === Resize window related === //
	$(window).resize(function()
	{
		if($(window).width() > 479)
		{
			ul.css({'display':'block'});
			$('#content-header .btn-group').css({width:'auto'});
		}
		if($(window).width() < 479)
		{
			ul.css({'display':'none'});
			fix_position();
		}
		if($(window).width() > 768)
		{
			$('#user-nav > ul').css({width:'auto',margin:'0'});
            $('#content-header .btn-group').css({width:'auto'});
		}
	});

	if($(window).width() < 468)
	{
		ul.css({'display':'none'});
		fix_position();
	}
	if($(window).width() > 479)
	{
	   $('#content-header .btn-group').css({width:'auto'});
		ul.css({'display':'block'});
	}

	// === Tooltips === //
	$('.tip').tooltip();
	$('.tip-left').tooltip({ placement: 'left' });
	$('.tip-right').tooltip({ placement: 'right' });
	$('.tip-top').tooltip({ placement: 'top' });
	$('.tip-bottom').tooltip({ placement: 'bottom' });

	// === Search input typeahead === //
	$('#search input[type=text]').typeahead({
		source: ['Dashboard','Form elements','Common Elements','Validation','Wizard','Buttons','Icons','Interface elements','Support','Calendar','Gallery','Reports','Charts','Graphs','Widgets'],
		items: 4
	});

	// === Fixes the position of buttons group in content header and top user navigation === //
	function fix_position()
	{
		var uwidth = $('#user-nav > ul').width();
		$('#user-nav > ul').css({width:uwidth,'margin-left':'-' + uwidth / 2 + 'px'});

        var cwidth = $('#content-header .btn-group').width();
        $('#content-header .btn-group').css({width:cwidth,'margin-left':'-' + uwidth / 2 + 'px'});
	}

	// === Style switcher === //
	$('#style-switcher i').click(function()
	{
		if($(this).hasClass('open'))
		{
			$(this).parent().animate({marginRight:'-=190'});
			$(this).removeClass('open');
		} else
		{
			$(this).parent().animate({marginRight:'+=190'});
			$(this).addClass('open');
		}
		$(this).toggleClass('icon-arrow-left');
		$(this).toggleClass('icon-arrow-right');
	});

	$('#style-switcher a').click(function()
	{
		var style = $(this).attr('href').replace('#','');
		$('.skin-color').attr('href','css/maruti.'+style+'.css');
		$(this).siblings('a').css({'border-color':'transparent'});
		$(this).css({'border-color':'#aaaaaa'});
	});

	$('.lightbox_trigger').click(function(e) {

		e.preventDefault();

		var image_href = $(this).attr("href");

		if ($('#lightbox').length > 0) {

			$('#imgbox').html('<img src="' + image_href + '" /><p><i class="icon-remove icon-white"></i></p>');

			$('#lightbox').slideDown(500);
		}

		else {
			var lightbox =
			'<div id="lightbox" style="display:none;">' +
				'<div id="imgbox"><img src="' + image_href +'" />' +
					'<p><i class="icon-remove icon-white"></i></p>' +
				'</div>' +
			'</div>';

			$('body').append(lightbox);
			$('#lightbox').slideDown(500);
		}

	});

	// $('#lightbox').live('click', function() {
		// $('#lightbox').hide(200);
	// });
	//tutup datepicker

	//tutup submenus
	$(".open").click(function(){removeClass(".open");})

	//datepicker dropdown fix ff

});

//preview foto
 function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("path_foto").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("foto_preview").src = oFREvent.target.result;
        };
    };
 function ePreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("e_path_foto").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("e_foto_preview").src = oFREvent.target.result;
        };
    };

//submit create new member


//load page
function loadView(page)
{
    
	if($(".visible-phone").css("display")!='none')
		$("#nav_mobile_title").click();
}


//page penilaian

function call_data(kategori='',val='',nilai='' ){
	data = null;
	data = {
			id:$("#id").val(),
			jenis_kelamin:$("#jenis_kelamin").val(),
			usia:$("#usia").val(),
			kategori:kategori,
			val:val, //val -> norma (kecepatan/jumlah) yg dicapai
			nilai:nilai
	}
};

$(document).on('click','#btn_proses_penilaian',function(){
		call_data();
		$(this).prop('disabled',true);
		if($("#id").val()==''){
			 swal("Harap Isi Nama Peserta!", {
					icon: "error"
			 });
			 $(this).prop('disabled',false);
				return false;
		}
		$(".aspek_penilaian").show();
		$("#btn_cancel").prop('disabled',false);
		$("#nama_peserta").prop('disabled',true);
		proses = 1;
		$("#tabspeed").click();

		$(".aspek_penilaian").show();
});

$(document).on('click','#btn_cancel',function(){
	$('input:text').val('');
	$('input[type=number]').val(0);
	$(this).prop('disabled','true');
	$('#btn_proses_penilaian').prop('disabled',false);
	$('#nama_peserta').prop('disabled',false);
	$(".aspek_penilaian").hide();
});


$(document).on('change, keyup',"#nama_peserta", function(){
	if($(this).val()=='')
	{
		$("#id").val('');
		$("#id_yetece").val('');
		$("#nama_unit").val('');
		$("#usia").val('');
	}
});


////////////////////////////////////////////////////////////////
//										SPEED
////////////////////////////////////////////////////////////////
$(document).on('click','#tabspeed',function(){
	$.ajax({
		url:'ajax/getter.php?act=getKelompokUmurSpeed',
		data:data,
		type:'post',
		success:function(res){
			$("#kelompok_umur_speed").val(res);
		}
	});
	$.ajax({
		url:'ajax/getter.php?act=getJarak',
		data:data,
		type:'post',
		success:function(res){
			$("#jarak_tempuh_speed").val(res);
		}
	});
	call_data('speed');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){

				$("#tebodi").html(data);

		}
	});
	$("#tbl_his_speed").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: false,bInfo: false
	});
});
$(document).on('change, keyup','#val_speed',function(){
	call_data();
	data['kategori'] = 'speed';
	data['val']=$("#val_speed").val();
	$.ajax({
		url:'ajax/getter.php?act=getNilai',
		type:'post',
		data:data,
		success:function(nilai){
			$("#nilai_speed").val(nilai)
		}
	});
});

$(document).on('click','#btn_simpan_speed',function(){
	call_data('speed',$("#val_speed").val(), $("#nilai_speed").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabspeed").click();
			}
		}
	});
});


////////////////////////////////////////////////////////////////
//										AGILITY
////////////////////////////////////////////////////////////////
$(document).on('click','#tabagi',function(){
	$.ajax({
		url:'ajax/getter.php?act=getKelompokUmurSpeed',
		data:data,
		type:'post',
		success:function(res){
			$("#kelompok_umur_agi").val(res);
		}
	});
	call_data('agility');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){
			$("#tebodi_agi").html(data);
		}
	});
	$("#tbl_his_agi").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: false,bInfo: false
	});
});
$(document).on('change, keyup','#val_agi',function(){
	call_data();
	data['kategori'] = 'agi'; // AGI == SPEED
	data['val']=$("#val_agi").val();
	$.ajax({
		url:'ajax/getter.php?act=getNilai',
		type:'post',
		data:data,
		success:function(nilai){
			$("#nilai_agi").val(nilai)
		}
	});
});

$(document).on('click','#btn_simpan_agi',function(){
	call_data('agility',$("#val_agi").val(), $("#nilai_agi").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabagi").click();
			}
		}
	});
});
////////////////////////////////////////////////////////////////
//										BALANCE
////////////////////////////////////////////////////////////////
$(document).on('click','#tabbalance',function(){
	
	$("#jenis_kelamin_bal").val($("#jenis_kelamin").val());
	
	call_data('balance');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){
			$("#tebodi_bal").html(data);
		}
	});
	$("#tbl_his_bal").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: true,bInfo: false
	});
});
$(document).on('change, keyup','#val_bal',function(){
	call_data();
	data['kategori'] = 'balance'; // AGI == SPEED
	data['val']=$("#val_bal").val();
	$.ajax({
		url:'ajax/getter.php?act=getNilai',
		type:'post',
		data:data,
		success:function(nilai){
			$("#nilai_bal").val(nilai)
		}
	});
});

$(document).on('click','#btn_simpan_bal',function(){
	call_data('balance',$("#val_bal").val(), $("#nilai_bal").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabbalance").click();
			}
		}
	});
});


////////////////////////////////////////////////////////////////
//										SITUP
////////////////////////////////////////////////////////////////
$(document).on('click','#tabsitup',function(){
	var usia=$("#usia").val();
	if(usia>=6 && usia<=12){$("#waktu_situp").val('30'+" Detik")};
	if(usia>12){$("#waktu_situp").val('60 Detik')};
	$.ajax({
		url:'ajax/getter.php?act=getKelompokUmurSitup',
		data:data,
		type:'post',
		success:function(res){
			$("#kelompok_umur_situp").val(res);
		}
	});
	call_data('situp');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){
			$("#tebodi_situp").html(data);
		}
	});
	$("#tbl_his_situp").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: false,bInfo: false
	});
});
$(document).on('change, keyup','#val_situp',function(){
	call_data();
	data['kategori'] = 'situp'; // AGI == SPEED
	data['val']=$("#val_situp").val();
	$.ajax({
		url:'ajax/getter.php?act=getNilai',
		type:'post',
		data:data,
		success:function(nilai){
			$("#nilai_situp").val(nilai)
		}
	});
});

$(document).on('click','#btn_simpan_situp',function(){
	call_data('situp',$("#val_situp").val(), $("#nilai_situp").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabsitup").click();
			}
		}
	});
});


////////////////////////////////////////////////////////////////
//										ENDURANCE
////////////////////////////////////////////////////////////////

$(document).on('click','#tabend',function(){
	$("#kelompok_umur_end").val($("#usia").val()+ " Tahun");
	call_data('endurance');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){

				$("#tebodi_end").html(data);

		}
	});
	$("#tbl_his_end").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: false,bInfo: false
		});
});

$(document).on('change','#val_end',function(){
	var val = $(this).val();
	$("#nilai_end").val(val);
});

$(document).on('click','#btn_simpan_end',function(){
	call_data('endurance',$("#val_end").val(), $("#nilai_end").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabend").click();
			}
		}
	});
});

////////////////////////////////////////////////////////////////
//                   VJUMP
////////////////////////////////////////////////////////////////
$(document).on('click','#tabvjump',function(){
	$.ajax({
		url:'ajax/getter.php?act=getKelompokUmurSitup',
		data:data,
		type:'post',
		success:function(res){
			$("#kelompok_umur_vjump").val(res);
		}
	});
	call_data('vjump');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){

				$("#tebodi_vjump").html(data);

		}
	});
	$("#tbl_his_vjump").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: false,bInfo: false
		});
});

$(document).on('change, keyup','#val_vjump',function(){
	var val = $(this).val();
	call_data('vjump',val);
	$.ajax({
		url:'ajax/getter.php?act=getNilai',
		type:'post',
		data:data,
		success:function(nilai){
			$("#nilai_vjump").val(nilai)
		}
	});
});

$(document).on('click','#btn_simpan_vjump',function(){
	call_data('vjump',$("#val_vjump").val(), $("#nilai_vjump").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabvjump").click();
			}
		}
	});
});

////////////////////////////////////////////////////////////////
//                   FLEX
////////////////////////////////////////////////////////////////
$(document).on('click','#tabflex',function(){
	var usia = $("#usia").val();
	$("#kelompok_umur_flex").val(usia+" Tahun");

	call_data('flex');
	$.ajax({
		url:'ajax/getter.php?act=getHis',
		data:data,
		async:false,
		type:'post',
		success:function(data){

				$("#tebodi_flex").html(data);

		}
	});
	$("#tbl_his_flex").dataTable({
			retrieve: true,
			"bJQueryUI": true,
			searching: false, paging: false,bInfo: false
		});
});

$(document).on('change, keyup','#val_flex',function(){
	var val = $(this).val();
	call_data('flex',val);
	$.ajax({
		url:'ajax/getter.php?act=getNilai',
		type:'post',
		data:data,
		success:function(nilai){
			$("#nilai_flex").val(nilai)
		}
	});
});

$(document).on('click','#btn_simpan_flex',function(){
	call_data('flex',$("#val_flex").val(), $("#nilai_flex").val());
	$.ajax({
		url:'ajax/setter.php?act=set_nilai',
		type:'post',
		data:data,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				swal("Data Tersimpan", {
					icon: "success"
				});
				$("#tabflex").click();
			}
		}
	});
});



//////////////////////////////////////////////////////////////////////////////////////////////////
// 																	V_LAPORAN
////////////////////////////////////////////////////////////////////////////////////////////////////

/// LAPORAN ABSEN
$(document).on('submit','#lab_filter',function(e){
	e.preventDefault();
	$("#lab_btn_get").prop('disabled',true);
	var data = $("#lab_filter").serialize();
	var bulan = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];
	var namaunit = $("#lab_select_unit option:selected").text();
	var periode = bulan[$("#lab_bulan").val()-1]+" "+$("#lab_tahun").val();
	$.get("ajax/getter.php?act=getAbsen",data,function(result){
		$("#lab_result").html(result);
		$("#lab_btn_get").prop('disabled',false);
		$("#lab_tbl_result").dataTable({
			"pageLength": 150,
			"ordering":false,
			"dom": 'Bfrt',
			"buttons": [
				'copyHtml5',
				{
					extend:'excelHtml5',
					 messageTop: 'Rekap Absensi Unit '+namaunit+' Periode '+periode,
					 messageBottom: 'keterangan: 1 = Masuk, - = Tidak Masuk'
				},
				'csvHtml5',
				'pdfHtml5'
				
			]
		});
	});  
});



//////////////////////////////////////////////////////////////////////////////////////////////////
// 																	V_ANGGOTA
////////////////////////////////////////////////////////////////////////////////////////////////////


//create form
$(document).on('submit',"#form_create_member",function(e){
	e.preventDefault();
	var formdata = new FormData($('#form_create_member')[0]);
	swal({
	  title: "Tambahkan Data?",
	  text: "Perubahan data selanjutnya bisa dilakukan pada menu Ubah",
	  icon: "info",
	  buttons: true,
	  dangerMode: false,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=create_member',
				data:formdata,
				type:'post',
				processData: false,
				contentType: false,
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{
						$('#form_create_member')[0].reset();
						$("#modal_tambah_data").modal('hide');

						swal("Data Tersimpan", {
							icon: "success"
						}).then(function(){
						    location.reload()
						});
					}
				}
			});

	  } else {
		return;
	  }
	});

});

//Edit Form
$(document).on('click',"#btn_ubah_data",function(){
	var id = $(this).closest('tr').find("#id_member").val();
	$.ajax({
		url:'ajax/getter.php?act=getDataMember&id='+id,
		type:'get',
		async:false,
		dataType:'json',
		success:function(data){
			$.each(data,function(i,dt){
				$("#e_alamat").val(dt.alamat);
				$("#e_berat_badan").val(dt.berat_badan);
				$("#e_id_geup").val(dt.id_geup);
				$("#e_id_rfid").val(dt.id_rfid);
				if(dt.id_sekolah!='')
					$("#e_id_sekolah").val(dt.id_sekolah);
				$("#e_id_tipe_anggota").val(dt.id_tipe_anggota);
				$("#e_gender").val(dt.gender);
				$("#e_nama_lengkap").val(dt.nama_lengkap);
				$("#e_nama_orang_tua").val(dt.nama_orang_tua);
				$("#e_no_hp").val(dt.no_hp);
				$("#e_tanggal_gabung").val(dt.tanggal_gabung);
				$("#e_tempat_lahir").val(dt.tempat_lahir);
				$("#e_tanggal_lahir").val(dt.tanggal_lahir);
				$("#e_tinggi_badan").val(dt.tinggi_badan);
				$("#e_reg_pbti").val(dt.reg_pbti);
				var time = (new Date()).getTime();
				$("#e_foto_preview").attr('src',dt.path_foto+'?time='+time);
				$("#e_id_member").val(id);
				$("#e_id_ytc").val(dt.id_ytc);
				$("#e_path_foto_string").val(dt.path_foto);
				$("#modal_edit_data").modal('show');
			})
		}
	});
});

//Update Member
$(document).on('submit',"#form_update_member",function(e){
	e.preventDefault();
	var formdata = new FormData($('#form_update_member')[0]);
	var id = $("#e_id_member").val();
	swal({
	  title: "Simpan Data?",
	  text: "Perubahan data selanjutnya bisa dilakukan pada menu Ubah",
	  icon: "info",
	  buttons: true,
	  dangerMode: false,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=update_member&id='+id,
				data:formdata,
				type:'post',
				processData: false,
				contentType: false,
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{
						$('#form_update_member')[0].reset();
						$("#modal_edit_data").modal('hide');

						if($(".visible-phone").css('display')=='block'){
							$("#nav_mobile_title").click();
						}
						swal("Data Tersimpan", {
							icon: "success"
						}).then(function(){
						    location.reload()
						});
					}
				}
			});

	  } else {
		return;
	  }
	});

});


//detail
$(document).on('click',"#btn_detail_data",function(){
	var node =   $(this).closest('tr');
	// if($(".visible-phone").css('display')=='block'){
		// node = $(this).closest('tr').('.gradex') :
	// } //if responsive
	var id = node.find("#id_member").val();
	$.ajax({
		url:'ajax/getter.php?act=getDataMember&id='+id,
		type:'get',
		async:false,
		dataType:'json',
		success:function(data){
			$.each(data,function(i,dt){
				$("#d_alamat").html(dt.alamat);
				$("#d_tb_bb").html(dt.tinggi_badan+' cm / '+dt.berat_badan+' kg');
				$("#d_geup").html(dt.geup);
				$("#d_id_ytc").html(dt.id_ytc);
				// $("#d_").html(dt.id_rfid);
				$("#d_unit").html(dt.nama_unit);
				$("#d_gender").html(dt.gender);
				$("#d_tipe_anggota").html(dt.tipe_anggota);
				$("#d_nama_lengkap").html(dt.nama_lengkap);
				// $("#e_nama_orang_tua").html(dt.nama_orang_tua);
				$("#d_no_hp").html(dt.no_hp);
				$("#d_tanggal_gabung").html(dt.tanggal_gabung);
				$("#d_ttl").html(dt.tempat_lahir+', '+dt.tanggal_lahir);
				$("#d_reg_pbti").html(dt.reg_pbti);
				var time = new Date().getTime();
				$("#foto_member").attr('src',dt.path_foto+'?time='+time);
				// $("#e_id_member").html(id);
				// $("#e_id_ytc").html(dt.id_ytc);
				// $("#e_path_foto_string").html(dt.path_foto);
				$("#modal_detail_data").modal('show');
			})
		}
	});
});

//delete
$(document).on('click',"#btn_hapus_data",function(){
	var node =   $(this).closest('tr');
	var id = node.find("#id_member").val();
	swal({
	  title: "Hapus Data?",
	  text: "Data akan terhapus.",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=delete_member',
				type:'post',
				data:{id:id},
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{

						swal("Data Terhapus", {
							icon: "success"
						}).then(function(){
						    location.reload()
						});
						if($(".visible-phone").css('display')=='block'){
							$("#nav_mobile_title").click();
						}
					}
				}
			});

	  } else {
		return;
	  }
	});
});

//////////////////////////////////////////////////////////////////////////////////////////////////
// 																	V_UNIT
////////////////////////////////////////////////////////////////////////////////////////////////////

//create unit
$(document).on('submit',"#form_create_unit",function(e){
	e.preventDefault();
	var formdata = new FormData($('#form_create_unit')[0]);
	swal({
	  title: "Tambahkan Data?",
	  text: "Perubahan data selanjutnya bisa dilakukan pada menu Ubah",
	  icon: "info",
	  buttons: true,
	  dangerMode: false,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=create_unit',
				data:formdata,
				type:'post',
				processData: false,
				contentType: false,
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{
						$('#form_create_unit')[0].reset();
						$("#modal_tambah_unit").modal('hide');

						swal("Data Tersimpan", {
							icon: "success"
						}).then(function(){
						    location.reload()
						});
					}
				}
			});

	  } else {
		return;
	  }
	});

});

//Edit
$(document).on('click','#btn_ubah_data_unit',function(){
	var id = $(this).closest('tr').find('#id').val();
	$("#e_id_unit").val(id);
	$.ajax({
		url:'ajax/getter.php?act=getDataUnit',
		type:'post',
		data:{id:id},
		async:false,
		dataType:'json',
		success:function(data){
			$.each(data,function(i,dt){
				$("#e_alamat").val(dt.alamat);
				$("#e_nama_unit").val(dt.nama_unit);
				$("#e_penanggung_jawab").val(dt.penanggung_jawab);
			});
		}
	});
	$("#modal_edit_unit").modal('show');
});
$(document).on('submit',"#form_edit_unit",function(e){
	e.preventDefault();
	var id = $("#e_id_unit").val();
	var formdata = new FormData($('#form_edit_unit')[0]);
	swal({
	  title: "Simpan Data?",
	  text: "Perubahan data selanjutnya bisa dilakukan pada menu Ubah",
	  icon: "info",
	  buttons: true,
	  dangerMode: false,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=update_unit',
				data:formdata,
				type:'post',
				processData: false,
				contentType: false,
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{
						$('#form_edit_unit')[0].reset();
						$("#modal_edit_unit").modal('hide');

						swal("Data Tersimpan", {
							icon: "success"
						}).then(function(){
						    location.reload()
						});

						if($(".visible-phone").css('display')=='block'){
							$("#nav_mobile_title").click();
						}
					}
				}
			});

	  } else {
		return;
	  }
	});
});


//hapus unit
$(document).on('click',"#btn_hapus_data_unit",function(){
	var node =   $(this).closest('tr');
	var id = node.find("#id").val();
	swal({
	  title: "Hapus Data?",
	  text: "Data akan terhapus.",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=delete_unit',
				type:'post',
				data:{id:id},
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{

						swal("Data Terhapus", {
							icon: "success"
						}).then(function(){
						    location.reload()
						});
						if($(".visible-phone").css('display')=='block'){
							$("#nav_mobile_title").click();
						}
					}
				}
			});

	  } else {
		return;
	  }
	});
});
//////////////////////////////////////////////////////////////////////////////////////////////////
// 																	V_ABSENSI
////////////////////////////////////////////////////////////////////////////////////////////////////

//absensi
$(document).on('click',"#setPulang",function(){
  $("#absensi").css('background','yellow');
  $("#absensi").css('color','black');
  $("#absensi").val('Pulang');
  $("#form_absensi").show();
  $("#rfid").focus();
})
$(document).on('click',"#setDatang",function(){
  $("#absensi").css('background','blue');
  $("#absensi").css('color','white');
  $("#absensi").val('Datang');
  $("#form_absensi").show();
  $("#rfid").focus();
});
$(document).on('submit',"#form_absensi",function(e){
  e.preventDefault();
  var id=$("#rfid").val();
  var time = (new Date()).getTime();
  var imgsource='ajax/foto_member/pp.png';
  var absen = $("#absensi").val();
  var tipeAbsensi = '1';
  if($("#absensi").val()=="Pulang") tipeAbsensi ='2';
  //getDetail
  $.ajax({
    url:'ajax/getter.php?act=getDetail',
    data:{rfid:id, id_member:id, tipe_absensi:tipeAbsensi },
    type:'post',
    async:false,
    dataType:'json',
    success:function(resx){
      $.each(resx,function(i,res){

        if(res.resp=="SudahAbsen"){
          $("#result").css('background','blue');
          $("#result").css('color','white');
          $("#result").val("Sudah Absen Masuk Hari Ini!");
        }
        else if(res.resp=="GagalPulang"){
          $("#result").css('background','red');
          $("#result").css('color','white');
          $("#result").val("Belum Absen Masuk!");
        }

        else if(res.resp=="SuksesMasuk"){
          $("#result").css('background','green');
          $("#result").css('color','white');
          $("#result").val("Sukses Absen Masuk!");
        }
        else if(res.resp=="SuksesKeluar"){
          $("#result").css('background','yellow');
          $("#result").css('color','black');
          $("#result").val("Sukses Absen Pulang!");
        }

        else{
          swal("Data Tidak Ditemukan!", {icon:'error'});
					return false;
        }
				$("#nama_peserta").val(res.nama_lengkap);
        $("#id_yetece").val(res.id_ytc);
        $("#nama_unit").val(res.nama_unit);
        if(res.path_foto!='') //kalo gak null.
          $("#pic").attr('src',res.path_foto+'?time='+time);
        else $("#pic").attr('src',imgsource+'?time='+time);

        setTimeout(function(){
          $("#rfid").val('');
          $("#rfid").focus();
          $("#nama_peserta").val('');
          $("#id_yetece").val('');
          $("#nama_unit").val('');
          $("#result").val('');
					$("#pic").removeAttr('src');
          $("#result").css('background','none');
        },1300); //clear
      });
    }
  })
})
//////////////////////////////////////////////////////////////////////////////////////////////////
// 																	Laporan siswa
////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('submit','#laps_formnew',function(e){
	e.preventDefault();
	var fd = $("#laps_formnew").serialize();
	$.ajax({
		url:'ajax/setter.php?act=insert_dataprestasisiswa',
		type:'post',
		data:fd,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				$('#laps_formnew')[0].reset();
				$('#laps_modalnew').modal('hide');
				swal("Data Tersimpan", {
					icon: "success"
				});
				reloadTblPrestasiSiswa()
			}
		}	
	});
});
$(document).on('submit','#laps_formedit',function(e){
	e.preventDefault();
	var fd = $("#laps_formedit").serialize();
	$.ajax({
		url:'ajax/setter.php?act=update_dataprestasisiswa',
		type:'post',
		data:fd,
		success:function(data){
			if(data!='Done!'){
				swal("FAILED! Error: "+data, {
					icon: "error"
				});
			}
			else{
				$('#laps_formedit')[0].reset();
				$('#laps_modaledit').modal('hide');
				swal("Data Tersimpan", {
					icon: "success"
				});
				reloadTblPrestasiSiswa()
			}
		}	
	});
});
function reloadTblPrestasiSiswa(){
	$("#laps_tbl").DataTable().destroy();
	var id = $("#laps_id").val();
	$.ajax({
		url:'ajax/getter.php?act=getDataPrestasiSiswa',
		data:{id:id},
		type:'get',
		async:false,
		success:function(dt){
			$("#tebodi_laps_tbl").html(dt);
		}
	});
	
	$("#laps_tbl").DataTable({
		"pageLength": 150,
		"ordering":false,
		"dom": 'Bfrt',
		"buttons": [
			'copyHtml5',
			{
				extend:'excelHtml5',
				exportOptions:{
					columns: [ 0, 1, 2,3,4, 5 ]
				},
				 messageTop: 'Data Prestasi Anggota '+$("#laps_nama_anggota").val(),
				 messageBottom: 'Generated by YTDS '
			},
			'csvHtml5',
			'pdfHtml5'
			
		]
	});
}
$(document).on('click','#laps_btn_get',function(e){
	e.preventDefault();
	reloadTblPrestasiSiswa();
});

$(document).on('click','#laps_btnnew',function(e){
	if($("#laps_id").val()=='')
		return alert('Harap isi Nama Anggota');
	$("#laps_nama_lengkap").val($("#laps_nama_anggota").val());
	$("#laps_id_member").val($("#laps_id").val());
	$("#laps_modalnew").modal('show');
});

function ubahPrestasi(id){
	//get prestasi detail
	$.ajax({
		url:'ajax/getter.php?act=get_prestasiDetail',
		type:'get',
		data:{id:id},
		dataType:'json',
		success:function(data){
			$.each(data,function(i,dt){
				$("#laps_nama_lengkape").val($("#laps_nama_anggota").val());
				$("#laps_ide").val(id);
				$("#laps_nama_evente").val(dt.event_name);
				$("#laps_id_evente").val(dt.id_event);
				$("#laps_hasile").val(dt.hasil);
				$("#laps_event_datee").val(dt.event_date);
				$("#laps_modaledit").modal('show');
			});
		}
	
	});
}
function hapusPrestasi(id){
	swal({
	  title: "Hapus Data?",
	  text: "Data akan terhapus.",
	  icon: "warning",
	  buttons: true,
	  dangerMode: true,
	})
	.then((procceed) => {
		if (procceed) {
			$.ajax({
				url:'ajax/setter.php?act=del_prestasiDetail',
				type:'post',
				data:{id:id},
				success:function(data){
					if(data!='Done!'){
						swal("FAILED! Error: "+data, {
							icon: "error"
						});
					}
					else{

						swal("Data Terhapus", {
							icon: "success"
						});
						reloadTblPrestasiSiswa();

					}
				}
			});

	  } else {
		return;
	  }
	});
}

$(document).on('submit','#la_formfilter',function(e){
	e.preventDefault();
	var fl = $("#la_formfilter").serialize();
	if($("#la_select_unit").val()==''){
		alert("Harap Pilih Unit");
		return false;
	}
	if($("#la_filter_umur").val()!='%'){
		if($("#la_usia").val()==''){
			alert("Harap Masukkan Usia");
			return false;
		}
	} 
	if($("#la_filter_tb").val()!='%'){
		if($("#la_tinggi").val()==''){
			alert("Harap Masukkan Tinggi Badan");
			return false;
		}
	}
	if($("#la_filter_bb").val()!='%'){
		if($("#la_bb").val()==''){
			alert("Harap Masukkan Berat Badan");
			return false;
		}
	}
	$("#la_tbl_anggota").DataTable().destroy();
	$.ajax({
		url:'ajax/getter.php?act=get_laporan_anggota',
		data:fl,
		type:'get',
		success:function(dt){
			$("#la_tebodi_tbl_anggota").html(dt);
			$("#la_tbl_anggota").DataTable({
				"pageLength": 150,
				"ordering":false,
				"dom": 'Bfrt',
				"buttons": [
					'copyHtml5',
					{
						extend:'excelHtml5',
						 messageTop: 'Daftar Nama Anggota',
						 messageBottom: 'Generated by YTDS '
					},
					'csvHtml5',
					'pdfHtml5'
					
				]
			});
		}
	});
})