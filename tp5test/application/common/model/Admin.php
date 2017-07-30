<?php
namespace app\common\model;

use think\Model;

class Admin extends Model
{
    public function getAdmin(){
        return $this->paginate(5)->toArray();
    }
}