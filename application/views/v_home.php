<!DOCTYPE html>
<html class="no-js">

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
	<link rel="shortcut icon" href="<?php echo base_url() . 'theme/favicon.ico' ?>">
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
	<?php
	error_reporting(0);
	function limit_words($string, $word_limit)
	{
		$words = explode(" ", $string);
		return implode(" ", array_splice($words, 0, $word_limit));
	}

	?>

</head>

<body>


	<div id="fh5co-page">

		<?php $this->load->view('v_navbar'); ?>


		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
					<?php foreach ($data->result() as $row) :	?>
						<li style="background-image: url(<?php echo base_url() . 'theme/images/coverpage/' . $row->coverpage_gambar; ?>);">
							<div class="container">
								<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
									<div class="slider-text-inner">
										<h2><?= $row->coverpage_judul; ?></h2>
										<!-- <p><a href="#" class="btn btn-primary btn-lg">Get started</a></p> -->
									</div>
								</div>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</aside>

		<div id="fh5co-why-us" class="animate-box">
			<div class="container">
				<div class="row">

					<div class="col-md-4 text-center item-block">
						<span class="icon"><img src="<?php echo base_url() . 'theme/images/anggota.svg' ?>" class="img-responsive"></span>
						<h3>> <?= $jumlahanggota; ?></h3>
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


		<div class="fh5co-section-with-image">

			<img src="<?php echo base_url() . 'theme/images/image_10.jpg' ?>" alt="" class="img-responsive">
			<div class="fh5co-box animate-box">
				<h2>Sriwijaya In Action</h2>
				<p>Acara akbar Keluarga Mahasiswa Lampung Universitas Sriwijaya (KEMALA UNSRI)</p>
				<p><a href="https://www.instagram.com/sriwijayainaction/" target="_blank" class="btn btn-primary btn-outline with-arrow">Lihat<i class="icon-arrow-right"></i></a></p>
			</div>

		</div>



		<div id="fh5co-blog" class="animate-box">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2>ARTIKEL TERBARU</h2>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<?php
					foreach ($post->result_array() as $j) :
						$post_id = $j['tulisan_id'];
						$post_judul = $j['tulisan_judul'];
						$post_isi = $j['tulisan_isi'];
						$post_author = $j['tulisan_author'];
						$post_image = $j['tulisan_gambar'];
						$post_tglpost = $j['tanggal'];
						$post_slug = $j['tulisan_slug'];
					?>
						<div class="col-md-4">
							<a class="fh5co-entry" href="<?php echo base_url() . 'artikel/' . $post_slug; ?>">
								<figure>
									<img src="<?php echo base_url() . 'assets/images/tulisan/' . $post_image; ?>" alt="" class="img-responsive">
								</figure>
								<div class="fh5co-copy">
									<h3><?php echo $post_judul; ?></h3>
									<span class="fh5co-date"><?php echo $post_tglpost . ' | ' . $post_author; ?></span>
									<?php echo limit_words($post_isi, 20) . '...'; ?>
								</div>
							</a>
						</div>
					<?php endforeach; ?>

					<div class="col-md-12 text-center">
						<p><a href="<?php echo base_url() . 'artikel' ?>" class="btn btn-primary btn-outline with-arrow">View More <i class="icon-arrow-right"></i></a></p>
					</div>
				</div>
			</div>
		</div>

		<!-- 

		<div id="fh5co-blog" class="animate-box">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2>Berkas Musyawarah Besar</h2>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">

					<div class="col-md-4">
						<div class="fh5co-entry">
							<div class="fh5co-copy">

								<h3 class="text-center ">Rundown Acara Musyawarah Besar</h3>

								<a href="<?php echo base_url("berkasmubes2020/rundownmubes.docx"); ?>">Download <span class="icon-document"></span> </a>

							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="fh5co-entry">
							<div class="fh5co-copy">

								<h3 class="text-center ">Tata Tertib Musyawarah Besar</h3>

								<a href="<?php echo base_url("berkasmubes2020/tatibmubes.doc"); ?>">Download <span class="icon-document"></span> </a>

							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="fh5co-entry">
							<div class="fh5co-copy">

								<h3 class="text-center ">Anggaran Dasar - Anggaran Rumah Tangga, GBHPKO</h3>

								<a href="<?php echo base_url("berkasmubes2020/adartgbhpko2.docx"); ?>">Download <span class="icon-document"></span> </a>

							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="fh5co-entry">
							<div class="fh5co-copy">

								<h3 class="text-center ">LPJ Kabinet Krakatau Biru</h3>

								<a href="<?php echo base_url("berkasmubes2020/LPJKEMALAUNSRI2020_1.pdf"); ?>">Download <span class="icon-document"></span> </a>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div> -->

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