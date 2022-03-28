<?php
namespace app\controller;

use app\BaseController;
use think\facade\View;
use app\model\BsUser;

class Index extends BaseController
{
    public function index()
    {
//         View::assign("pass",password_hash("admin",PASSWORD_ARGON2I));
//         $test = password_verify("admi", '$argon2i$v=19$m=65536,t=4,p=1$aDBzMlRpSm9xN05qRmZQYw$WuEYbEKN7TL8BPN44YFt+XDpmYz8o8Z0Yuxm/bIK78A')?1:2;
//         $model = new BsUser();
//         $test = $model->queryUser();
//         var_dump($test);exit;
//         View::assign("test",$test);
        return View::fetch("index");
    }

}
