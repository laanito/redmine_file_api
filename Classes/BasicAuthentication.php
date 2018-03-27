<?php
/**
 *  * Created by PhpStorm.
 * User: Javier  ( Jlopezg88 )
 * Date: 15/03/2018
 * Time: 14:16
 */
namespace Odf\Classes;
use Luracast\Restler\iAuthenticate;
use Monotek\MiniTPL\Template;

class BasicAuthentication implements iAuthenticate
{
    const REALM = 'Restricted API';

    function __isAllowed()
    {
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        else {
            $id='vacio';
        }
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
            }else{
                header("HTTP/1.1 401 Unauthorized");
                $message = "Wrong credentials";
                $tpl = new Template;
                $tpl->load("login.tpl");
                $tpl->assign("id",$id);
                $tpl->assign("message",$message);
                $tpl->render();
                exit;
            }
        }else{
            header('WWW-Authenticate: Basic realm="' . self::REALM . '" ');
        }
        header("HTTP/1.1 401 Unauthorized");
        $message = "Authentication required";
        $tpl = new Template;
        $tpl->load("login.tpl");
        $tpl->assign("id",$id);
        $tpl->assign("message",$message);
        $tpl->render();
        exit;
    }

    public function __getWWWAuthenticateString()
    {
        return 'entra en el getwww';
    }
}