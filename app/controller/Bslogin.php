<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;

class Bslogin extends BaseController
{
    public function index()
    {
        View::assign("title","后台管理");
        View::config(['layout_on' => false]);
        return View::fetch("index");
    }
    public function logincheck()
    {
        $test = "11";
        exit;
    }
}