<?php
require_once("../helper/config.php");

$uri = isset($_GET['uri']) ? $_GET['uri'] : 'dashboard';
$uri=str_replace(".php","",$uri);
$title = ucfirst($uri);
$uri=$uri.".php";

$pagePath="pages/".$uri;

require_once("layouts/header.php");
if(file_exists($pagePath) && is_file($pagePath)){
   require_once($pagePath);
}else{
    require_once("../helper/404.php");
}
require_once("layouts/footer.php");

?>
