<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function product()
    {
        return $this->hasOne('App\Model\Product','id' , 'product_id');
    }
    public function flowstop()
    {
        return $this->hasOne('App\Model\Dict\DictOrdFlowstop','cd' , 'flow_stop');
    }
    public function code_tag_type()
    {
        return $this->hasOne('App\Model\CodeTagType','id' , 'code_type');
    }

}

