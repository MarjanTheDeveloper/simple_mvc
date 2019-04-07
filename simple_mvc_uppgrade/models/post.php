<?php 
	class Post {
		//definisemo 3 atributa
		//oni su public da bi mogli da im pristupimo koristeci $post->author direktno
		public $id;
		public $author;
		public $content;

		public function __construct( $id, $author, $content ) {
			$this->id       = $id;
			$this->author   = $author;
			$this->content  = $content;
		}

		public static function all() {
			$list = [];
			$db = Db::getInstance();
			$req = $db->query('SELECT * FROM posts');

			//kreiramo listo Post objects iz rezultata database
			foreach ($req->fetchAll() as $post) {
				$list[] = new Post($post['id'], $post['author'], $post['content']);
			}

			return $list;
		}

		public static function find($id) {
			$db = Db::getInstance();
			//pobrinemo se da je $id integer
			$id = intval($id);
			$req = $db->prepare('SELECT * FROM posts WHERE id = :id');
			//query je pripremljen, sada menjamo :id sa pravom $id vrednoscu
			$req->execute(array('id' => $id));
			$post = $req -> fetch();

			return new Post($post['id'], $post['author'], $post['content']);
		}
	}