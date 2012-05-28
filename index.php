<?php

session_start();

if (isset($_SESSION["auth"]) && $_SESSION["auth"]){
    if (isset($_GET['logout']) && $_GET['logout']){
        session_destroy();
        header('Location: index.php');
    }
    // page de chargement des données courantes
    echo 'Bonjour, '.$_SESSION["login"].'.';
    include "common/controller.php";
}else{
    if (isset($_POST['login']) && isset($_POST['pwd'])){
        if (file_exists('data/users.xml')){
            $users = simplexml_load_file('data/users.xml');
            foreach($users as $user){
                if (md5($_POST['pwd']) == trim($user->pwd) && $_POST['login'] == trim($user->login)){
                    $_SESSION['auth'] 	= 1;
                    $_SESSION['login'] 	= trim($user->login);
                    header('Location: index.php');
                }
            }
        }else{
            echo 'Pas d\'utilisateur disponible';
        }
    }
    ?>
    <form method="POST" action="index.php">
        <label>Login :</label>
        <input type="text" name="login" />
        <label>Password :</label>
        <input type="password" name="pwd" />
        <input type="submit" value="Se connecter" />
    </form>
    <?
}
?>
