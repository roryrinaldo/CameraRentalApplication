
  <header>
    <div class="default-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 col-md-2">
            <div class="logo"> <a href="index.php"><h5>Gudang Kamera Pekanbaru</h5></a> </div>
          </div>
          <div class="col-sm-9 col-md-10">
            <div class="header_info">
              <div class="header_widgets">
                <div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                <p class="uppercase_text">Email: </p>
                <a href="mailto:info@example.com">gudangkamerapku@gmail.com</a> </div>
              <div class="header_widgets">
                <div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                <p class="uppercase_text">Kontak Kami: </p>
                <a href="tel:61-1234-5678-09">0812 76741079</a> </div>
              <div class="social-follow">
                <!-- <ul>
                  <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                  <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul> -->
              </div>
    <?php   if(strlen($_SESSION['ulogin'])==0)
    {	
    ?>
  <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
    <?php }
    else{ 
      echo "Welcome!";
    } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Navigation -->
    <nav id="navigation_bar" class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        
        <div class="header_wrap">
          
          <div class="user_login ">
            <ul>
            
              <li class="dropdown"> 
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user-circle" aria-hidden="true"></i> 
                    <?php 
                    $email=$_SESSION['ulogin'];
                    $sql ="SELECT nama_user FROM users WHERE email='$email'";
                    $query = mysqli_query($koneksidb,$sql);
                    if(mysqli_num_rows($query)>0)
                    {
                    while($results = mysqli_fetch_array($query))
                    {
                    echo htmlentities($results['nama_user']); }}?>
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-menu">
                <?php if($_SESSION['ulogin']){?>
                  <li><a href="profile.php">Profile Settings</a></li>
                  <li><a href="update-password.php">Update Password</a></li>
                  <li><a href="riwayatsewa.php">Riwayat Transaksi</a></li>
                  <li><a href="logout.php">Sign Out</a></li>
                  <?php } else { ?>
                  <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
                    <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
                  <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Riwayat Sewa</a></li>
                  <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li>
                  <?php } ?>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="collapse navbar-collapse" id="navigation">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>        	 
            <li><a href="page.php?type=aboutus">Tentang Gudang Kamera</a></li>
            <li><a href="car-listing.php">Daftar Kamera</a>
            <li><a href="page.php?type=faqs">FAQs</a></li>
            <li><a href="contact-us.php">Hubungi Kami</a></li>
            <?php
            if(isset($_SESSION['ulogin'])){ ?>
                <li class="dropdown"> 
                    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell" aria-hidden="true"></i> Notifikasi <span class="badge badge-danger"></span>
                    </a>
                    <ul class="dropdown-menu notification-dropdown">
                        <?php
                        $email = $_SESSION['ulogin'];

                        // Query untuk mengambil data reminder
                        $query = "SELECT r.*, k.nama_kamera
                        FROM reminder r
                        JOIN booking b ON r.kode_booking = b.kode_booking
                        JOIN kamera k ON b.id_kamera = k.id_kamera
                        ORDER BY r.tanggal_pengingat DESC";
                        
                        $result = mysqli_query($koneksidb, $query);

                        // Loop melalui hasil query untuk menampilkan notifikasi
                        while ($row = mysqli_fetch_assoc($result)) {
                            $pesan = "Kamera " . $row['nama_kamera'] . " telah dikembalikan oleh penyewa sebelumnya.";
                            
                            // Tampilkan notifikasi dengan format yang Anda inginkan
                            echo '<li><a href="#"><span class="notification-icon"><i class="fa fa-info-circle"></i></span>';
                            echo '<span class="notification-content">' . $pesan . '</span></a></li>';
                        }

                        // Query untuk mengambil data notifikasi dari tabel booking
                        $queryBooking = "SELECT kode_booking, status FROM booking WHERE email='$email' ORDER BY tgl_booking DESC";
                        $resultBooking = mysqli_query($koneksidb, $queryBooking);

                        // Query untuk mengambil data notifikasi dari tabel penjualan
                        $queryPenjualan = "SELECT id_penjualan, status FROM penjualan WHERE email='$email' ORDER BY tanggal_pesan DESC";
                        $resultPenjualan = mysqli_query($koneksidb, $queryPenjualan);

                        // Menggabungkan hasil query booking dan penjualan
                        $notifications = array_merge(mysqli_fetch_all($resultBooking, MYSQLI_ASSOC), mysqli_fetch_all($resultPenjualan, MYSQLI_ASSOC));

                        if (count($notifications) > 0) {
                            foreach ($notifications as $notification) {
                                if (isset($notification['kode_booking'])) {
                                    $pesan = "Status sewa dengan kode " . $notification['kode_booking'] . " telah berubah menjadi '" . $notification['status'] . "'.";
                                } elseif (isset($notification['id_penjualan'])) {
                                    $pesan = "Status pembelian kamera dengan kode " . $notification['id_penjualan'] . " telah berubah menjadi '" . $notification['status'] . "'.";
                                }
                        ?>
                                <li>
                                    <a href="#">
                                        <span class="notification-icon"><i class="fa fa-info-circle"></i></span>
                                        <span class="notification-content"><?php echo $pesan; ?></span>
                                    </a>
                                </li>
                        <?php
                            }
                        } else {
                        ?>
                            <li>
                                <a href="#">
                                    <span class="notification-content">Tidak ada notifikasi baru</span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navigation end --> 
    
  </header>