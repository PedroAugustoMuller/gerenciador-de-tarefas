<?php

require_once __DIR__ . 'controller.php';

session_start();

//RELIZA O CADASTRO DAS TASKS

if (isset($_POST['task_name']))
{
    if($_POST['task_name']!= "")
    {

        if(isset($_FILES['task_image']))
        {
            $ext = strtolower(substr($_FILES['task_image']['name'],-4));
            $file_name = md5(date('Y.m.d.H.i.s')). $ext;
            $dir = 'uploads/';

            move_uploaded_file($_FILES['task_image']['tmp_name'],$dir.$file_name);
        }

        $data = [
            'task_name' => $_POST['task_name'],
            'task_description' => $_POST['task_description'],
            'task_date' => $_POST['task_date'],
            'task_image' => $file_name
        ];

        $stmt = $conn ->prepare('INSERT INTO task_manager (task_name, task_description, task_image, task_date) 
        VALUES(:name,:description,:image,:date)');
        $stmt->bindParam('name',$_POST['task_name']);
        $stmt->bindParam('description',$_POST['task_description']);
        $stmt->bindParam('image',$file_name);
        $stmt->bindParam('date',$_POST['task_date']);

        if($stmt->execute())
        {
            $_SESSION['success'] = "Dados cadastrados";
            header('Location: index.php');
        }
        else
        {
            $_SESSION['error'] = "Dados não cadastrados";
            header('Location: index.php');
        }
        unset($_POST['task_name']);
        unset($_POST['task_description']);
        unset($_POST['task_date']);
    }
    else 
    {
        $_SESSION['message'] = "O campo 'Nome da Tarefa' não pode ser vazio";
        header('Location:index.php');
    }
}

//REMOVE TASKS
if (isset($_GET['key']))
{
    $stmt-> $conn->prepare('DELETE FROM task_manager WHERE id=:id');
    $stmt->bindParam(':id',$_GET['key']);

    if($stmt->execute())
    {
        $_SESSION['success'] = "Dados Removidos";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['error'] = "Dados não removidos";
        header('Location: index.php');
    }
}