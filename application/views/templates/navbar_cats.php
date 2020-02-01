<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Thể loại</a>
	<div class="dropdown-menu">
		<?php if ($navbar_cats): ?>
			<?php foreach ($navbar_cats as $cat): ?>
				<a class="dropdown-item" href="<?php echo base_url('the-loai/' . $cat['slug']); ?>"><?php echo $cat['name'] ?></a>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</li>