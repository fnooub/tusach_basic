<?php if ($navbar_pages): ?>
<ul class="list-inline">
	<?php foreach ($navbar_pages as $page): ?>
	<li class="list-inline-item"><a href="<?php echo base_url('p/' . $page['slug']); ?>"><?php echo $page['title'] ?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>