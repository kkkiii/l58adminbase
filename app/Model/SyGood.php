<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SyGood extends Model
{
    protected $primaryKey = 'sy_goods_id';

    public function goods_level()
    {
        return $this->hasOne('App\Model\Dict\DictGoodsLevel', 'sy_goods_level','code');
    }

}
