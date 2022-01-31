<?php

require __DIR__ . './connect.php';

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

        // Como o nome diz, este método apenas prepara uma operação no banco de dados, logo se faz necessário a utilização de outros métodos como execute, para realmente executar a operação
        $stmt = $conn->prepare('INSERT INTO task (task_name, task_description, task_image, task_date)
                                VALUES (:name, :description, :image, :date)');
        // Para realizar a definição do valor de um parâmetro, esse método recebe como argumento  uma referência, ou seja, uma variável ou uma constante. Isso significa que se informarmos um valor de maneira direta para ele, não irá funcionar
        $stmt->bindParam('name', $_POST['task_name']);
        $stmt->bindParam('description', $_POST['task_description']);
        $stmt->bindParam('image', $file_name);
        $stmt->bindParam('date', $_POST['task_date']);

        

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
