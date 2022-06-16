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
    /**
     * 没有备份的后果
     */
    public function download()
    {
        $data = json_decode($this->request->param("jsondata"),true);
        $key = $this->request->param("key");
        //为生成的VO先命名
        $fileName = $key."VO";
        $constructTxt = '
class '.$fileName.'{
	function __construct($value = null) {
		if ($value) {
';
        $otherTxt = "";
        foreach ($data as $eachData)
        {
        	$constructTxt .= '
			$this->'.$eachData["COLUMN_NAME"].' = trim ( $value ["'.$eachData["COLUMN_NAME"].'"] ) ?? "";';
        	$otherTxt .= '	
	/**
	 * '.$eachData["COLUMN_COMMENT"].'
	 *
	 * @var '.$eachData["COLUMN_TYPE"].'
	 */
	public $'.$eachData["COLUMN_NAME"].';
';
        }
        $voTxt = <<<EOF
<?php
$constructTxt
		}
	}
$otherTxt
}
?>
EOF;
        $fn = $fileName.".php";
        !$handle = fopen($fn, 'w');
        fwrite($handle, $voTxt);
        fclose($handle);
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Length: ". filesize($fn).";");
        header("Content-Disposition: attachment; filename=$fn");
        header("Content-Type: application/octet-stream; ");
        header("Content-Transfer-Encoding: binary");
        @unlink($fn);
        exit;
    }
}