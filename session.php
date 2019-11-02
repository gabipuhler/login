<?php
session_start();
require_once "configBD.php";

if(isset( $_SESSION['nomeDoUsuario'])){
    //logado
    $usuario = $_SESSION['nomeDoUsuario'];
    $sql = $connect->prepare("SELECT * FROM usuario WHERE nomeDoUsuario = ?");
    $sql->bind_param("s",$usuario);
    $sql->execute();
    $resultado = $sql->get_result();
    $linha = $resultado->fetch_array(MYSQLI_ASSOC);


    $nomeDoUsuario = $linha ['nomeDoUsuario'];
    $nomeCompleto = $linha ['nomeCompleto'];
    $emailUsuario = $linha ['emailUsuario'];
    $foto = $linha['foto'];
    $dataCriado = $linha ['dataCriado'];
    $dataCriado = date('d/m/Y', strtotime($dataCriado));
    


} else{
    //Se não estiver logado, redirecionar para a página index.html
    header("location: index.php");
}