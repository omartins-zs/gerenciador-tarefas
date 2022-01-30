<?php 

session_start();


var_dump($_SESSION['tasks'][$_GET['key']]);