<?php

try 
{
    $conn = new pdo(
        'mysql:host=localhost;dbname=task_manager', 
        'root',
        '');
}
catch(PDOException $e){
    echo "Erro ao se conectar ao banco: Erro " . $e->getMessage();
}