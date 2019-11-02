<?php
//Iniciando a sessão
session_start();

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
        $foto = verificar_entrada($_POST['foto']);
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
            $sql = $connect->prepare("SELECT nomeDoUsuario, emailUsuario FROM usuario WHERE nomeDoUsuario = ? OR emailUsuario = ?");
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
                $sql = $connect->prepare("INSERT into usuario (nomeDoUsuario, nomeCompleto, foto, emailUsuario, senhaDoUsuario, dataCriado) values(?, ?, ?, ?, ?, ?)");
                $sql->bind_param("ssssss", $nomeDoUsuario, $nomeCompleto, $foto, $emailUsuario, $senhaCodificada, $dataCriado );
                if($sql->execute()){
                    echo "<p class='text-success'>Usuário cadastrado com sucesso!</p>";
                }else{
                    echo "<p class='text-danger'>Usuário não Cadastrado</p>";
                    echo "<p class='text-danger'>Algo deu errado!</p>";
                }


            }
        }

    }else if($_POST['action'] == 'login'){
        $nomeUsuario = verificar_entrada($_POST['nomeUsuario']);
        $senhaUsuario = verificar_entrada($_POST['senhaUsuario']);
        $senha = sha1($senhaUsuario); // Senha codificada

        $sql = $connect->prepare("SELECT * FROM usuario WHERE senhaDoUsuario = ? AND nomeDoUsuario = ?");
        $sql->bind_param("ss", $senha, $nomeUsuario);

        $sql->execute();

        $busca = $sql->fetch();

        if ($busca != null) {
            $_SESSION['nomeDoUsuario'] = $nomeUsuario;
            
            if(!empty($_POST['lembrar'])){
                //se lembrar não estiver vazio!
                //ou seja, a pessoa quer ser lembrada!
                setcookie("nomeDoUsuario", $nomeUsuario, time()+(60*60*24*30));
                setcookie("senhaDoUsuario", $senhaUsuario,time()+(60*60*24*30));
            }else {
                // A pessoa não quer ser lembrada
                setcookie("nomeDoUsuario","");
                setcookie("senhaDoUsuario","");
            }
            echo "ok";
            
        } else {
            echo "<p class='text-danger'>";
            echo "falhou a entrada no sistema. Nome de usuário ou senha inválida";
            echo "</p>";
            exit();
        }

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