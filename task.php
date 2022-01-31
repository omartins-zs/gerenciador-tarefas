<?php

require __DIR__ .'./connect.php';

session_start();


if (isset($_POST['task_name'])) {
    if ($_POST['task_name'] != "") {

        if (isset($_FILES['task_image'])) {
            $ext = strtolower(substr($_FILES['task_image']['name'], -4));
            $file_name = md5(date('Y.m.d.H.i.s')) . $ext;
            $dir = 'uploads/';

            move_uploaded_file($_FILES['task_image']['tmp_name'], $dir . $file_name);
        }

        $data = [
            'task_name' => $_POST['task_name'],
            'task_description' => $_POST['task_description'],
            'task_date' => $_POST['task_date'],
            'task_image' => $file_name
        ];
        

        // Exclui 3 unset que Havia esquecido se necessario Pegar no Commit Anterior
        array_push($_SESSION['tasks'], $data);
        header('Location:index.php');

    } else {
        $_SESSION['message'] = 'O campo nome da tarefa não pode estar vazio!';
        header('Location:index.php');
    }
}


if (isset($_GET['key'])) {
    array_splice($_SESSION['tasks'], $_GET['key'], 1);
    unset($_GET['key']);
    header('Location:index.php');
}
