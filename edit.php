<?php
    require 'conectdb.php';

    $tb_notas = [];
    $id = filter_input(INPUT_GET, 'id');
    if($id){
        $sql = $pdo->prepare("SELECT * FROM tb_notas WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $tb_notas = $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            header("Location: index.php");
            exit;
        }
    }else{
        header("Location: index.php");
    }

    //delete
    if(isset($_GET['delete'])){
        $id = (int)$_GET['delete'];
        $pdo->exec("DELETE FROM tb_notas WHERE id=$id");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">
    <title>Notepad</title>
</head>

    <body>
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="row align-items-center">
                            <div class="col-lg-7 mb-5 mb-lg-0">
                                <i class="fa-duotone fa-house-blank"></i>
                                <h2 class="mb-5">Editar Anotação</h2>
                            
                                <form class="border-right pr-5 mb-5" method="POST" action="edit_action.php" id="contactForm" name="contactForm">
                                    <input type="hidden" name="id" value="<?= $tb_notas['id'];?>">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <input type="text" class="form-control" name="titulo" value="<?= $tb_notas['titulo'];?>" id="email" placeholder="Titulo">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <textarea class="form-control" name="conteudo" id="message" cols="30" rows="7" placeholder="Write your message"><?= $tb_notas['conteudo'];?></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="submit" value="Atualizar" class="btn btn-primary rounded-0 py-2 px-4">
                                            <span class="submitting"></span>
                                        </div>
                                    </div>
                                </form>
                                <div id="form-message-warning mt-4"></div>
                                <div id="form-message-success">
                                </div>
                            </div>
                            <div class="col-lg-4 ml-auto">
                                <h3 class="mb-4">Suas Anotações</h3>
                                <?php
                                    //List
                                    $sql = $pdo->prepare("SELECT * FROM tb_notas");
                                    $sql->execute();

                                    $fetchNotas = $sql->fetchAll();

                                    foreach ($fetchNotas as $key => $value){
                                        echo '<h4><a href="read.php?id='.$value['id'].'">'.substr(strip_tags($value['titulo']),0,20).'...'.'</a></h4>'.'<p>'.substr(strip_tags($value['conteudo']),0,20).'...'.'</p>'.'<a href="?delete='.$value['id'].'">Deletar </a>'.' | '.' <a href="edit.php?id='.$value['id'].'">atualizar</a>';
                                        echo '<hr>';
                                    }
                                ?>
                                <p><a href="index.php">+ Nova nota</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>