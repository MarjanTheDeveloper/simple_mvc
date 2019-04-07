<?php 
	function call($controller, $action) {
		//zahtevamo file koje odgovara imenu controller-a
		require_once('controllers/' . $controller . '_controller.php');

		//kreiramo novu instance potrebnog controller-a
		switch ($controller) {
			case 'pages':
				$controller = new PagesController();
				break;
			case 'posts':
				//treba nam model da query-ujemo database kasnije u controller-u
				require_once('models/post.php');
				$controller = new PostsController();
				break;
		}

		//pozivamo action
		$controller->{ $action }();
	}

	//lista controller-a koje imamo i njihove actions
	//razmatramo "allowed" promenljive
	//dodajemo ulaz za novi controller i njegovu akciju
	$controllers = array(
		'pages' => ['home', 'error'],
		'posts' => ['index', 'show'],
	);

	//proveravamo zahtevan controller i action su obe allowed
	//ako neko proba da pristupi necemu drugom redirektovacemo ga ka error action
	if (array_key_exists($controller, $controllers)) {
		if (in_array($action, $controllers[$controller])) {
			call($controller, $action);
		} else {
			call('pages', 'error');
		}
	} else {
		call('pages', 'error');
	}