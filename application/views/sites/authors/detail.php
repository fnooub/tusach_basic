<div class="bg-light border rounded p-3">
	<h1 class="h5">Tác giả: <?php echo $author['name'] ?></h1>
	<ul class="list-unstyled">
		<?php if ($posts): ?>
			<?php foreach ($posts as $post): ?>
				<li><a href="<?php echo base_url('ebook/' . $post['slug']); ?>" title="<?php echo $post['title'] ?>"><?php echo $post['title'] ?></a></li>
			<?php endforeach ?>			
		<?php endif ?>
	</ul>
</div>