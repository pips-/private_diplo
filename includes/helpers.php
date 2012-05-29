<?php

function redirect($location) {
    header('Location: '.$location);
    die();
}

function randomSalt() {
    $randomSalt='';
    for($i=0;$i<6;$i++) { $randomSalt.=base_convert(mt_rand(),10,16); }
    return $randomSalt;
}

function getSalt($saltfile = 'data/salt.php') {
    if (!is_file($saltfile))
        file_put_contents($saltfile,'<?php /* |'.randomSalt().'| */ ?>');
    $items=explode('|',file_get_contents($saltfile));
    return $items[1];
}
