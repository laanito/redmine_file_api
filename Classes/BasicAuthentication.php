<?php
/**
 *  * Created by PhpStorm.
 * User: Javier  ( Jlopezg88 )
 * Date: 15/03/2018
 * Time: 14:16
 */
namespace Odf\Classes;
use Luracast\Restler\iAuthenticate;

class BasicAuthentication implements iAuthenticate
{
    const REALM = 'Restricted API';

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
            }else{
                header("HTTP/1.1 401 Unauthorized");
                include("login.html");
                exit;
            }
        }else{
            header('WWW-Authenticate: Basic realm="' . self::REALM . '" ');
        }
        header("HTTP/1.1 401 Unauthorized");
        include("login.html");
        exit;
    }

    public function __getWWWAuthenticateString()
    {
        return 'entra en el getwww';
    }
}