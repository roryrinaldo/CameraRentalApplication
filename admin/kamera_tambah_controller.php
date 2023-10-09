<?php
include('includes/config.php');
error_reporting(0);
$namakamera=$_POST['nama_kamera'];
$merek=$_POST['merek'];
$kategori=$_POST['kategori'];
$deskripsi=$_POST['deskripsi'];

$harga_jual=$_POST['harga_jual'];
$harga_sewa=$_POST['harga_sewa'];
$tipe=$_POST['tipe'];
$tahun=$_POST['tahun'];


$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
$vimage5=$_FILES["img5"]["name"];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

$sql 	= "INSERT INTO kamera (nama_kamera,id_merek,kategori,deskripsi,harga_jual,harga_sewa,tipe,tahun,image1,image2,image3,image4,image5)
			VALUES ('$namakamera','$merek','$kategori','$deskripsi','$harga_jual','$harga_sewa','$tipe','$tahun',
			'$vimage1','$vimage2','$vimage3','$vimage4','$vimage5')";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil tambah data.'); 
			document.location = 'kamera.php'; 
		</script>";
}else {
			echo "No Error : ".mysqli_errno($koneksidb);
			echo "<br/>";
			echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'kamera_tambah.php'; 
		</script>";
}

?>