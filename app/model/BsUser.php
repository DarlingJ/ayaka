<?php
namespace app\model;

use think\facade\Db;

class BsUser 
{
    public function getManu($userid)
    {
        $sql = "SELECT 
                        bur.PROID,bpg.PRONAME,
                        bpg.GROUPID,bpg.PATH,bpn.GROUPNAME 
                    FROM BS_USERROLE bur
                        LEFT JOIN BS_PROGRAM bpg ON bur.PROID = bpg.PROID
                        LEFT JOIN BS_PRONAME bpn ON bpg.GROUPID = bpn.GROUPID
                    WHERE bur.USERID = :USERID";    
        $params = [
           "USERID" => $userid 
        ];
        $res = Db::query($sql,$params);
        return $res;
    }
}