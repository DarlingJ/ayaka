<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\model\BsUser;

class Bsmain extends BaseController
{
    protected function initialize()
    {
        parent::initialize();
    }
    public function index()
    {
        return $this->view->fetch();
    }
    public function manu()
    {
        $userid = 'admin';
        $model = new BsUser();
        $userRole = $model->getManu($userid);
        $manu = [];
        foreach ($userRole as $each)
        {
            if(!isset($manu[$each["GROUPID"]]))
            {
                $manu[$each["GROUPID"]] = [
                    "id" => $each["GROUPID"],
                    "text" => $each["GROUPNAME"],
                    "children" => [
                        [
                        "id" => $each["PROID"],
                        "text" => $each["PRONAME"],
                        "url" => $each["PATH"]
                        ]
                    ]
                ];
            }else {
                array_push(
                    $manu[$each["GROUPID"]]["children"]
                    , 
                    [
                        "id" => $each["PROID"],
                        "text" => $each["PRONAME"],
                        "url" => $each["PATH"]
                    ]
                    );
            }
        }
        $manu = array_values($manu);
        return json_encode($manu);
    }
}

