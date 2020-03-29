<?php

session_start();

//Make flash message to user

function setFlash(string $name = null, string $msg = null, string $class = 'alert alert-success')
{
    if (isset($_SESSION[$name])) {
        unset($_SESSION[$name], $_SESSION[$name.'_class']);
    }
    $_SESSION[$name] = $msg;
    $_SESSION[$name.'_class'] = $class;
}

function getFlash(string $name = null)
{
    $class = $_SESSION[$name.'_class'];
    if (isset($_SESSION[$name])) {
        echo '<div class="'.$class.'" id="msg-flash" >'.$_SESSION[$name].'</div>';
    }
    unset($_SESSION[$name], $_SESSION[$name.'_class']);
}

function isLogedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }

    return false;
}
