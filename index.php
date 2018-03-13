<?

//Кодировка и сжатие
ob_start("ob_gzhandler");
header("Content-Type: text/html; charset=utf-8");

include_once($_SERVER['DOCUMENT_ROOT'].'/classes/Router/Router.php');
		$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

		// Разбиваем виртуальный URL по символу "/"
		$url = explode('/', trim($url_path, ' /'));
        

switch ($url[0]) {
			case 'admin':
				include($_SERVER['DOCUMENT_ROOT'].'/views/layouts/layoutadmin.php');
				break;
            default:
				$router = new Router;
                include($_SERVER['DOCUMENT_ROOT'].'/views/layouts/layoutmain.php');
                unset($router);
            }

?>