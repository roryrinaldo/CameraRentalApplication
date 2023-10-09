<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/format_rupiah.php');

if(strlen($_SESSION['ulogin'])==0){ 
	header('location:index.php');
}else{

  
if(isset($_POST['submit'])){
	
	$vid		= $_POST['vid'];
	$email		= $_POST['email'];
    $tgl		= date('Y-m-d');
    $harga      = $_POST['harga'];
	$status 	= "Menunggu Konfirmasi";

	$cek		= 0;
    
	//insert
	$sql 	= "INSERT INTO penjualan (id_kamera,email,tanggal_pesan,harga,status)
				VALUES('$vid','$email','$tgl','$harga','$status')";
	$query 	= mysqli_query($koneksidb,$sql);
	if($query){
		
		echo " <script> alert ('Kamera berhasil dipesan.'); </script> ";
		echo "<script type='text/javascript'> document.location = 'riwayatsewa.php'; </script>";
	}else{
		if (!$query) {
			die("Query Error: " . mysqli_error($koneksidb));
		}
		echo " <script> alert ('Ooops, terjadi kesalahan. Silahkan coba lagi.'); </script> ";
	}
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Gudang Kamera Pekanbaru</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  
</head>
<body>

	<!-- Start Switcher -->
	<?php include('includes/colorswitcher.php');?>
	<!-- /Switcher -->  
			
	<!--Header-->
	<?php include('includes/header.php');?>
	<!--Page Header-->
	<!-- /Header --> 

	<?php
		$email=$_SESSION['ulogin']; 
		$vid=$_GET['vid'];
		$mulai=$_GET['mulai'];
		$selesai=$_GET['selesai'];


		$start = new DateTime($mulai);
		$finish = new DateTime($selesai);
		$int = $start->diff($finish);
		$dur = $int->days;
		$durasi = $dur+1;


		$sql1 	= "SELECT kamera.*,merek.* FROM kamera,merek WHERE merek.id_merek=kamera.id_merek and kamera.id_kamera='$vid'";
		$query1 = mysqli_query($koneksidb,$sql1);
		$result = mysqli_fetch_array($query1);
		$harga	= $result['harga_sewa'];
		$totalmobil = $durasi*$harga;
		$totalsewa = $totalmobil;
	?>	
	

    
	<section class="user_profile inner_pages">
		<div class="container">
            <h3><center>Form Pemesanan</center></h3><br>
		    <div class="col-md-3 center">
				<div class="">
                    <img src="admin/img/vehicleimages/<?php echo htmlentities($result['image1']);?>" class="img-responsive" alt="Image" /></a>
                </div>
					
			</div>
		
			<div class="user_profile_info">	
				<div class="col-md-12 col-sm-10">
					<form method="post" name="penjualan" onSubmit="return valid();"> 
						<input type="hidden" class="form-control" name="vid"  value="<?php echo $vid;?>"required>
						<input type="hidden" class="form-control" name="email"  value="<?php echo $email;?>"required>
						<div class="form-group">
							<label>Nama Kamera</label>
							<input type="text" class="form-control" name="nama_kamera"  value=" <?php echo htmlentities($result['nama_kamera']);?>"readonly>
						</div>
                        
						<div class="form-group">
							<label>Tanggal Beli</label>
							<input type="date" class="form-control" name="tanggal_beli"  value="<?php echo date('Y-m-d'); ?>" readonly>
						</div>
						
						<div class="form-group">
							<label>Harga Kamera</label><br/>
							<input type="text" class="form-control" name="harga" value="<?php echo htmlentities($result['harga_jual']);?>"readonly>
						</div>
						<br/>			
						<div class="form-group">
							<input type="submit" name="submit" value="Beli" class="btn btn-block">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>