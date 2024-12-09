<?php
session_start();
include_once '../class/Jogos.php';
include_once '../class/Administrador.php';
include_once '../class/Desenvolvedora.php';
include_once '../db/config.php';

$logado = "null";

$usu = new Administrador($db);
$des = new Desenvolvedora($db);
$jogo = new Jogo($db);
$desenvelvedoras = $des->ler();
$admTrue = isset($_SESSION['adm']);

//Adm
if (isset($_SESSION['adm'])) {
    $logado = $_SESSION['adm'];

    $dados_des = $des->lerPorId($_GET['idDes']);

    //Des
} else if (isset($_SESSION['des'])) {
    $logado = $_SESSION['des'];
    $dados_des = $des->lerPorId($logado['idDes']);

    //Usu
} else if (isset($_SESSION['usu'])) {
    header('Location: ../index.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $idade = $_POST['idade'];
    $fk_desenvolvedora = $_POST['desen'];
    $categoriaJogo = $_POST['cat'];

    $nomeImagem = "";
    if ($imagem['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
        $tamanho = 10 * 1024 * 1024; //10mb

        //validar tipos de arquivos
        $tiposPermitidos = ['jpg', 'jpeg', 'png'];
        if (!in_array($extensao, $tiposPermitidos)) {
            die("Apenas arquivos JPG, JPEG e PNG são permitidas");
        }
        if ($imagem['size'] > $tamanho) {
            die("O tamanho do arquivo não pode execer 10MB");
        }

        //gerar nome único para o arquivo
        $nomeImagem = uniqid() . "." . $extensao;
        $destino = "../uploads/" . $nomeImagem;

        //mover o arquivo para o diretório
        if (!move_uploaded_file($imagem['tmp_name'], $destino)) {
            die("erro ao salvar a imagem");
        } else if ($imagem['error'] !== UPLOAD_ERR_OK) {
            die("erro ao fazer upload da imagem");
        }

    $jogo->registrar($nome, $nomeImagem, $descricao, $preco, $idade, $fk_desenvolvedora, $categoriaJogo);

    }
}




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <header>
        <h1>Adicionar seu jogo</h1>
    </header>
    <a href="../login.php">voltar</a>
    <main>
        <img id="logo" src="https://png.pngtree.com/png-vector/20230909/ourmid/pngtree-cool-emoticon-cut-out-png-image_9222499.png" alt="">


        <form method="POST" enctype="multipart/form-data">

            
            <?php 
            if ($admTrue){

            echo "<label for='desen'>Selecionar Desenvolvedora:</label>
            <select name='desen' id='desen'>";
            }
            
            while ($row = $desenvelvedoras->fetch(PDO::FETCH_ASSOC)) {

                   echo "<option value='<?php echo ".$row['idDes'].";?>'>  <?php echo ".$row['nomeDes'].";?></option>";}
            ?>

            </select>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="cpf">Cpf/cnpj:</label>
            <input type="text" name="cpf" required>

            <label for="email">Email:</label>
            <input type="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" required>



            <input id="button" type="submit" value="Adicionar">
        </form>
    </main>

</body>

</html>

