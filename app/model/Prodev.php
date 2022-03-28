<?php
namespace app\model;

use think\facade\Db;

class Prodev
{
    public function queryDbData($key)
    {
        $sql = "SELECT 
                        c.COLUMN_NAME,c.COLUMN_TYPE,c.COLUMN_COMMENT
                    FROM information_schema.columns AS c
                        WHERE table_name = :KEY
                    ORDER BY ORDINAL_POSITION ";
        $params = ["KEY" => $key];
        return Db::query($sql,$params);
    }
}

