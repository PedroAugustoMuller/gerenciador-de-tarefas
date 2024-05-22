<?php

session_start();

$data = $_SESSION['tasks'][$_GET['key']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/details.css">
    <link rel="stylesheet" href="/style/index.css">
    <title><?php echo "Tarefa: ".  $data['task_name'];?></title>
</head>
<body>

    <div class="details-container">
        <div class="header">
            <h1><?php echo $data['task_name'];?></h1>
        </div>
        <div class="row">
            <div class="details">
                    <d1>
                        <dt>Descrição da Tarefa:</dt>
                        <dd><?php echo $data['task_description']?></dd>
                        <dt>Data da tarefa:</dt>
                        <dd><?php echo $data['task_date']?></dd>
                    </d1>
            </div>
            <div class="image">
                <img src="uploads/<?php echo $data['task_image']?>" alt="Imagem tarefa">
            </div>
            
        </div>
    </div>
    <div class="footer">
                <p>Desenvolvido por Pedro Müller</p>
    </div>
</body>
</html>