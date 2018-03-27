<?php

namespace Odf\Classes;
use Luracast\Restler\iAuthenticate;
use Monotek\MiniTPL\Template;

/**
 * Class BasicAuthentication
 * @package Odf\Classes
 */
class BasicAuthentication implements iAuthenticate
{
    const REALM = 'Restricted API';

    /**
     * @return bool
     * @throws \Exception
     */
    function __isAllowed()
    {
        // It checks if the user and password have been entered.
        // Otherwise, he will re-send us to the apache form.
        // In case the password is erroneous it will redirect us to the login
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $user = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];
            //It is checked if the entered username and password agree with the database
            $RedmineClient = new LibRedmine($user,$pass);
            if ($RedmineClient->TestUser()) {
                return true;
            } else {
                header("HTTP/1.1 401 Unauthorized");
                $message = "Wrong credentials";
                $tpl = new Template;
                $tpl->load("login.tpl");
                $tpl->assign("message",$message);
                $tpl->render();
                exit;
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
            $message = "Authentication required";
            $tpl = new Template;
            $tpl->load("login.tpl");
            $tpl->assign("message",$message);
            $tpl->render();
            exit;
        }
        header("HTTP/1.1 401 Unauthorized");
        $message = "Authentication required";
        $tpl = new Template;
        $tpl->load("login.tpl");
        $tpl->assign("message",$message);
        $tpl->render();
        exit;
    }

    /**
     * @return string
     */
    public function __getWWWAuthenticateString()
    {
        return 'entra en el getwww';
    }
}
