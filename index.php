<?php

require_once __DIR__ . 'controller.php';

session_start();

if (!isset($_SESSION['tasks']))
{
    $_SESSION['tasks'] = array(); 
}

$stmt = $conn ->prepare("SELECT * FROM tasks");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/index.css">
    <title>Gerenciador de tarefas</title>
</head>
<body>
    <div class="container">
        <?php
        if(isset($_SESSION['success']))
        ?>
        <div class="alert-success"><?php echo $_SESSION['success']?></div>
        <?php
        unset($_SESSION['success']);
        ?>
        <?php
        if(isset($_SESSION['errr']))
        ?>
        <div class="alert-error"><?php echo $_SESSION['error']?></div>
        <?php
        unset($_SESSION['error']);
        ?>
        <div class="header">
            <h1>Gerenciador de Tarefas</h1>
        </div>
        <div class="form">  
            <form action="task.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="insert" value="inser">
                <label for="task_name">Tarefa</label>
                <input type="text" name="task_name" placeholder="Nome da Tarefa">
                <label for="task_description">Descrição</label>
                <input type="text" name="task_description" placeholder ="Descrição">
                <label for="task_date">Data</label>
                <input type="date" name="task_date">
                <label for="task_image">Imagem</label>
                <input type="file" name="task_image">
                <button type="submit">Cadastrar</button>
            </form>
            <?php
                if(isset($_SESSION['message']))
                {
                    echo "<p style ='color: crimson';>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }
            ?>      
        </div>
        <div class="separator">

        </div>
        <div class="list-tasks">
            <?php
                    echo "<ul>";
                    foreach($stmt->fetchAll() as $task)
                    {
                        echo "<li>
                                <a href='details.php?key=". $task['id']."'> " . $task['task_name']. " </a>
                                <button type='button' class='btn-clear' onclick='deletar". $task['id']."()'>Remover</button>
                                <script>
                                    function deletar". $task['id']."()
                                    { 
                                        if ( confirm('Confirmar remoção?') ) 
                                        {
                                            window.location = 'http://localhost:8100/task.php?key=". $task['id']."';
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
            <p>Desenvolvido por Pedro Müller</p>
        </div>
    </div>
</body>
</html>
