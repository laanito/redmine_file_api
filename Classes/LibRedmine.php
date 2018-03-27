<?php

namespace Odf\Classes;
use Redmine\Client;


class LibRedmine
{
    private $RedmineClient;
    private $Server;

    public function __construct($user, $password)
    {
        $this->Server="https://redmine.pulsia.es/";
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

    public function DownloadFile($FileId) {
        try{
        $FileData = $this->RedmineClient->attachment-> show($FileId);
        } catch (\Exception $e) {
            return false;
        }
        if (($FileData == false) || (isset($FileData->error))) {
            return false;
        }
        else {
            if(isset($FileData['attachment'])) {
                try {
                    $file_content = $this->RedmineClient->attachment->download($FileId);
                } catch (\Exception $e) {
                    return false;
                }
                if (($file_content == false) || (isset($file_content->error))) {
                    return false;
                }
                $FileData = $FileData['attachment'];
                header("HTTP/1.1 200 OK");
                header('Content-type: ' . $FileData['content_type']);
                header('Content-Disposition: attachment; filename="' . $FileData['filename'] . '"');
                echo $file_content;
                exit;
            }
           else {
                return false;
           }
        }
    }
}