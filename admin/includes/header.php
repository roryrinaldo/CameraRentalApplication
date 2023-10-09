<div class="brand clearfix">
	<a href="dashboard.php" style="font-size: 20px;color:white;">
		<img src="img/GKP.png" alt="Logo Perusahaan" style="vertical-align: middle; height: 60px"> Gudang Kamera
	</a>
	<span class="menu-btn"><i class="fa fa-bars"></i></span>
	<ul class="ts-profile-nav">
		
	

		<li class="ts-account">
			<a href="#">Administrator <i class="fa fa-angle-down hidden-side"></i></a>
			<ul>
				<li><a href="change-password.php">Ubah Password</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</li>

		<li class="ts-account"> 
			<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-bell" aria-hidden="true"></i> Notifikasi <span class="badge badge-danger"></span>
			</a>
			<ul class="">
			<?php
				if (isset($_SESSION['ulogin'])) {
					// Query untuk mengambil data sewa baru
					$sqlSewa = "SELECT * FROM booking WHERE status='Menunggu Pembayaran' ORDER BY tgl_booking DESC";
					$querySewa = mysqli_query($koneksidb, $sqlSewa);

					// Query untuk mengambil data penjualan baru
					$sqlPenjualan = "SELECT * FROM penjualan WHERE status!='Menunggu Konfirmasi' ORDER BY tanggal_pesan DESC";
					$queryPenjualan = mysqli_query($koneksidb, $sqlPenjualan);

					// Inisialisasi array untuk notifikasi
					$notifications = array();

					// Mengambil data dari hasil query sewa dan menambahkannya ke array
					while ($row = mysqli_fetch_assoc($querySewa)) {
						$row['type'] = 'sewa'; // Tambahkan tipe notifikasi
						$notifications[] = $row;
					}

					// Mengambil data dari hasil query penjualan dan menambahkannya ke array
					while ($row = mysqli_fetch_assoc($queryPenjualan)) {
						$row['type'] = 'penjualan'; // Tambahkan tipe notifikasi
						$notifications[] = $row;
					}

					if (count($notifications) > 0) {
						foreach ($notifications as $notification) {
							if ($notification['type'] == 'sewa') {
								$pesan = "Ada data sewa baru dengan kode booking " . $notification['kode_booking'] . " pada " . $notification['tgl_booking'];
							} elseif ($notification['type'] == 'penjualan') {
								$pesan = "Ada data penjualan baru dengan Kode Penjualan " . $notification['id_penjualan'] . " pada " . $notification['tanggal_pesan'];
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
				}
				?>
			</ul>
		</li>
	</ul>
</div>
