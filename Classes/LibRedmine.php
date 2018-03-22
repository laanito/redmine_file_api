<?php

namespace Odf\Classes;
use Redmine\Client;


class LibRedmine
{
    private $RedmineClient;
    private $Server;

    public function __construct($user, $password)
    {
        $this->Server="http://redmineodf.pulsia.es/redmine/";
        $this->RedmineClient=new Client($this->Server,$user,$password);
    }

    public function TestUser() {
        try{
            $postResult=$this->RedmineClient->project->all();
        } catch (\Exception $e) {
            return false;
        }
        if (($postResult == false) || (isset($postResult->error))) {
            return false;
        }
        else {
            return true;
        }
    }
}