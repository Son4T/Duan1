<?php
function view($path_view, $data=[]){
    extract($data);
    $path_view  = str_replace(".","/", $path_view);
    include_once "app/Views/$path_view.php";
};

function session_flash($key) {
    $message = $_SESSION[$key] ?? "";
    unset($_SESSION[$key]);
    return $message;
};