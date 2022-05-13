<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;

class Selfinfo extends BaseController
{
    public function index()
    {
        View::assign("title","自我介绍");
        View::config(['layout_on' => false]);
        return View::fetch("index");
    }
}