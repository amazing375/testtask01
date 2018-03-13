<?
//layoutmain.php - main layout of site's front

include_once($_SERVER['DOCUMENT_ROOT'].'/classes/Router/Router.php');
$router = new Router;
$arURL=$router->parseURL();
//Initiate the database class
include($_SERVER['DOCUMENT_ROOT'].'/classes/SafeMySQL/SafeMySQL.php');
$db = SafeMySQL::getInstance();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title><?=$router->getTitle();?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="/js/jquery.min.js"></script>
</head>
<body>
<?
$router->firstLevelUrl();
unset($router);
?>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
