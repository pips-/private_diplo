<?php
if (isset($_COOKIE["auth"]) && $_COOKIE["auth"]){
    if ($_GET['logout'] && $_GET['logout']){
        session_destroy();
        setcookie('auth',0,1);
        setcookie('login','',1);
        header('Location: index.php');
    }
    // page de chargement des données courantes
    echo 'F&eacute;licitation, '.$_COOKIE["login"].' est connect&eacute; !';
}else{
    if (isset($_POST['login']) && isset($_POST['pwd'])){
        if (file_exists('data/users.xml')){
            $users = simplexml_load_file('data/users.xml');
            foreach($users as $user){
                if (md5($_POST['pwd']) == trim($user->pwd) && $_POST['login'] == trim($user->login)){
                    setcookie('auth',1);
                    setcookie('login',trim($user->login));
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
