<!DOCTYPE html>
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $judul ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Faiz Maruf " />
	<link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/animate.css' ?>">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/icomoon.css' ?>">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/bootstrap.css' ?>">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/flexslider.css' ?>">
	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php echo base_url() . 'theme/css/style.css' ?>">

	<!-- Modernizr JS -->
	<script src="<?php echo base_url() . 'theme/js/modernizr-2.6.2.min.js' ?>"></script>

</head>

<body>


	<div id="fh5co-page">
		<?php $this->load->view('v_navbar'); ?>



		<aside id="fh5co-hero" clsas="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
					<li style="background-image: url(<?php echo base_url() . 'theme/images/slide_3.jpg' ?>);">
						<div class="overlay-gradient"></div>
						<div class="container">
							<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
								<div class="slider-text-inner">
									<h2>Who We Are</h2>
									<!-- <p class="fh5co-lead"> Awesome source code by <a href="#" target="_blank">Faiz Maruf </a></p> -->
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>

		<div class="fh5co-about animate-box">
			<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
				<h2>About Us</h2>
				<p>Keluarga Mahasiswa Lampung atau yang akrab disapa Kemala Unsri merupakan salah satu organisasi terbaik yang mewadahi mahasiswa Rantau dengan domisili Lampung. Berbeda dengan organisasi kedaerahan lain, di KEMALA UNSRI kita dapat temukan suku dengan masing-masing khas logat bahasanya. Disatukan dari berbagai daerah yang tersebar dari seluruh kabupaten/kota yang ada di Provinsi Lampung menjadi alasan untuk KEMALA dapat selalu kompak.</p>
			</div>
			<div class="container">
				<div class="col-md-6">
					<figure>
						<img src="<?php echo base_url() . 'theme/images/image_11.jpeg' ?>" alt="Free HTML5 Template" class="img-responsive">
					</figure>
				</div>
				<div class="col-md-6">
					<h3>Visi</h3>
					<ul>
						<li>Menjadikan Kemala Unsri sebagai wadah kolaborasi baik internal maupun eksternal guna mewujudkan organisasi kedaerahan yang progresif dan bernafaskan profesionalisme</li>

					</ul>
					<h3>Misi</h3>
					<ul>
						<li>Meningkatkan nuansa kekeluargaan baik horizontal maupun vertikal anggota Kemala Unsri</li>
						<li>Menginisiasi pengembangan bakat dan minat anggota Kemala Unsri</li>
						<li>Mengintensifkan kegiatan pengabdian dalam bentuk pendidikan sosial masyarakat</li>
						<li>Meningkatkan kaderisasi internal guna menumbuhkan potensi anggota Kemala Unsri</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="fh5co-team animate-box">
			<div class="container">

				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2>Badan Pengurus Harian</h2>
						<p>Kami memiliki tim yang solid. one team, one spirit, and one goal.</p>
					</div>

					<?php foreach ($data->result() as $row) :	?>
						<div class="col-md-4 fh5co-staff">
							<div class="avatar mx-auto">
								<img src="<?php echo base_url() . 'assets/images/bph/' . $row->bph_photo; ?>" class="img-responsive">
							</div>
							<div class="card" style="height: 250px;">
								<h3><?= $row->bph_nama; ?></h3>
								<h4><?= $row->bph_fakultas; ?> <?= $row->bph_angkatan; ?> - <?= $row->bph_jabatan; ?></h4>
								<p><?= $row->bph_nama; ?> menjabat sebagai <?= $row->bph_jabatan; ?> Kabinet Krakatau Biru</p>

								<ul class="fh5co-social">
									<li><a href=" <?= $row->bph_facebook; ?> "><i class="icon-facebook"></i></a></li>
									<li><a href="#"><i class="icon-twitter"></i></a></li>
									<li><a href=" <?= $row->bph_instagram; ?> "><i class="icon-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		</div>


		<div id="fh5co-why-us" class="animate-box">
			<div class="container">
				<div class="row">

					<div class="col-md-4 text-center item-block">
						<span class="icon"><img src="<?php echo base_url() . 'theme/images/anggota.svg' ?>" class="img-responsive"></span>
						<h3><?= $jumlahanggota; ?></h3>
						<!-- <p>Tingkatkan kinerja perusahaan dengan Software yang sesuai dengan Business Process anda.</p> -->
						<h2>
							Anggota
						</h2>
						<!-- <p><a href="<?php echo base_url() . 'portfolio' ?>" class="btn btn-primary btn-outline with-arrow">Learn more <i class="icon-arrow-right"></i></a></p> -->
					</div>
					<div class="col-md-4 text-center item-block">
						<span class="icon"><img src="<?php echo base_url() . 'theme/images/proker.svg' ?>" class="img-responsive"></span>
						<h3>> 25</h3>
						<!-- <p>Konsultasi kan kebutuhan IT anda pada kami dan ketahui layanan lain yang kami berikan.</p> -->
						<!-- <p><a href="<?php echo base_url() . 'portfolio' ?>" class="btn btn-primary btn-outline with-arrow">Learn more <i class="icon-arrow-right"></i></a></p> -->
						<h2>Program Kerja</h2>
					</div>
					<div class="col-md-4 text-center item-block">
						<span class="icon"><img src="<?php echo base_url() . 'theme/images/alumni.svg' ?>" class="img-responsive"></span>
						<h3>
							<!-- <?= $jumlahalumni; ?> -->> 100
						</h3>
						<!-- <p>Bangun identitas bisnis dan usaha anda di dunia Internet melalui Website.</p> -->

						<h2>
							Alumni
						</h2>
						<!-- <p><a href="<?php echo base_url() . 'portfolio' ?>" class="btn btn-primary btn-outline with-arrow">Learn more <i class="icon-arrow-right"></i></a></p> -->
					</div>
				</div>
			</div>
		</div>


		<?php $this->load->view('v_footer'); ?>
	</div>


	<!-- jQuery -->
	<script src="<?php echo base_url() . 'theme/js/jquery.min.js' ?>"></script>
	<!-- jQuery Easing -->
	<script src="<?php echo base_url() . 'theme/js/jquery.easing.1.3.js' ?>"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url() . 'theme/js/bootstrap.min.js' ?>"></script>
	<!-- Waypoints -->
	<script src="<?php echo base_url() . 'theme/js/jquery.waypoints.min.js' ?>"></script>
	<!-- Flexslider -->
	<script src="<?php echo base_url() . 'theme/js/jquery.flexslider-min.js' ?>"></script>

	<!-- MAIN JS -->
	<script src="<?php echo base_url() . 'theme/js/main.js' ?>"></script>


</body>

</html>