<?php
namespace App\My;
use App\Biz\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\URL ;
class Menu{


    static public function gen_menu(){
        /**
         * 模块过滤 sql
        SELECT
        menus.id,
        menus.parentid,
        menus.title,
        menus.action,
        m2.title AS father_title
        FROM
        menus
        LEFT JOIN menus AS m2 ON menus.parentid = m2.id
        WHERE
        menus.id in (1,2)
        OR
        menus.parentid in (1,2)
         *
         */

        $in_str = implode(',', session('menus_ids') );



        if (empty($in_str))
            $where_clause = "where id in(0)" ;
        else
        $where_clause = " where id in($in_str)" ;


        $sql = <<<EOD
SELECT
menus.id,
menus.parentid,
menus.title,
menus.action
FROM
menus
$where_clause
EOD;
        $tree_nodes = DB::connection()
            ->select($sql);

        $arr = Helpers::objectToArray($tree_nodes) ;
        $resut =  Category::unlimitedForlayer($arr) ;

        foreach ($resut as $item)
        {

            $title =$item['title'];
            $action=$item['action'] ;
            $idstr = $item['id'] ;
            $html2 = '' ;

            if (!empty($item['child'] ))
            {
                $res = static::gen_sub($item['child'])   ;

                $html2 = <<<EOD
            <div class="collapse $res[1]" id="item-$idstr">
                <ul class="nav flex-column ml-3">
                    $res[0]
                </ul>
            </div>
EOD;

            }

            $html = <<<EOD
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#item-$idstr">

                $title
                
            </a>
            $html2
        </li>
EOD;


            echo ($html) ;

        }

    }



    public static function gen_sub($children)
    {
        $show_str ='';

        $des = '' ;

        foreach ($children as $child)
        {
            $title = $child['title']  ;$href = $child['action']  ;

            $url = URL::current() ;
            $left =   MyStr::str_retrive_left($url , '/') ;

            $action_left =   MyStr::str_retrive_left($child['action']  , '/') ;



            if(strpos($url,$child['action']) !== false){
                $show_str = 'show' ;
            }


//            var_dump($left .'|' .$action_left) ;

//            if (strcmp($left,$action_left)== 0)
//            {
//                $show_str = 'show' ;
//            }


            $html = <<<EOD
                    <li class="nav-item">
                        <a class="nav-link" href="$href">$title</a>
                    </li>
EOD;

            $des = $des .  $html ;


        }

        return [$des , $show_str] ;


    }

}

?>