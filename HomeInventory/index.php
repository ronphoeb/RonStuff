
<?php 

/*
 * index.php
 * simple entry point into the application controller
 * rjc 5/26/2013
 */

   include_once("controller/Controller.php");

   $controller = new Controller();
   $controller->invoke();
?>

