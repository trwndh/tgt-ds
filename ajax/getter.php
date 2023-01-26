<?php

	require_once 'conn.php';
	session_start();

	extract($_GET);
	if($act=='auth')
	{
		extract($_POST);
		$username = mysqli_escape_string($conn,$a);
		$password = mysqli_escape_string($conn,$b);
		$auth = $conn->query("select * from ytds_login where login = '$username' and password = '$password'");
		if($auth->num_rows>0)
		{
			$res = $auth->fetch_assoc();
			$_SESSION['logged_in_ytds']=true;
			$_SESSION['nama_lengkap']=$res['nama_lengkap'];
			$_SESSION['id_akses']=$res['id_akses'];
			$_SESSION['id_tipe_anggota']=$res['id_tipe_anggota'];
			echo 'ok';
		}
		else echo 'Login Failed';
	}
	if(!isset($_SESSION['logged_in_ytds']))
		die("Unauthorized Action! ");
	if($act=='getDataMember'){
		$get = $conn->query("select mem.* , ge.geup, u.nama_unit, a.tipe_anggota
							from ytds_member mem
							left join ytds_geup ge
							on ge.id = mem.id_geup
							left join ytds_unit u
							on u.id = mem.id_sekolah
							left join ytds_tipe_anggota a
							on a.id = mem.id_tipe_anggota
							where mem.id='$id'
							");
		$rows = array();
		while($r = $get->fetch_assoc()){
			$rows[]=$r;
		}
		echo json_encode($rows);
	}
	if($act=='getDataMemberByWord'){
		$qu = "select mem.* , floor(year(now())-year(mem.tanggal_lahir)) as usia, ge.geup, u.nama_unit, a.tipe_anggota
							from ytds_member mem
							left join ytds_geup ge
							on ge.id = mem.id_geup
							left join ytds_unit u
							on u.id = mem.id_sekolah
							left join ytds_tipe_anggota a
							on a.id = mem.id_tipe_anggota
							where mem.nama_lengkap LIKE \"%$term%\"
							";
		$get = $conn->query($qu);
		$result= array();

		while($r = $get->fetch_assoc()){
			$result[] = $r;
		}
		// header("Content-type:application/json");
		echo json_encode($result);
		// echo $qu;
	}
	if($act=='getDataPrestasiByWord'){
		$qu = "select mem.* , floor(year(now())-year(mem.tanggal_lahir)) as usia, ge.geup, u.nama_unit, a.tipe_anggota
							from ytds_member mem
							left join ytds_geup ge
							on ge.id = mem.id_geup
							left join ytds_unit u
							on u.id = mem.id_sekolah
							left join ytds_tipe_anggota a
							on a.id = mem.id_tipe_anggota
							where mem.nama_lengkap LIKE \"%$term%\"
							and (mem.id_tipe_anggota = '4' or mem.id_tipe_anggota = '5')
							";
		$get = $conn->query($qu);
		$result= array();

		while($r = $get->fetch_assoc()){
			$result[] = $r;
		}
		// header("Content-type:application/json");
		echo json_encode($result);
		// echo $qu;
	}

	if($act=='getDataUnit'){
		extract($_POST);
		$get = $conn->query("select u.* from ytds_unit u left join ytds_member pj on u.penanggung_jawab = pj.id where u.id='$id'");

		$rows = array();
		while($r = $get->fetch_assoc()){
			$rows[]=$r;
		}
		echo json_encode($rows);
	}

	///Penilaian////

	if($act=='getHis'){
		extract($_POST);
		if($kategori=='speed'){$kat = 1;}
		if($kategori=='endurance'){$kat = 2;}
		if($kategori=='flex'){$kat = 3;}
		if($kategori=='balance'){$kat = 4;}
		if($kategori=='agility'){$kat = 5;}
		if($kategori=='vjump'){$kat = 6;}
		if($kategori=='situp'){$kat = 7;}

		$q = "SELECT nil.id, nil.id_member, nil.usia_saat_test, nil.val, nil.nilai, nil.dibuat_oleh, nil.tanggal_penilaian
					FROM ytds_nilai nil
					left join ytds_kategori_penilaian kat
					on nil.kategori_penilaian = kat.id
					WHERE nil.id_member = '$id' and kat.id = '$kat'
					ORDER BY nil.id desc
				";
		$exec = $conn->query($q);
		if($exec->num_rows < 1)
		{
			echo "<tr><td colspan='6'><span class='center'>Tidak Ada Data</span></td></tr>";
		}
		else{
			$no = 1;
			while($row = $exec->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$row['tanggal_penilaian']."</td>";
				echo "<td>".$row['usia_saat_test']." Tahun</td>";
				echo "<td>".$row['dibuat_oleh']."</td>";
				echo "<td>".$row['val']."</td>";
				echo "<td>".$row['nilai']."</td>";
				echo "</tr>";
				$no++;
			}
		}
	}

	if($act=='getKelompokUmurSpeed'){
		extract($_POST);
		if($usia>=6 && $usia<10)
			echo "Usia 6 s/d 9 Tahun";
		if($usia>=10 && $usia<13)
			echo "Usia 10 s/d 12 Tahun";
		if($usia>=13 && $usia<17)
			echo "Usia 13 s/d 16 Tahun";
		if($usia>=17 && $usia<20)
			echo "Usia 17 s/d 19 Tahun";
	}
	if($act=='getKelompokUmurSitup'){ //sama kayak vjump
		extract($_POST);
		if($usia>=6 && $usia<10)
			echo "Usia 6 s/d 9 Tahun";
		if($usia>=10 && $usia<13)
			echo "Usia 10 s/d 12 Tahun";
		if($usia>=13 && $usia<16)
			echo "Usia 13 s/d 15 Tahun";
		if($usia>=16 && $usia<20)
			echo "Usia 16 s/d 19 Tahun";
	}

	if($act=='getJarak'){
		extract($_POST);
		if($usia>=6 && $usia<10)
			echo "30 Meter";
		if($usia>=10 && $usia<13)
			echo "40 Meter";
		if($usia>=13 && $usia<16)
			echo "50 Meter";
		if($usia>=16 && $usia<20)
			echo "60 Meter";
	}

	if($act=='getNilai')
	{
		extract($_POST);
		switch ($kategori) {
			case 'speed':
					if($usia>=6 && $usia<=9)
					{
						if($jenis_kelamin=='Laki-laki'){
							if($val <= 5.5)
							{
								echo "5";
							}
							else if ($val >= 5.6 && $val <=6.1)
							{
								echo "4";
							}
							else if($val >=6.2 && $val <=6.9){
								echo "3";
							}
							else if($val >=7.0 && $val <=8.6){
								echo "2";
							}
							else if($val >=8.7){
								echo "1";
							}
						}
						else{ //Perempuan
							if($val <= 5.8)
							{
								echo "5";
							}
							else if ($val >= 5.9 && $val <=6.6)
							{
								echo "4";
							}
							else if($val >=6.7 && $val <=7.8){
								echo "3";
							}
							else if($val >=7.9 && $val <=9.2){
								echo "2";
							}
							else if($val >=9.3){
								echo "1";
							}
						}

					}
					if($usia>=10 && $usia<=12)
					{
						if($jenis_kelamin=='Laki-laki'){
							if($val <= 6.3)
							{
								echo "5";
							}
							else if ($val >=6.4 && $val <=6.9)
							{
								echo "4";
							}
							else if($val >=7.0 && $val <=7.7){
								echo "3";
							}
							else if($val >=7.8 && $val <=8.8){
								echo "2";
							}
							else if($val >=8.9){
								echo "1";
							}
						}
						else{ //Perempuan
							if($val <= 6.7)
							{
								echo "5";
							}
							else if ($val >= 6.8 && $val <=7.5)
							{
								echo "4";
							}
							else if($val >=7.6 && $val <=8.3){
								echo "3";
							}
							else if($val >=8.4 && $val <=9.6){
								echo "2";
							}
							else if($val >=9.7){
								echo "1";
							}
						}

					}
					if($usia>=13 && $usia<=16)
					{
						if($jenis_kelamin=='Laki-laki'){
							if($val <= 6.7)
							{
								echo "5";
							}
							else if ($val >=6.4 && $val <=7.6)
							{
								echo "4";
							}
							else if($val >=7.7 && $val <=8.7){
								echo "3";
							}
							else if($val >=8.8 && $val <=10.3){
								echo "2";
							}
							else if($val >=10.4){
								echo "1";
							}
						}
						else{ //Perempuan
							if($val <= 7.7)
							{
								echo "5";
							}
							else if ($val >=7.8 && $val <=8.7)
							{
								echo "4";
							}
							else if($val >=8.8 && $val <=9.9){
								echo "3";
							}
							else if($val >=10 && $val <=11.9){
								echo "2";
							}
							else if($val >=12){
								echo "1";
							}
						}

					}
					if($usia>=17 && $usia<=19)
					{
						if($jenis_kelamin=='Laki-laki'){
							if($val <= 7.2)
							{
								echo "5";
							}
							else if ($val >=7.3 && $val <=8.3)
							{
								echo "4";
							}
							else if($val >=8.4 && $val <=9.6){
								echo "3";
							}
							else if($val >=9.7 && $val <=11){
								echo "2";
							}
							else if($val >=11.1){
								echo "1";
							}
						}
						else{ //Perempuan
							if($val <= 8.4)
							{
								echo "5";
							}
							else if ($val >=7.8 && $val <=9.8)
							{
								echo "4";
							}
							else if($val >=9.9 && $val <=11.4){
								echo "3";
							}
							else if($val >=11.5 && $val <=13.4){
								echo "2";
							}
							else if($val >=13.5){
								echo "1";
							}
						}

					}
				break;

			case 'situp':
				if($usia>=6 && $usia<=9){
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 17)
						{
							echo "5";
						}
						else if ($val >= 13 && $val <=16)
						{
							echo "4";
						}
						else if($val >=7 && $val <=12){
							echo "3";
						}
						else if($val >=2 && $val <=6){
							echo "2";
						}
						else if($val <=1){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 15)
						{
							echo "5";
						}
						else if ($val >= 11 && $val <=14)
						{
							echo "4";
						}
						else if($val >=4 && $val <=10){
							echo "3";
						}
						else if($val >=2 && $val <=3){
							echo "2";
						}
						else if($val <=1){
							echo "1";
						}
					}
				}

				if($usia>=10 && $usia<=12)
				{
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 23)
						{
							echo "5";
						}
						else if ($val >= 18 && $val <=22)
						{
							echo "4";
						}
						else if($val >=12 && $val <=17){
							echo "3";
						}
						else if($val >=4 && $val <=11){
							echo "2";
						}
						else if($val <=3){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 20)
						{
							echo "5";
						}
						else if ($val >= 14 && $val <=19)
						{
							echo "4";
						}
						else if($val >=7 && $val <=13){
							echo "3";
						}
						else if($val >=2 && $val <=6){
							echo "2";
						}
						else if($val <=1){
							echo "1";
						}
					}
				}

				if($usia>=13 && $usia<=15)
				{
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 38)
						{
							echo "5";
						}
						else if ($val >= 28 && $val <=37)
						{
							echo "4";
						}
						else if($val >=19 && $val <=27){
							echo "3";
						}
						else if($val >=8 && $val <=18){
							echo "2";
						}
						else if($val <=7){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 28)
						{
							echo "5";
						}
						else if ($val >= 19 && $val <=27)
						{
							echo "4";
						}
						else if($val >=9 && $val <=18){
							echo "3";
						}
						else if($val >=3 && $val <=8){
							echo "2";
						}
						else if($val <=2){
							echo "1";
						}
					}
				}

				if($usia>=16 && $usia<=19)
				{
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 41)
						{
							echo "5";
						}
						else if ($val >= 30 && $val <=40)
						{
							echo "4";
						}
						else if($val >=21 && $val <=29){
							echo "3";
						}
						else if($val >=10 && $val <=20){
							echo "2";
						}
						else if($val <=9){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 29)
						{
							echo "5";
						}
						else if ($val >= 20 && $val <=28)
						{
							echo "4";
						}
						else if($val >=10 && $val <=19){
							echo "3";
						}
						else if($val >=3 && $val <=9){
							echo "2";
						}
						else if($val <=2){
							echo "1";
						}
					}
				}
				break;

			case 'agi':
				if($jenis_kelamin=="Laki-laki"){
					if($val>=17.2) echo "1";
					else if($val>=17.6) echo "2";
					else if($val>=16.1) echo "3";
					else if($val>=15.6) echo "4";
					else echo "5";
				}
				else{
					if($val>=19) echo "1";
					else if($val>=18.3) echo "2";
					else if($val>=17.5) echo "3";
					else if($val>=16.8) echo "4";
					else echo "5";
				}
			break;
			case 'vjump':
				if($usia>=6 && $usia<=9){
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 38)
						{
							echo "5";
						}
						else if ($val >= 30 && $val <=37)
						{
							echo "4";
						}
						else if($val >=22 && $val <=29){
							echo "3";
						}
						else if($val >=13 && $val <=21){
							echo "2";
						}
						else if($val <=12){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 38)
						{
							echo "5";
						}
						else if ($val >= 30 && $val <=37)
						{
							echo "4";
						}
						else if($val >=22 && $val <=29){
							echo "3";
						}
						else if($val >=13 && $val <=21){
							echo "2";
						}
						else if($val <=12){
							echo "1";
						}
					}
				}

				if($usia>=10 && $usia<=12)
				{
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 46)
						{
							echo "5";
						}
						else if ($val >= 38 && $val <=45)
						{
							echo "4";
						}
						else if($val >=31 && $val <=37){
							echo "3";
						}
						else if($val >=24 && $val <=30){
							echo "2";
						}
						else if($val <=23){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 42)
						{
							echo "5";
						}
						else if ($val >= 34 && $val <=41)
						{
							echo "4";
						}
						else if($val >=28 && $val <=33){
							echo "3";
						}
						else if($val >=21 && $val <=27){
							echo "2";
						}
						else if($val <=20){
							echo "1";
						}
					}
				}

				if($usia>=13 && $usia<=15)
				{
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 66)
						{
							echo "5";
						}
						else if ($val >= 53 && $val <=65)
						{
							echo "4";
						}
						else if($val >=42 && $val <=52){
							echo "3";
						}
						else if($val >=31 && $val <=41){
							echo "2";
						}
						else if($val <=30){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 50)
						{
							echo "5";
						}
						else if ($val >= 39 && $val <=49)
						{
							echo "4";
						}
						else if($val >=30 && $val <=38){
							echo "3";
						}
						else if($val >=21 && $val <=29){
							echo "2";
						}
						else if($val <=20){
							echo "1";
						}
					}
				}

				if($usia>=16 && $usia<=19)
				{
					if($jenis_kelamin=='Laki-laki'){
						if($val >= 73)
						{
							echo "5";
						}
						else if ($val >= 60 && $val <=72)
						{
							echo "4";
						}
						else if($val >=50 && $val <=59){
							echo "3";
						}
						else if($val >=39 && $val <=49){
							echo "2";
						}
						else if($val <=38){
							echo "1";
						}
					}
					else{ //Perempuan
						if($val >= 50)
						{
							echo "5";
						}
						else if ($val >= 39 && $val <=49)
						{
							echo "4";
						}
						else if($val >=31 && $val <=38){
							echo "3";
						}
						else if($val >=23 && $val <=30){
							echo "2";
						}
						else if($val <=22){
							echo "1";
						}
					}
				}
				break;

			case 'flex':
					if($usia=='5'):
						if($jenis_kelamin=='Laki-laki'){
							if($val>=32) echo "5";
							else if($val>=29) echo "4";
							else if($val>=25) echo "3";
							else if($val>=22) echo "2";
							else if($val<22) echo "1";
						}else{ //Perempuan
							if($val>=34) echo "5";
							else if($val>=30) echo "4";
							else if($val>=27) echo "3";
							else if($val>=23) echo "2";
							else if($val<23) echo "1";
						}
					endif;
					if($usia=='6'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=34) echo "5";
							else if($val>=29) echo "4";
							else if($val>=26) echo "3";
							else if($val>=22) echo "2";
							else if($val<22) echo "1";
						}else{ //Perempuan
									 if($val>=34) echo "5";
							else if($val>=30) echo "4";
							else if($val>=27) echo "3";
							else if($val>=23) echo "2";
							else if($val<23) echo "1";
						}
					endif;
					if($usia=='7'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=33) echo "5";
							else if($val>=28) echo "4";
							else if($val>=25) echo "3";
							else if($val>=22) echo "2";
							else if($val<22) echo "1";
						}else{ //Perempuan
									 if($val>=34) echo "5";
							else if($val>=31) echo "4";
							else if($val>=27) echo "3";
							else if($val>=24) echo "2";
							else if($val<24) echo "1";
						}
					endif;
					if($usia=='8'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=34) echo "5";
							else if($val>=29) echo "4";
							else if($val>=25) echo "3";
							else if($val>=22) echo "2";
							else if($val<22) echo "1";
						}else{ //Perempuan
									 if($val>=36) echo "5";
							else if($val>=31) echo "4";
							else if($val>=28) echo "3";
							else if($val>=23) echo "2";
							else if($val<23) echo "1";
						}
					endif;
					if($usia=='9'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=34) echo "5";
							else if($val>=29) echo "4";
							else if($val>=25) echo "3";
							else if($val>=22) echo "2";
							else if($val<22) echo "1";
						}else{ //Perempuan
									 if($val>=35) echo "5";
							else if($val>=31) echo "4";
							else if($val>=28) echo "3";
							else if($val>=23) echo "2";
							else if($val<23) echo "1";
						}
					endif;
					if($usia=='10'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=33) echo "5";
							else if($val>=28) echo "4";
							else if($val>=25) echo "3";
							else if($val>=27) echo "2";
							else if($val<27) echo "1";
						}else{ //Perempuan
									 if($val>=35) echo "5";
							else if($val>=31) echo "4";
							else if($val>=28) echo "3";
							else if($val>=24) echo "2";
							else if($val<24) echo "1";
						}
					endif;
					if($usia=='11'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=34) echo "5";
							else if($val>=29) echo "4";
							else if($val>=25) echo "3";
							else if($val>=20) echo "2";
							else if($val<20) echo "1";
						}else{ //Perempuan
									 if($val>=37) echo "5";
							else if($val>=32) echo "4";
							else if($val>=29) echo "3";
							else if($val>=24) echo "2";
							else if($val<24) echo "1";
						}
					endif;
					if($usia=='12'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=35) echo "5";
							else if($val>=29) echo "4";
							else if($val>=26) echo "3";
							else if($val>=21) echo "2";
							else if($val<21) echo "1";
						}else{ //Perempuan
									 if($val>=40) echo "5";
							else if($val>=34) echo "4";
							else if($val>=30) echo "3";
							else if($val>=25) echo "2";
							else if($val<25) echo "1";
						}
					endif;
					if($usia=='13'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=36) echo "5";
							else if($val>=30) echo "4";
							else if($val>=26) echo "3";
							else if($val>=20) echo "2";
							else if($val<20) echo "1";
						}else{ //Perempuan
									 if($val>=43) echo "5";
							else if($val>=36) echo "4";
							else if($val>=31) echo "3";
							else if($val>=24) echo "2";
							else if($val<24) echo "1";
						}
					endif;
					if($usia=='14'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=39) echo "5";
							else if($val>=33) echo "4";
							else if($val>=28) echo "3";
							else if($val>=23) echo "2";
							else if($val23) echo "1";
						}else{ //Perempuan
									 if($val>=44) echo "5";
							else if($val>=38) echo "4";
							else if($val>=33) echo "3";
							else if($val>=28) echo "2";
							else if($val<28) echo "1";
						}
					endif;
					if($usia=='15'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=41) echo "5";
							else if($val>=34) echo "4";
							else if($val>=30) echo "3";
							else if($val>=24) echo "2";
							else if($val<24) echo "1";
						}else{ //Perempuan
									 if($val>=46) echo "5";
							else if($val>=41) echo "4";
							else if($val>=36) echo "3";
							else if($val>=31) echo "2";
							else if($val<31) echo "1";
						}
					endif;
					if($usia=='16'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=42) echo "5";
							else if($val>=36) echo "4";
							else if($val>=30) echo "3";
							else if($val>=25) echo "2";
							else if($val<25) echo "1";
						}else{ //Perempuan
									 if($val>=46) echo "5";
							else if($val>=39) echo "4";
							else if($val>=34) echo "3";
							else if($val>=30) echo "2";
							else if($val<30) echo "1";
						}
					endif;
					if($usia>='17'):
						if($jenis_kelamin=='Laki-laki'){
							     if($val>=45) echo "5";
							else if($val>=40) echo "4";
							else if($val>=34) echo "3";
							else if($val>=28) echo "2";
							else if($val<28) echo "1";
						}else{ //Perempuan
									 if($val>=44) echo "5";
							else if($val>=40) echo "4";
							else if($val>=35) echo "3";
							else if($val>=31) echo "2";
							else if($val<31) echo "1";
						}
					endif;
				break;
				case 'balance':
					if($jenis_kelamin=="Laki-laki"){
							if($val>50) echo "5";
						else if ($val>=41) echo "4";
						else if ($val>=31) echo "3";
						else if ($val>=20) echo "2";
						else if ($val<20) echo "1";
					}
					else{
							if($val>30) echo "5";
						else if ($val>=23) echo "4";
						else if ($val>=16) echo "3";
						else if ($val>=10) echo "2";
						else if ($val<10) echo "1";
						
					}
				break;
			default:
				// code...
				break;
		}
	}
	if($act=='getDetail')
	{
		extract($_POST);
		$res = $conn->query("SELECT m.nama_lengkap, m.id_ytc, IFNULL(m.path_foto,'ajax/foto_member/pp.png') as path_foto, u.nama_unit
												FROM ytds_member m left join ytds_unit u ON m.id_sekolah = u.id
												WHERE id_rfid='$id_member' OR id_ytc ='$id_member'");
		if($res->num_rows < 1)
		{
			$r = array("resp"=>"NoData");
			echo json_encode($r);
			return;
		}
		else { //Ada datanya
			//get ID YTC Dari Query
			$r = array();
			$x = $res->fetch_assoc();
			$id_yetece = $x['id_ytc'];
			$r[0]['id_ytc']=$x['id_ytc'];
			$r[0]['nama_lengkap']=$x['nama_lengkap'];
			$r[0]['nama_unit']=$x['nama_unit'];
			$r[0]['path_foto']=$x['path_foto'];
		//Taro detail ke array
		// echo "id_yetece=".$id_yetece.";
		 	if($tipe_absensi == '1'){ //absen masuk
		 	//Cek udah absen masuk hari ini apa belom.
			$cek = $conn->query("SELECT * FROM ytds_absensi WHERE id_member='$id_yetece' AND tanggal=date(now()) ");
			if($cek->num_rows > 0){
			//Kalo udah absen masuk hari ini.
				$r[0]['resp']='SudahAbsen';
				echo json_encode($r);
				return;
				}
				else{ //kalo belom
					//INSERT TO Absensi Masuk
					$creator=$_SESSION['nama_lengkap'];
					$insert = $conn->query("INSERT INTO ytds_absensi(id_member, waktu_masuk,tanggal, diabsen_oleh)
															VALUES('$id_yetece',TIME(CONVERT_TZ(NOW(),'+0:00','+11:00')),date(NOW()),'$creator')");
					if($insert){
						$r[0]['resp']='SuksesMasuk';
						echo json_encode($r);
						return;
					}
				}
			}
			else { //absen pulang
			//Cek udah absen masuk hari ini apa belom.
				$cek = $conn->query("SELECT * FROM ytds_absensi WHERE id_member='$id_yetece' AND tanggal=date(now()) ");
				if($cek->num_rows < 1){
					//Kalo belom absen masuk hari ini.
					$r[0]['resp']= "GagalPulang";
					echo json_encode($r);
					return;
				}
				else{ //kalo udah,
					//get id absen masuknya
					$fa = $cek->fetch_assoc();
					$id = $fa['id'];

					//UPDATE absennya hari ini
					$update = $conn->query("UPDATE ytds_absensi SET waktu_keluar = TIME(CONVERT_TZ(NOW(),'+0:00','+11:00'))
		 															WHERE id='$id'");
					if($update){
						$r[0]['resp']= "SuksesKeluar";
		 				echo json_encode($r);
					}
				}  
			}
		}
	}
	if($act=='getAbsen'){
		extract($_GET);
		//get absen by unit
		$nmbln = array("Januari","Februari","Maret","April","Mei","Juni","July","Agustus","September","Oktober","November","Desember");
		$tgl = array();
		//get semua tanggal latihan si unit di suatu bulan 
		$getTgl = $conn->query(" 
			SELECT DISTINCT DAY(tanggal) 'tgl'
			FROM ytds_absensi a
			LEFT JOIN ytds_member m
			ON m.id_ytc = a.id_member
			LEFT JOIN ytds_unit u 
			ON u.id = m.id_sekolah
			WHERE MONTH(tanggal) = '$bulan'
			AND YEAR(tanggal) = '$tahun'
			AND u.id = '$id_unit'
			AND m.id_tipe_anggota = '$id_tipe_anggota'
		"); 
		while($r = $getTgl->fetch_assoc()){
			$tgl[] = $r['tgl'];
		}
		
		//get nm unit 
		$getUnitName = $conn->query("SELECT nama_unit FROM ytds_unit WHERE id='$id_unit'")->fetch_assoc();
		$namaUnit = $getUnitName['nama_unit'];
		
		//get semua murid di unit tsb
		$getUsr = $conn->query("
			SELECT m.* , ta.tipe_anggota, u.nama_unit
			FROM ytds_member m
			LEFT JOIN ytds_unit u
			on u.id = m.id_sekolah
			LEFT JOIN ytds_tipe_anggota ta
			on ta.id = m.id_tipe_anggota
			WHERE u.id = '$id_unit'
			AND m.id_tipe_anggota = '$id_tipe_anggota'
		");
		
		//numbering
		$i = 1;
		
		// if no data
		if($getTgl->num_rows < 1){
			die("Tidak Ada Data");
		}
		
		echo "
			<h5> Rekap Absensi Bulan ".$nmbln[$bulan-1]." $tahun | Unit $namaUnit</h5><hr>
			<table id='lab_tbl_result' class='table responsive'>
			<thead>
			<tr>
				<th> No </th>
				<th> Unit </th>
				<th> ID </th>
				<th> Nama Anggota </th>
				<th> Tipe Keanggotaan </th>
		";
		foreach($tgl as $val){
			echo "<th> $val-".substr($nmbln[$bulan-1],0,3)."</th>";
		}
		echo "
				<th>Masuk</th>
				<th>Alpha</th>
			</tr>
			</thead>
			<tbody>
		";
		$cM=0;$cA=0;
		while($res = $getUsr->fetch_assoc()){
			//tiap user ini 
			echo "<tr>";
			echo "<td>".$i."</td>";$i++;
			echo "<td>".$res['nama_unit']."</td>";
			echo "<td>".$res['id_ytc']."</td>";
			echo "<td>".$res['nama_lengkap']."</td>";
			echo "<td>".$res['tipe_anggota']."</td>";
			
			for($n=0;$n<sizeOf($tgl);$n++){
				$isAbsen = $conn->query("
					SELECT a.*
					FROM ytds_absensi a
					LEFT JOIN ytds_member m
					ON m.id_ytc = a.id_member
					WHERE MONTH(tanggal) = '$bulan'
					AND YEAR(tanggal) = '$tahun'
					AND DAY(tanggal) = '".$tgl[$n]."'
					AND id_ytc = '".$res['id_ytc']."'");
				echo "<td>";
				if($isAbsen->num_rows<1){
					$cA++;
					echo "-";
				}else{
					$cM++;
					echo "1";
				}
				echo "</td>";
			}
			echo "<td> $cM </td>";
			echo "<td> $cA </td>";
			$cM = 0; $cA = 0;
			echo "</tr>";
		}
		echo "
			</tbody>
			</table>
		";
	}
	
	if($act=="getDataPrestasiSiswa"){
		$query = $conn->query("
			SELECT pa.* , e.kategori, e.golongan,e.id_tipe_event
			FROM ytds_prestasi_anggota pa
			LEFT JOIN ytds_point_event e
			on e.id = pa.id_event
			WHERE id_member = '$id'
		");
		$i = 1;$tot = 0;
		while($r = $query->fetch_assoc()){
			echo "<tr>";
			echo "<td>".$i."</td>";$i++;
			echo "<td>".$r['id_tipe_event']."</td>";
			echo "<td>".$r['kategori']."</td>";
			echo "<td>".$r['event_name']."</td>";
			if($r['hasil']=='3')
				echo "<td>".'Juara 1</td>';
			else if($r['hasil']=='2')
				echo "<td>".'Juara 2</td>';
			else echo "<td>".'Juara 3</td>';
			echo "<td>".$r['point']."</td>"; $tot += $r['point'];
			echo "<td> 
				<button class='btn btn-info btn-small' onclick='ubahPrestasi(".$r['id'].")'> Ubah </button>
				<button class='btn btn-danger btn-small' onclick='hapusPrestasi(".$r['id'].")'> Hapus </button>
			</td>";
			echo "</tr>";
		}
		echo "
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><b>Total Point</b></td>
				<td>$tot</td>
				<td></td>
			</tr>
		";
	}
	if($act=='get_prestasiDetail'){
		$q = $conn->query("SELECT * FROM ytds_prestasi_anggota where id='$id'");
		$res = array();
		while($r = $q->fetch_assoc()){
			$res[] = $r;
		}
		echo json_encode($res);
	}
	
	if($act=='get_laporan_anggota'){
		$wq = '';
		switch($filter_umur){
			case 'lbs' :
				$wq = "AND FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) >= $usia";
				break;
			case 'lb':
				$wq = "AND FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) > $usia";
				break;
			case 'kds':
				$wq = "AND FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) <= $usia";
				break;
			case 'kd':
				$wq = "AND FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) < $usia";
				break;
			case 'sd':
				$wq = "AND FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) = $usia";
				break;
			default:
				$wq = "";
				break;
		}
		switch($filter_tb){
			case 'lbs' :
				$tb = "AND member.tinggi_badan >= $tinggi_badan";
				break;
			case 'lb':
				$tb = "AND member.tinggi_badan > $tinggi_badan";
				break;
			case 'kds':
				$tb = "AND member.tinggi_badan <= $tinggi_badan";
				break;
			case 'kd':
				$tb = "AND member.tinggi_badan < $tinggi_badan";
				break;
			case 'sd':
				$tb = "AND member.tinggi_badan = $tinggi_badan";
				break;
			default:
				$tb = "";
				break;
		}
		switch($filter_bb){
			case 'lbs' :
				$bb = "AND member.berat_badan >= $berat_badan";
				break;
			case 'lb':
				$bb = "AND member.berat_badan > $berat_badan";
				break;
			case 'kds':
				$bb = "AND member.berat_badan <= $berat_badan";
				break;
			case 'kd':
				$bb = "AND member.berat_badan < $berat_badan";
				break;
			case 'sd':
				$bb = "AND member.berat_badan = $berat_badan";
				break;
			default:
				$bb = "";
				break;
		}
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
			
			WHERE member.`id_sekolah` LIKE '$nama_unit'
			AND member.id_geup LIKE '$id_geup'
			AND member.`id_tipe_anggota` LIKE '$id_tipe_anggota'
			AND member.`gender` LIKE '$gender'
			$wq 
			$tb 
			$bb 
			");
		echo "	SELECT member.*,DATE_FORMAT(member.tanggal_lahir,'%d %M %Y') AS tgl_lhr,
			DATE_FORMAT(member.tanggal_gabung,'%d-%M-%Y') AS tgl_gbg,
			FLOOR(DATEDIFF(DATE(NOW()),member.`tanggal_lahir`)/365) AS usia, geup.geup, agt.tipe_anggota, unit.nama_unit
			FROM ytds_member member
			LEFT JOIN ytds_geup geup
				ON geup.id = member.id_geup
			LEFT JOIN ytds_tipe_anggota agt
				ON agt.id = member.id_tipe_anggota
			LEFT JOIN ytds_unit unit
				ON unit.id = member.id_sekolah
			
			WHERE member.`id_sekolah` LIKE '$nama_unit'
			AND member.id_geup LIKE '$id_geup'
			AND member.`id_tipe_anggota` LIKE '$id_tipe_anggota'
			AND member.`gender` LIKE '$gender'
			$wq";
		$no=1;
		while($res = $pop->fetch_assoc()){
			echo '<tr class="gradeX">';
			echo "<td>$no</td>";$no++;
			echo "<td>".$res['id_ytc']."</td>";
			echo "<td>".$res['nama_lengkap']."</td>";
			echo "<td>".$res['gender']."</td>";
			echo "<td>".$res['nama_unit']."</td>";
			echo "<td>".$res['geup']."</td>";
			echo "<td>".$res['usia']."</td>";
			echo "<td>".$res['tinggi_badan']."</td>";
			echo "<td>".$res['berat_badan']."</td>";
			echo "<td>".$res['tempat_lahir'].', '.$res['tgl_lhr']."</td>";
			echo "</tr>";
		}
	}
?>
