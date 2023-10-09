<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
header('location:index.php');
}
else{
if(isset($_GET['email'])){
	$id	= $_GET['email'];
	$password = "password";
	$pass = md5($password);
	$mySql	= "DELETE FROM users WHERE email='$id'";
	$myQry	= mysqli_query($koneksidb, $mySql);
	echo "<script type='text/javascript'>
			alert('Berhasil hapus akun.'); 
			document.location = 'reg-users.php'; 
		</script>";
}else {
	echo "<script type='text/javascript'>
			alert('Terjadi kesalahan, silahkan coba lagi!.'); 
			document.location = 'reg-users.php'; 
		</script>";
}
}
?>