<?
//download_comments.php - Ajax download comments from database 

//Initiate the database class
include($_SERVER['DOCUMENT_ROOT'].'/classes/SafeMySQL/SafeMySQL.php');
$db = SafeMySQL::getInstance();
$comments = $db->get_results( "SELECT author, email, text FROM tt_comments WHERE article_id=1 ORDER BY id ASC" );
$string='';
     foreach( $comments as $comment )
      {
           $string=$string.'<div class="alert alert-success" role="alert"><a href="mailto:'.$comment['email'].'" class="alert-link">'.$comment['author'].'</a> <br>'.$comment['text'].'</div>';
     }
unset($db);

echo($string);

?>