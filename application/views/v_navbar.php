<header id="fh5co-header" role="banner">
	<div class="container">
		<div class="header-inner">
			<h1><a href="<?php echo base_url() . '' ?>">KEMALA<span>.</span></a></h1>
			<nav role="navigation">
				<ul>
					<li class="<?php if ($active == "Home") {
									echo "active";
								} ?>"><a href="<?php echo base_url() . '' ?>">Home</a></li>
					<li class="<?php if ($active == "About") {
									echo "active";
								} ?>"><a href="<?php echo base_url() . 'about' ?>">About</a></li>
					<li class="<?php if ($active == "Portfolio") {
									echo "active";
								} ?>"><a href="<?php echo base_url() . 'portfolio' ?>">Portfolio</a></li>
					<li class="<?php if ($active == "Blog") {
									echo "active";
								} ?>"><a href="<?php echo base_url() . 'artikel' ?>">Blog</a></li>
					<li class="<?php if ($active == "Gallery") {
									echo "active";
								} ?>"><a href="<?php echo base_url() . 'gallery' ?>">Gallery</a></li>
					<li class="<?php if ($active == "Kontak") {
									echo "active";
								} ?>"><a href="<?php echo base_url() . 'kontak' ?>">Contact</a></li>
					<li class="cta"><a href="<?php echo base_url() . 'portfolio' ?>">Get started</a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>