<?php 
session_start();
include('includes/config.php');
include('includes/format_rupiah.php');
error_reporting(0);
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
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT kamera.*, merek.* from kamera, merek WHERE merek.id_merek=kamera.id_merek AND kamera.id_kamera='$vhid'";
$query = mysqli_query($koneksidb,$sql);
if(mysqli_num_rows($query)>0)
{
while($result = mysqli_fetch_array($query))
{ 
	$_SESSION['brndid']=$result['id_merek'];  
?>  

<section id="listing_img_slider">
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result['image1']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result['image2']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result['image3']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result['image4']);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
  <?php if($result['image5']=="")
	{

	} else {
  ?>
  <div><img src="admin/img/vehicleimages/<?php echo htmlentities($result['image5']);?>" class="img-responsive" alt="image" width="900" height="560"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result['nama_merek']);?>, <?php echo htmlentities($result['nama_kamera']);?></h2><h3 style="color:red;">(<?php echo htmlentities($result['kategori']);?>)</h3>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p><?php echo htmlentities(format_rupiah($result['harga_jual']));?> </p>
          <form method="get" action="penjualan.php">
			      <input type="hidden" class="form-control" name="vid" value=<?php echo $vhid;?> required>
			
            <?php 
              if ($_SESSION['ulogin']) {
                // Query untuk memeriksa status kamera yang dibooking
                $queryStatus = "SELECT status FROM booking WHERE id_kamera='$vhid' AND status!='Selesai'";
                $resultStatus = mysqli_query($koneksidb, $queryStatus);

                // Jika ada booking dengan status belum "Selesai", tampilkan alert
                if (mysqli_num_rows($resultStatus) > 0) {
                  echo '<div class="form-group" align="center">';
                  echo '<button class="btn" align="center" disabled>Kamera sedang disewakan</button>';
                  echo '</div>';
              
                } else {
                  echo '<div class="form-group" align="center">';
                  echo '<button class="btn" align="center">Beli Sekarang</button>';
                  echo '</div>';
                }
              } else {
                echo '<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login Untuk Membeli</a>';
              }
              ?>
          </form>
        </div>
      
          
       
   
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-calendar" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result['tahun']);?></h5>
              <p>Tahun Kamera</p>
            </li>
            <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result['tipe']);?></h5>
              <p>Tipe Kamera</p>
            </li>
       

          </ul>
        </div>
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Deskripisi Kamera</a></li>
          
             
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- vehicle-overview -->
              <div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                
                <p><?php echo htmlentities($result['deskripsi']);?></p>
              </div>
              
              
          
            </div>
          </div>
          
        </div>
<?php }} ?>
   
    </div>
    
      

      <?php 
        $vhid=intval($_GET['vhid']);
        $sql = "SELECT kamera.*, merek.* from kamera, merek WHERE merek.id_merek=kamera.id_merek AND kamera.id_kamera='$vhid'";
        $query = mysqli_query($koneksidb,$sql);

        while($result = mysqli_fetch_array($query))
        { 
          $_SESSION['brndid']=$result['id_merek'];  
         
        if($result['kategori']=="Bekas"){?>
      <!--Side-Bar-->
      <aside class="col-md-3">
        
        <div class="sidebar_widget">
          <div class="widget_heading">
            
            <p> Harga Sewa : <?php echo htmlentities(format_rupiah($result['harga_sewa']));?> /Hari</p>
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Sewa Sekarang</h5>
          </div>
          <form method="get" action="booking.php">
			      <input type="hidden" class="form-control" name="vid" value=<?php echo $vhid;?> required>
			
            <?php if($_SESSION['ulogin']){?>
            <div class="form-group" align="center">
              <button class="btn" align="center">Sewa Sekarang</button>
            </div>
            <?php } else { ?>
				      <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login Untuk Menyewa</a>
            <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    <?php }} ?>

    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Kamera Sejenis</h3>
      <div class="row">
      <?php 
      $bid=$_SESSION['brndid'];
      $sql1="SELECT kamera.*, merek.*from kamera, merek WHERE merek.id_merek=kamera.id_merek AND kamera.id_merek='$bid'";
      $query1 = mysqli_query($koneksidb,$sql1);
      if(mysqli_num_rows($query1)>0)
      {
      while($result = mysqli_fetch_array($query1))
      { 
      ?>      

        <div class="col-md-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> 
              <a href="vehical-details.php?vhid=<?php echo htmlentities($result['id_kamera']);?>">
                <img src="admin/img/vehicleimages/<?php echo htmlentities($result['image1']);?>" class="img-responsive" alt="image" style="max-height: 150px;"/>
              </a>
            </div>
            <div class="product-listing-content">
              
              <h5><a href="vehical-details.php?vhid=<?php echo htmlentities($result['id_kamera']);?>"><?php echo htmlentities($result['nama_merek']);?> , <?php echo htmlentities($result['nama_kamera']);?></a><a style="color:red;"> (<?php echo htmlentities($result['kategori']);?>)</a></h5>
              <p class="list-price"><?php echo htmlentities(format_rupiah($result['harga_jual']));?></p>
          
              <ul class="features_list">
                <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result['tahun']);?></li>
                <li><i class="fa fa-camera" aria-hidden="true"></i><?php echo htmlentities($result['tipe']);?></li>
              </ul>
            </div>
          </div>
        </div>
      <?php }} ?>       

      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>