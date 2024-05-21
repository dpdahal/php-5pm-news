<?php


if(!function_exists("url")){
    function url($url=""){
       $host = $_SERVER['HTTP_HOST'];
       $project_name = "phpnews";
       $url = trim($url,"/");
        return "http://".$host."/".$project_name."/".$url;      
    }
}