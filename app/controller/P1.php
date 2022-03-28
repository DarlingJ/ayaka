<?php
namespace app\controller;

use app\BaseController;
use think\View;
use app\model\Prodev;

class P1 extends BaseController
{
    protected  function initialize()
    {
        parent::initialize();
        $this->model = new Prodev();
    }
    public function index()
    {
        
        return $this->view->fetch();
    }
    public function search()
    {
        $key = ($this->request->param("key")) ?? "";
        $res = [];
        if($key != "")
        {
            $res = $this->model->queryDbData($key);
        }
        return json_encode($res);
    }
    public function download()
    {
        $data = json_decode($this->request->param("jsondata"),true);
        $key = $this->request->param("key");
        var_dump($data);
        echo "<br/>";
        echo $key;
        exit;
    }
}