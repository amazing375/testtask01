<?
//upload_comments.php - Ajax upload a comment to database

//Initiate the database class
include($_SERVER['DOCUMENT_ROOT'].'/classes/SafeMySQL/SafeMySQL.php');
$db = SafeMySQL::getInstance();
$user_data = array(
     'author' => $_POST['name'], 
     'email' => $_POST['email'], 
     'text' => $_POST['comment'],
	 'article_id' => 1
     );
 $db->insert( 'tt_comments', $user_data );
 unset($db);
$string='<div class="alert alert-success" role="alert"><a href="mailto:'.$_POST['email'].'" class="alert-link">'.$_POST['name'].'</a> <br>
'.$_POST['comment'].'</div>';
echo($string);

?>