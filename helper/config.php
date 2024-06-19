<?php

session_start();
ob_start();



if(!function_exists("url")){
    function url($url=""){
       $host = $_SERVER['HTTP_HOST'];
       $project_name = "phpnews";
       $url = trim($url,"/");
        return "http://".$host."/".$project_name."/".$url;      
    }
}


if(!function_exists("public_path")){
    function public_path($path=""){
        $docRoot=$_SERVER['DOCUMENT_ROOT'];
        $project_name = "phpnews";
        $path=trim($path,"/");
        return $docRoot."/".$project_name."/public/".$path;
    }
}


if(!function_exists("redirect_back")){
    function redirect_back(){
        $referer = $_SERVER['HTTP_REFERER'] ?? url();
        header("Location:".$referer);
        exit();
        
    }
}


if(!function_exists("messages")){
    function messages(){
        if(isset($_SESSION['success'])){
            echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
            unset($_SESSION['success']);
        }
        if(isset($_SESSION['error'])){
            echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }
    }
}