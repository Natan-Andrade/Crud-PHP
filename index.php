<?php
    $pdo = new PDO("mysql:host=localhost;dbname=crud_php", "root", ""); 

    //insert
    if(isset($_POST['titulo'])){
        $sql = $pdo->prepare("INSERT INTO tb_notas VALUES (null,?,?)");
        $sql->execute(array($_POST['titulo'],$_POST['conteudo']));
        echo "Adicionado com sucesso";
    }
?>

<form method="post">
    <input type="text" name="titulo">
    <input type="text" name="conteudo">
    <input type="submit" value="Enviar!">
</form>