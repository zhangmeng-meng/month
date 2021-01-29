<?php

namespace app\goods\model;

use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
    //
    protected $resultSetType = 'collection';
    use SoftDelete;
    protected $deleteTime = 'delete_time';
}
