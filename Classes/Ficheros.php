<?php
namespace Odf\Classes;

use Monotek\MiniTPL\Template;


class Ficheros
{
    /**
     * @url GET ficheros/{id}
     * @param string $id
     * @access protected
     * @return string
     */
    function get($id)
    {
        return "Prueba ficheros {$id}";
    }

    /**
     * @url POST ficheros/{id}
     * @access public
     * @throws
     * @return string
     */
    function post($id)
    {
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            //It is checked if the entered username and password agree with the database
            $RedmineClient = new LibRedmine($user, $pass);
            if ($RedmineClient->TestUser()) {
                return true;
            } else {
                header("HTTP/1.1 401 Unauthorized");
                $message = "Wrong credentials";
                $tpl = new Template;
                $tpl->load("login.tpl");
                $tpl->assign("message", $message);
                $tpl->render();
                exit;
            }
        } else {
            header('WWW-Authenticate: Basic realm="' . self::REALM . '" ');
            return "Prueba ficheros {$id}";
        }
        header("HTTP/1.1 401 Unauthorized");
        $message = "Authentication required";
        $tpl = new Template;
        $tpl->load("login.tpl");
        $tpl->assign("message", $message);
        $tpl->render();
        exit;
    }
}
