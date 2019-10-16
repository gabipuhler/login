<?php
// Conexão com o Banco de dados
require_once 'configBD.php';

function verificar_entrada($entrada){
    //filtrando a entrada
    $saida = htmlspecialchars($entrada);
    $saida = stripcslashes($saida);
    $saida = trim($saida);
    return $saida; // retorna a saida limpa
}
//Teste se existe a ação
if(isset($_POST['action'])){
    if($_POST['action'] == 'cadastro'){
        //Teste se ação é igual a cadastro
        # echo "\n<p>cadastro</p>";
        # echo "\n<pre>";//Pre-formatar
        # print_r($_POST);
        # echo "\n<\pre>";
        //Pegando dados do formulário
        $nomeCompleto = verificar_entrada ($_POST['nomeCompleto']);
        $nomeDoUsuario = verificar_entrada($_POST['nomeDoUsuario']);
        $emailUsuario = verificar_entrada($_POST['emailUsuario']);
        $senhaDoUsuario = verificar_entrada($_POST['senhaDoUsuario']);
        $senhaUsuarioConfirmar = verificar_entrada($_POST['senhaUsuarioConfirmar']);
        $dataCriado = date ("Y-m-d"); //Data atual no formato Banco de dados.

        //Codificando as senhas
        $senhaCodificada = sha1($senhaDoUsuario);
        $senhaConfirmarCod = sha1($senhaUsuarioConfirmar);
        //Teste  de captura de dados
        // echo "<p>Nome Completo: $nomeCompleto</p>";
        // echo "<p>Nome do Usuario: $nomeDoUsuario</p>";
        // echo "<p>E-mail: $emailUsuario</p>";
        // echo "<p>Senha Codificada: $senhaCodificada</p>";
        // echo "<p>Data de criação: $dataCriado</p>";
        if($senhaCodificada != $senhaConfirmarCod){
            echo "<p class='text-danger'>Senhas não conferem.</p>";
            exit();
        }else{//As senhas conferem, veridicar se o usuario ja existe no banco de dados
            $sql = $connect->prepare("SELECT nomeDoUsuario, EmailUsuario FROM usuario WHERE nomeDoUsuario = ? OR emailUsuario = ?");
            $sql ->bind_param("ss", $nomeDoUsuario, $emailUsuario);
            $sql ->execute();
            $resultado = $sql->get_result();
            $linha = $resultado->fetch_array(MYSQLI_ASSOC);


            //Verificando a existência de usuário no banco
            if($linha['nomeDoUsuario'] ==$nomeDoUsuario){
                echo "<p class='text-danger'>Usuário indisponível, tente outro!</p>";
            }elseif($linha['emailUsuario'] == $emailUsuario){
                echo "<p class='text-danger'>E-mail indisponível, tente outro!</p>";
            }else{
                //Usuario pode ser cadastrado no banco de dados.
                $sql = $connect->prepare("INSERT into usuario (nomeDoUsuario, nomeCompleto, emailUsuario, senhaDoUsuario, dataCriado) values(?, ?, ?, ?, ?)");
                $sql->bind_param("sssss", $nomeDoUsuario, $nomeCompleto, $emailUsuario, $senhaCodificada, $dataCriado );
                if($sql->execute()){
                    echo "<p class='text-success'>Usuário cadastrado com sucesso!</p>";
                }else{
                    echo "<p class='text-danger'>Usuário não Cadastrado</p>";
                    echo "<p class='text-danger'>Algo deu errado!</p>";
                }


            }
        }

    }else if($_POST['action'] == 'login'){
        //Senão, teste se ação é login
        echo "\n<p>login</p>";
        echo "\n<pre>"; //Pre-formatar
        print_r($_POST);
        echo "\n<\pre>";
    }else if($_POST['action'] == 'senha'){
        //Senão, teste se ação é recuperar senha
        echo "\n<p>senha</p>";
        echo "\n<pre>"; //Pre-formatar
        print_r($_POST);
        echo "\n<\pre>";
    }else{
        header("location:index.php");
    }
}else{
    //Redirecionando para index.php, negando o acesso
    //a esse arquivo diretamente.
    header("location:index.php");
}