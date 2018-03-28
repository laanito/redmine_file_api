<?php
namespace Odf\Classes;

use Monotek\MiniTPL\Template;

/**
 * Class Ficheros
 * @package Odf\Classes
 */
class Ficheros
{
    /**
     * @url GET ficheros/{fileid}
     * @param string $fileid
     * @access protected
     * @throws
     * @return string
     */
    function get($fileid)
    {
        if (isset($_SERVER['PHP_AUTH_USER'])) {
            $user = $_SERVER['PHP_AUTH_USER'];
            $pass = $_SERVER['PHP_AUTH_PW'];
            $RedmineClient = new LibRedmine($user, $pass);
            if ($RedmineClient->testUser()) {
                $result = $RedmineClient->downloadFile($fileid);
                if (!$result) {
                    header("HTTP/1.1 404 Not Found", true, 404);
                    exit;
                } else {
                    exit;
                }
            }
            header("HTTP/1.1 401 Unauthorized", true, 401);
            $message = "Wrong credentials";
            $tpl = new Template;
            $tpl->load("login.tpl");
            $tpl->assign("message", $message);
            $tpl->render();
            exit;
        }
        else {
            header("HTTP/1.1 401 Not Found", true, 401);
            exit;
        }
    }

    /**
     * @url POST ficheros/{fileid}
     * @param string $fileid
     * @access public
     * @throws
     * @return string
     */
    function post($fileid)
    {
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            //It is checked if the entered username and password agree with the database
            $RedmineClient = new LibRedmine($user, $pass);
            if ($RedmineClient->testUser()) {
                $result=$RedmineClient->downloadFile($fileid);
                if (!$result) {
                    header("HTTP/1.1 404 Not Found", true, 404);
                    echo "Fichero no encontrado";
                    exit;
                } else {
                    exit;
                }
            } else {
                header("HTTP/1.1 401 Unauthorized", true, 401);
                $message = "Wrong credentials";
                $tpl = new Template;
                $tpl->load("login.tpl");
                $tpl->assign("message", $message);
                $tpl->render();
                exit;
            }
        } else {
            header("HTTP/1.1 401 Unauthorized", true, 401);
            $message = "Authentication required";
            $tpl = new Template;
            $tpl->load("login.tpl");
            $tpl->assign("message", $message);
            $tpl->render();
            exit;
        }
    }
}
