<?php
	include 'conn.php';
	session_start();
	if(!isset($_SESSION['logged_in_ytds']))
		die("Unauthorized Action! ");
	extract($_GET);
	if($act=='create_member')
	{
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);

		$insert = $conn->query("
			INSERT INTO ytds_member (nama_lengkap,id_sekolah,tempat_lahir,tanggal_lahir,tinggi_badan,berat_badan,
									no_hp, nama_orang_tua,alamat,reg_pbti,id_geup,tanggal_gabung,id_tipe_anggota,
									id_rfid,gender)
			VALUES('$nama_lengkap','$id_sekolah','$tempat_lahir','$tanggal_lahir','$tinggi_badan','$berat_badan',
					'$no_hp','$nama_orang_tua','$alamat','$reg_pbti','$id_geup','$tanggal_gabung','$id_tipe_anggota',
					'$id_rfid','$gender');
		");

		if($insert)
		{
			$last_id =  $conn->insert_id; //BUAT GENERATE YTCID -> Nama Foto.
			$select = $conn->query("SELECT id, id_sekolah,id_tipe_anggota FROM ytds_member WHERE id = '$last_id'");
			$ret = $select->fetch_assoc();
			//format YETECE – TAHUN – 2 Digit Kode Unit – 1 Digit Type Anggota – 4 Digit DB insert ID
			$id_ytc = 'TGT-'.date('Y',strtotime($tanggal_gabung)).$ret['id_sekolah'].$ret['id_tipe_anggota'].$ret['id'];
			$update_ytc_id = $conn->query("UPDATE ytds_member SET id_ytc = '$id_ytc' WHERE id='$last_id'");
			if($update_ytc_id){
				if($_FILES["path_foto"]["name"]!='')
				{
					$ekstensi = pathinfo($_FILES['path_foto']['name'])['extension'];
					$filename = $id_ytc.'.'.$ekstensi;

					$tmp = $_FILES['path_foto']['tmp_name'];
					$target = 'foto_member/'.$filename;
					$upload_path = 'ajax/foto_member/'.$filename;
					move_uploaded_file($tmp, $target);

					$update = $conn->query("update ytds_member set path_foto = '$upload_path' where id_ytc = '$id_ytc'");
					if($update)
						echo "Done!";
					else echo $conn->error;

				}
				else echo "Done!";
			}
			else echo $conn->error;
		}
		else echo $conn->error;
	}

	if($act=='update_member'){
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);
		$update = $conn->query("
			REPLACE INTO ytds_member (id,id_ytc,path_foto,nama_lengkap,id_sekolah,tempat_lahir,tanggal_lahir,tinggi_badan,berat_badan,
								no_hp, nama_orang_tua,alamat,reg_pbti,id_geup,tanggal_gabung,id_tipe_anggota,
								id_rfid,gender)
			VALUES('$id','$id_ytc','$path_foto','$nama_lengkap','$id_sekolah','$tempat_lahir','$tanggal_lahir','$tinggi_badan','$berat_badan',
				'$no_hp','$nama_orang_tua','$alamat','$reg_pbti','$id_geup','$tanggal_gabung','$id_tipe_anggota',
				'$id_rfid','$gender');
		");
		if($update)
		{
			if($_FILES["path_foto"]["name"]!='')
			{

				$ekstensi = pathinfo($_FILES['path_foto']['name'])['extension'];
				$filename = $id_ytc.'.'.$ekstensi;

				$tmp = $_FILES['path_foto']['tmp_name'];
				$target = 'foto_member/'.$filename;
				$upload_path = 'ajax/foto_member/'.$filename;
				move_uploaded_file($tmp, $target);

				$update = $conn->query("update ytds_member set path_foto = '$upload_path' where id_ytc = '$id_ytc'");
				if($update)
					echo "Done!";
				else echo $conn->error;

			}
			else echo "Done!";
		}
		else echo $conn->error;
	}

	if($act=='delete_member'){
		extract($_POST);
		$delete = $conn->query('DELETE FROM ytds_member WHERE id="'.$id.'"');
		if($delete)
			echo "Done!";
		else echo $conn->error;
	}

	if($act=='create_unit'){
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);

		$insert = $conn->query("
			INSERT INTO ytds_unit(nama_unit,alamat,penanggung_jawab)
			VALUES('$nama_unit','$alamat','$penanggung_jawab');
		");
		if($insert)
			echo "Done!";
		else echo $conn->error;
	}
	if($act=='update_unit'){

		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);

		$update = $conn->query("UPDATE ytds_unit SET nama_unit='$nama_unit' , alamat='$alamat', penanggung_jawab='$penanggung_jawab' where id = '$id'");
		if($update)
			echo "Done!";
		else echo $conn->error;
	}


	if($act=='delete_unit'){
		extract($_POST);
		$delete = $conn->query('DELETE FROM ytds_unit WHERE id="'.$id.'"');
		if($delete)
			echo "Done!";
		else echo $conn->error;
	}


	if($act=='set_nilai')
	{
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);
		if($kategori=='speed'){$kat = 1;}
		if($kategori=='endurance'){$kat = 2;}
		if($kategori=='flex'){$kat = 3;}
		if($kategori=='balance'){$kat = 4;}
		if($kategori=='agility'){$kat = 5;}
		if($kategori=='vjump'){$kat = 6;}
		if($kategori=='situp'){$kat = 7;}

		$creator = $_SESSION['nama_lengkap'];
		$q = "INSERT INTO ytds_nilai VALUES('','$id','$usia', '$kat','$val','$nilai','$creator',now())";
		$exec = $conn->query($q);
		if ($exec) {
			echo "Done!";
		}
		else echo $conn->error;
	}

	if($act=='insert_dataprestasisiswa')
	{
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);
		$get = $conn->query("
			SELECT point 
			FROM ytds_point_event
			WHERE id = '$id_event'
		")->fetch_assoc();
		$point = $get['point']+$hasil;
		$ins=$conn->query("
			INSERT INTO ytds_prestasi_anggota (id_member,event_name,id_event,hasil,point,event_date)
			VALUES ('$id_member','$event_name','$id_event','$hasil','$point','$event_date');	
		");
		if ($ins) {
			echo "Done!";
		}
		else echo $conn->error;
	}
	if($act=='update_dataprestasisiswa')
	{
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);
		$get = $conn->query("
			SELECT point 
			FROM ytds_point_event
			WHERE id = '$id_event'
		")->fetch_assoc();
		$point = $get['point']+$hasil;
		$ins=$conn->query("
			UPDATE ytds_prestasi_anggota 
			SET event_name = '$event_name', id_event= '$id_event',hasil= '$hasil',point= '$point',event_date= '$event_date'
			WHERE id = '$id'
		");
		if ($ins) {
			echo "Done!";
		}
		else echo $conn->error;
	}
	if($act=='del_prestasiDetail'){
		foreach($_POST as $key => $value)
		{
		  $clean[$key] = mysqli_real_escape_string($conn,$value);
		}
		extract($clean);
		$del = $conn->query("
			DELETE FROM ytds_prestasi_anggota
			WHERE id='$id'
		");
		if ($del) {
			echo "Done!";
		}
		else echo $conn->error;
	}
?>
