<?php

//Teste se existe a ação
if(isset($_POST['action'])){
    if($_POST['action'] == 'cadastro'){
        //Teste se a ação é igual a cadastro
        echo "<p>cadastro</p>";
        echo "\n<pre>"; //Pre-formatar
        print_r($_POST);
        echo "\n<\pre>";
    }else if($_POST['action'] == 'login'){
        //Se não, teste se a ação é login
        echo "<p>login</p>";
        echo "\n<pre>"; //Pre-formatar
        print_r($_POST);
        echo "\n<\pre>";
    }else if($_POST['action'] == 'senha'){
        //Se não, teste se a ação é recuperar senha
        echo "<p>senha</p>";
        echo "\n<pre>"; //Pre-formatar
        print_r($_POST);
        echo "\n<\pre>";

    }else{
        header("location:index.php");
    }
}else{
    //Redirecionando para o index.php, negando o acesso a este arquivo diretamente
    header("location:index.php");
}
