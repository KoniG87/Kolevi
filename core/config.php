<?php
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	session_start();
	
	$defaultParameters = array(
		'application'  => array(
            'name'      => 'Kőleves',
			'version'	=> array(
                'name'  => 'Vendéglő',
				'main'	=> '0',
				'sub'	=> '1',
				'build'	=> '0'
			),
/*			'dbParams' => array(
				'host' 		=> '127.0.0.1',
				'name' 		=> 'kolevesvendeglo_hu',
				'userName' 	=> 'kolevesvendeglo',
				'userPass' 	=> 'EA55kTCugILhl',
				'prefix'	=> ''
			),*/
			'dbParams' => array(
				'host' 		=> 'localhost',
				'name' 		=> 'kolevesvendeglo_hu',
				'userName' 	=> 'root',
				'userPass' 	=> '',
				'prefix'	=> ''
			),
			'helperParams' => array(
				'language' => 'hu',
				'validParams' => array(
					'page',
					'lang'	
				)
			),
			'state'		=> 'dev',
			'skin'		=> 'default',
			'dbSalt' 	=> 'bi1Oc@-1pqS9&!7',
			'dirs'	=> array(
				'views' 	=> 'page/',
				'skins' 	=> 'skins/',
				'scripts'	=> 'js/',
				'styles'	=> 'css/',
                'images'	=> 'img/',
                'fonts'	=> 'fonts/'
			)
        )
	);
	
	spl_autoload_register(function ($class) {
		$classFile = 'core/model/model' . $class . '.php';
		if (file_exists($classFile)){
			include $classFile;
		}
	});
	spl_autoload_register(function ($class) {
		$classFile = 'core/view/view' . substr($class, 0, -4). '.php';
		if (file_exists($classFile)){
			include $classFile;
		}
	});
	spl_autoload_register(function ($class) {
		$classFile = 'core/controller/controller' . $class . '.php';
		if (file_exists($classFile)){
			include $classFile;
		}
	});
	
	$app = new Application($defaultParameters['application']);
	
	include('core/pageConfig.php');
	
	if (!$app->isUserLogged()){
		$_GET['page'] = 'login';
	}
	
	$app->initHelper($defaultParameters['application']['helperParams']);
	
?>