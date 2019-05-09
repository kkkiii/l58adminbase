<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function wst_company()
    {
        return $this->hasOne('App\Model\WST\YqCompany','id' , 'wst_company_id');
    }
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

    public function tot_howmany()
    {
//        VOrderDetailSum
        return $this->hasOne('App\Model\VOrderDetailSum','ordid' , 'id');
    }


}

