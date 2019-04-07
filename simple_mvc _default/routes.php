<?php 
	function call($controller, $action) {
		//zahtevamo file koje odgovara imenu controller-a
		require_once('controllers/' . $controller . '_controller.php');

		//kreiramo novu instance-u potrebnog controller-a
		switch ($controller) {
			case 'pages':
				$controller = new PagesController();
				break;
		}

		//pozivamo action
		$controller->{ $action }();
	}

	//lista controller-a koje imamo i njihovi actions-i
	//razmatramo "allowed" promenljive
	$controllers = array('pages' => ['home', 'error']);

	//proveravamo zahtevan controller i action su obe allowed
	//ako neko proba da pristupi necemu drugom redirektovacemo ga ka error strani
	if (array_key_exists($controller, $controllers)) {
		if (in_array($action, $controllers[$controller])) {
			call($controller, $action);
		} else {
			call('pages', 'error');
		}
	} else {
		call('pages', 'error');
	}