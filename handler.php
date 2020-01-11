<?php
session_start();

include 'engine.php';

$function = $_GET['fun'];

if (function_exists($function)) {
    $function();
}else{
    echo '<script> window.location.href="error.html" </script>';
}


