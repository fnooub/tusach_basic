<!-- detail -->
<div class="bg-light border rounded p-3">
	<h1 class="h5"><?php echo $posts['title'] ?></h1>
	<ul class="list-unstyled mt-3 mb-5">
		<li><div class="border-bottom d-inline-block mb-2">Tác giả: <a href="<?php echo base_url('tac-gia/' . $posts['author_slug']); ?>" title="<?php echo 'Tác giả ' . $posts['author_name'] ?>"><?php echo $posts['author_name'] ?></a></div></li>
		<?php
		foreach ($posts['categories'] as $cat) {
			$cats[] = '<a href="' . base_url('the-loai/' . $cat['slug']) . '" title="Thể loại ' . $cat['name'] . '">' . $cat['name'] . '</a>';
		}
		?>
		<li><div class="border-bottom d-inline-block mb-2">Thể loại: <?php echo implode(', ', $cats); ?></div></li>
		<li><div class="border-bottom d-inline-block mb-2">Định dạng: <span class="badge badge-success">ePub</span></div></li>
		<li><div class="border-bottom d-inline-block mb-2">Kích thước: <?php echo format_bytes($posts['download_size']) ?></div></li>
		<li><a class="btn btn-info text-uppercase px-5" href="<?php echo base_url('tai-ve/' . $posts['download_url']); ?>" target="_blank" role="button">Tải về</a></li>
	</ul>
	<?php if ($posts['download_size'] > 20000000): ?>
	<div class="mb-2">
		<span class="text-danger font-weight-ligh font-italic">
			(*) Sách này có nội dung hình ảnh và nặng.
		</span>
	</div>
	<?php endif ?>
	<!-- anh -->
	<div class="text-center text-secondary">Ảnh bìa</div>
	<img src="<?php echo $posts['featured_image'] ?>" class="mx-auto d-block img-fluid mt-2 mb-5 border border-secondary" style="box-shadow: -10px -10px 5px #888;" alt="<?php echo $posts['title'] ?>">
</div>
