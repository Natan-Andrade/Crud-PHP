<?php

 require 'config.php';

    $id = filter_input(INPUT_POST, 'id');
    $titulo = filter_input(INPUT_POST, 'titulo');
    $conteudo = filter_input(INPUT_POST, 'conteudo');

    if($id && $titulo && $conteudo){
        $sql = $pdo->prepare("UPDATE tb_notas SET titulo = :titulo, conteudo = :conteudo WHERE id = :id");
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':conteudo', $conteudo);
        $sql->bindValue(':id', $id);
        $sql->execute();


        header("Location: index.php");
        exit;
    }else{
        header("Location: index.php");
        exit;
    }

    
?>