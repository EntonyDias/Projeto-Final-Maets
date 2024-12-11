<?php 
session_start();
include_once '../db/config.php';
include_once '../class/Usuario.php';
include_once '../class/Administrador.php';
include_once '../class/Desenvolvedora.php';
$tela=null;

if (!isset($_SESSION['adm'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tela = isset($_POST['acao']) ? $_POST['acao'] : '';
}

// Processar exclusão de usuário


$usu = new Usuario($db);
$adm = new Administrador($db);
$des = new Desenvolvedora($db);

$dadosUsu = $usu->ler();
$dadosAdm = $adm->ler();
$dadosDes = $des->ler();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>central do administrador</title>
    <link rel="stylesheet" href="../css/centralAdm.css">
</head>
<body>
<header>
    <div><h1>central do administrador</h1></div>
<div>
    <form  action="" method="post">
        <input type="submit" value="usuarios">
        <input type="hidden" name="acao" value="usuario">
    </form>
    <form  action="" method="post">
        <input type="submit" value="jogo">
        <input type="hidden" name="acao" value="jogo">
    </form>
</div>
</header>
    <main>
        <a href="../index.php">voltar</a>
<?php

switch ($tela) {
    case 'usuario':?>
  
  <section class="usuario">
 

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>gerenciador de Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
   
        <h1>gerenciamento de usuarios</h1>
 
    <main>
        <table border="1">
            <tr>

                <th>Nome</th>
                <th>cpf</th>
                <th>email</th>
                <th>Email</th>
            </tr>
            <?php while ($row = $dadosUsu->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>

                    <td><?php echo $row['nomeUsu']; ?></td>
                    <td><?php echo $row['cpfUsu'] ?></td>
                    <td><?php echo $row['emailUsu']; ?></td>
                    <td>
                        <a href="../deletar.php?cargo=1&id=<?php echo $row['idUsuario']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                        <a href="../editar.php?cargo=1&id=<?php echo $row['idUsuario']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <h1>gerenciamento de administradores</h1>
 

     <table border="1">
         <tr>

             <th>Nome</th>
             <th>cpf</th>
             <th>email</th>
             <th>Email</th>
         </tr>
         <?php while ($row = $dadosAdm->fetch(PDO::FETCH_ASSOC)) : ?>
            <?php
$admInfo=$usu->lerPorId( $row['fk_usuario']);
?>
            
            <tr>

                 <td><?php echo $admInfo['nomeUsu']; ?></td>
                 <td><?php echo $admInfo['cpfUsu'] ?></td>
                 <td><?php echo $admInfo['emailUsu']; ?></td>
                 <td>
                     <a href="../deletar.php?cargo=2&id=<?php echo $row['idAdm']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                     <a href="../editar.php?cargo=2&id=<?php echo $row['idAdm']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                 </td>
             </tr>
         <?php endwhile; ?>
     </table>
     <h1>gerenciamento de Desenvolvedoras</h1>
 

     <table border="1">
         <?php while ($row = $dadosDes->fetch(PDO::FETCH_ASSOC)) : ?>
               
            <tr>

                 <td><?php echo $row['nomeDes']; ?></td>
                 <td><?php echo $row['cnpjDes'] ?></td>
                 <td><?php echo $row['emailDes']; ?></td>
                 <td>
                     <a href="../deletar.php?cargo=3&id=<?php echo $row['idDes']; ?>"><img id="imgalt" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcx1AupvWZqkA2_GijfJIDCsc1xCNXVNOkDQ&s" alt=""></a>
                     <a href="../editar.php?cargo=3&id=<?php echo $row['idDes']; ?>"><img id="imgex" src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_640.png" alt=""></a>
                 </td>
             </tr>
         <?php endwhile; ?>
     </table>

        </main>
  </section>


  <?php break;
   case 'jogo':?>

<section class="jogo">

</section>

    <?php break;

    default:
     
}
?>
    
    </main>
</body>
</html>