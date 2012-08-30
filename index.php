<?php
session_start();

require_once 'includes/global.php';
global $db;
if (isset($_SESSION["auth"]) && $_SESSION["auth"]){
    if (isset($_GET['logout']) && $_GET['logout']){
        session_destroy();
        redirect('index.php');
    }
    // page de chargement des données courantes
    echo 'Bonjour, '.$_SESSION["login"].'.';
    include "common/controller.php";
}else{
    if (isset($_POST['login']) && isset($_POST['pwd'])){
		$sel = "SELECT	*
				FROM	".diplo_player::TABLE_NAME."
				WHERE	login LIKE '".$_POST['login']."'
				AND		password = '".hashPasswd($_POST['pwd'])."'";
		$res = $db->query($sel);
		if ($r = $res->fetchArray()){
			$_SESSION['auth'] 	= 1;
			$_SESSION['login'] 	= $r['login'];
			$_SESSION['user'] 	= $r;
			redirect('index.php');
		}else
			echo 'Erreur login/password';
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
