<div class="container-fluid">

	<h1>List of all posts:</h1>

	<div class="row">
	<?php foreach($posts as $post) { ?>
		<div class="col-md-12 bg-primary mb-1">
		<p>
			<?php echo $post->author; ?>
			<a href="?controller=posts&action=show&id=<?php echo $post->id;?>" class="text-white">Look at the content</a>
		</p>
		</div>
	<?php } ?>
	</div>
</div>