<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/1
 * Time: 17:18
 */

namespace App\Vo;


class CodeGenVo {
    public  $howmany  ;
    public  $table_name  ;
    public  $company_id  ;
    public  $product_id  ;
    public  $order_id ;

    function __construct($howmany,$company_id,$product_id ,$order_id,$table_name)
    {
        $this->howmany = $howmany ;
        $this->company_id = $company_id ;
        $this->product_id = $product_id ;
        $this->order_id = $order_id ;
        $this->table_name = $table_name ;
    }
}