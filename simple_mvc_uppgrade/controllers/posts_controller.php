<?php 
	class PostsController {
		public function index() {
			//cuvamo sve post-ove u promenljivu
			$posts = Post::all();
			require_once('views/posts/index.php');
		}

		public function show() {
			//ocekujemo url koji ima formu >controller=posts&action=show&id=x
			//bez id-a redirektujemo na error stranu zato sto nam id treba da bi ga pronasli u database
			if (!isset($_GET['id'])) {
				return call('pages','error');
			}
			//koristimo id da uzmemo pravi post
			$post = Post::find($_GET['id']);
			require_once('views/posts/show.php');
		}
	}