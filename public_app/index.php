<?php
    require_once(dirname(dirname(__FILE__)).'/config/configuration.php');
    require_once(dirname(dirname(__FILE__)).'/includes/dbconnection.php');
    
    $_request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $_CONTROLLER = $_request[0];
    $_ACTION = $_request[1];

    if (isset($_CONTROLLER) && isset($_ACTION))
    {
        $controller = $_CONTROLLER;
        $action     = $_ACTION;
    }
    else
    if (isset($_CONTROLLER))
    {
        $controller = $_CONTROLLER;
        $action     = '';
    }
    else
    {
        $controller = 'projects';
        $action     = 'main';
    }       

    require_once(dirname(dirname(__FILE__)).'/views/template.php');
?>
