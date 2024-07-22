<?php
require_once("helper/config.php");
require_once("helper/Database.php");
require_once("vendor/autoload.php");
require_once("helper/custom-mail.php");


$uri = isset($_GET['uri']) ? $_GET['uri'] : 'home';
$uri=str_replace(".php","",$uri);
$title = ucfirst($uri);
$uri=$uri.".php";

$pagePath="pages/".$uri;

require_once("layouts/header.php");
require_once("layouts/menu.php");
if(file_exists($pagePath) && is_file($pagePath)){
   require_once($pagePath);
}else{
    require_once("helper/404.php");
}
require_once("layouts/footer.php");

?>
