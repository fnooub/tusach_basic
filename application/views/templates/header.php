<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/x-icon" href="<?php echo base_url('public/images/favicon.ico'); ?>">
	<?php meta_tags($seo['enable'], $seo['title'], $seo['desc'], $seo['imgurl'], $seo['url'], $seo['canonical']); ?>
	<link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css'); ?>">
	<?php
	/*gtag*/
	$gtag = $this->config->item('gtag');
	if (!empty($gtag)) { ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $gtag ?>"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '<?php echo $gtag ?>');
	</script>
	<?php } ?>
</head>
<body>
<!-- container -->
<div class="container">

<div class="row py-3">
	<div class="col-xs-12 col-lg-6">
		<ul class="nav">
			<li class="nav-item">
				<a class="navbar-brand" href="<?php echo base_url(); ?>">TUSACH.ORG</a>
			</li>
			<?php $this->load->view('templates/navbar_cats', $this->data); ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('ebook'); ?>">Tất cả sách</a>
			</li>
		</ul>
	</div>
	<div class="col-xs-12 col-lg-6 my-lg-0 my-3">
		<form action="<?php echo base_url('search'); ?>" method="get">
			<div class="input-group mb-2">
				<input type="text" class="form-control" placeholder="Tìm tác phẩm hoặc tác giả..." name="tukhoa" id="tukhoa" onkeyup="ajaxSearch();">
				<div class="input-group-append">
				<button class="btn btn-primary" type="submit">Tìm</button>
				</div>
			</div>
			<!-- result -->
			<div id="suggestions" class="position-relative">
				<ul id="autoSuggestionsList" class="position-absolute" style="z-index: 1000"></ul>
			</div>
		</form>
	</div>
</div>