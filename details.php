<?php 


session_start();


$data = $_SESSION['tasks'][$_GET['key']];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="./style.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https: //fonts.googleapis.com/css2? family= Ubuntu:wght@400;500;700 & display=swap" rel="stylesheet">
    <title>Gerenciador de Tarefas</title>
</head>

<body>
    <div class="details-container">
        <div class="header">
        </div>
    </div>
</body>
</html>