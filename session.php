<?php
session_start();
require_once "configBD.php";

if(isset( $_SESSION['nomeDoUsuario'])){
    //logado
} else{
    //Se não estiver logado, redirecionar para a página index.html
    header("location: index.php");
}