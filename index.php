<?php

require __DIR__ . './connect.php';

session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

// STMT = Statement é utilizado para executar instruções SQL.
$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
// PDO::FETCH_ASSOC, são responsáveis por retornar a consulta e o estilo do dado retornado, ou seja ele retornará um array associativo.
$stmt->setFetchMode(PDO::FETCH_ASSOC);
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
    <div class="container">
        <!-- SESSION DE SUCESSO -->
        <?php
            if (isset($_SESSION['success'])) {
        ?>
            <div class="alert-success"> <?php echo $_SESSION['success']; ?> </div>
        <?php
            unset($_SESSION['success']);
            }
        ?>
        <!-- SESSION DE ERROR -->
        <?php
            if (isset($_SESSION['error'])) {
        ?>
            <div class="alert-error"> <?php echo $_SESSION['error']; ?> </div>
        <?php
            unset($_SESSION['error']);
            }
        ?>

        <div class="header">
            <h1>Gerenciador de Tarefas</h1>
        </div>
        <div class="form">
            <form action="./task.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="insert" value="insert">
                <label for="task_name">Tarefa:</label>
                <input type="text" name="task_name" placeholder="Nome da tarefa">
                <label for="task_description">Descrição:</label>
                <input type="text" name="task_description" placeholder="Descrição da tarefa">
                <label for="task_date">Data</label>
                <input type="date" name="task_date">
                <label for="task_image">Imagem:</label>
                <input type="file" name="task_image" id="">
                <button type="submit">Cadastrar</button>
            </form>
            <?php
            if (isset($_SESSION['message'])) {
                echo "<p style='color: #BC413E';>" . $_SESSION['message'] . "</p>";
                unset($_SESSION['message']);
            }
            ?>
        </div>
        <div class="separator">

        </div>
        <div class="list-tasks">
            <?php
            echo "<ul>";

            foreach ($stmt->fetchAll() as $task) {
                echo "<li>
                            <a href='details.php?key=" . $task['id'] . "'>" . $task['task_name'] . "</a>
                            <button type='button' class='btn-clear' onclick='deletar" . $task['id'] . "()'>Remover</button>
                            <script>
                                function deletar" . $task['id'] . "(){
                                    if (confirm('Confirmar remoção?')) {
                                        window.location = 'http://localhost/gerenciador-tarefas/task.php?key" . $task['id'] . "';
                                    }
                                    return false;
                                }
                            </script>                      
                        </li>";
            }

            echo "</ul>";


            ?>

        </div>
        <div class="footer">

            Desenvolvido por Gabriel Martins
        </div>
    </div>
</body>

</html>