<?php
session_start();

if (!isset($_SESSION['tasks']))
{
    $_SESSION['tasks'] = array(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gerenciador de tarefas</title>
</head>
<body>
    <div class="container">
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
                if(isset($_SESSION['tasks']))
                {
                    echo "<ul>";
                    
                    foreach($_SESSION['tasks'] as $key => $task)
                    {
                        echo "<li>
                                <span> " . $task['task_name']. " </span>
                                <button type='button' class='btn-clear' onclick='deletar$key()'>Remover</button>
                                <script>
                                    function deletar$key()
                                    { 
                                        if ( confirm('Confirmar remoção?') ) 
                                        {
                                            window.location = 'http://localhost:8100/task.php?key=$key';
                                        }
                                        return false;
                                    }
                                </script>
                            </li>";
                    }
                    echo "</ul>";
                }
            ?>
        </div>
        <div class="footer">
            <p>Desenvolvido por Pedro Müller</p>
        </div>
    </div>
</body>
</html>
