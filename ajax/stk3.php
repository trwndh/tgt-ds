<?php
//skrip generate tarikolot 03

include 'conn.php';
//$select = $conn->query("SELECT id, id_sekolah,id_tipe_anggota FROM ytds_member WHERE id = '$last_id'");
$tk = $conn->query("SELECT * FROM ytds_member WHERE id_sekolah = '36'");
//format YETECE – TAHUN – 2 Digit Kode Unit – 1 Digit Type Anggota – 4 Digit DB insert ID
while($ret=$tk->fetch_assoc()){
	$id_ytc = 'YETECE-2018366'.$ret['id'];
	$update_ytc_id = $conn->query("UPDATE ytds_member SET id_ytc = '$id_ytc' WHERE id='".$ret['id']."'");
	if($update_ytc_id)
		echo $ret['nama_lengkap']." YETECE ID was CREATED. The ID is ".$id_ytc."<br>";
	else echo $conn->error;
}