<?php
namespace Odf\Classes;


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
     * @url POST ficheros
     * @access public
     * @return string
     */
    function post()
    {
        if (isset($_POST['user']) && isset($_POST['pass'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $id= $_POST['id'];
        if ($user == 'javi' && $pass == 'admin') {
                return "Prueba ficheros POST  ID de prueba {$id}";
            } else {
                header("HTTP/1.1 401 Unauthorized");
                $tpl = new Monotek\MiniTPL\Template;
                $tpl->load("login.tpl");
                $tpl->render();
                exit;
            }
        } else {
            header("HTTP/1.1 401 Unauthorized");
            $tpl = new Monotek\MiniTPL\Template;
            $tpl->load("login.tpl");
            $tpl->render();
            exit;
        }
    }
}
