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
        if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if ($user == 'javi' && $pass == 'admin') {
                return "Prueba ficheros POST  ID de prueba {$id}";
            } else {
                $message = "Wrong credentials";
                header("HTTP/1.1 401 Unauthorized");
                $tpl = new Template;
                $tpl->load("login.tpl");
                $tpl->assign("id",$id);
                $tpl->assign("message",$message);
                $tpl->render();
                exit;
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
            $id='vacio';
            $message = "Credentials must be given";
            $tpl = new Template;
            $tpl->assign("id",$id);
            $tpl->assign("message",$message);
            $tpl->load("login.tpl");
            $tpl->render();
            exit;
        }
    }
}
