<?php
//teste se existe a ação
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'cadastro') {
        //teste se ação é igual a cadastro
        echo "<\np>cadastro</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre>";
    } else if ($_POST['action'] == 'login') {
        //senão, teste se ação é login
        echo "<\np>login</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre>";
    } else if ($_POST['action'] == 'senha') {
        //senão, teste se ação é senha
        echo "<\np>senha</p>";
        echo "\n<pre>";
        print_r($_POST);
        echo "\n</pre>";
    } else {
        header("location:index.php");
    }
} else {
    //redirecionando para index.php, negando o acesso
    //a esse arquivo diretamente.
    header("location:index.php");
}
