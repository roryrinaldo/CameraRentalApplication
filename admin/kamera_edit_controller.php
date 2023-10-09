<?php
include('includes/config.php');
error_reporting(0);
$id=$_POST['id_kamera'];
$namakamera=$_POST['nama_kamera'];
$merek=$_POST['merek'];
$kategori=$_POST['kategori'];
$deskripsi=$_POST['deskripsi'];
$harga_jual=$_POST['harga_jual'];
$harga_sewa=$_POST['harga_sewa'];
$tipe=$_POST['tipe'];
$tahun=$_POST['tahun'];



$sql="UPDATE kamera SET nama_kamera='$namakamera',id_merek='$merek',kategori='$kategori',deskripsi='$deskripsi',harga_jual='$harga_jual',harga_sewa='$harga_sewa',tipe='$tipe',tahun='$tahun'
	 where id_kamera='$id'";
$query 	= mysqli_query($koneksidb,$sql);
if($query){
	echo "<script type='text/javascript'>
			alert('Berhasil perbaruhi data.'); 
			document.location = 'kamera.php'; 
		</script>";
}else {
	echo "No Error : ".mysqli_errno($koneksidb);
	echo "<br/>";
	echo "Pesan Error : ".mysqli_error($koneksidb);

	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'kamera_edit.php?id=$id'; 
		</script>";
}
?>