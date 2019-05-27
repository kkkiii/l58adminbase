<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/14
 * Time: 17:12
 */

namespace App\Biz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB ;
use App\My\Helpers ;
use App\My\Category ;
use App\Model\Org as OrgModel ;
class TemplateBiz
{

    static public function qlist($company_code)
    {
        $sql = <<<EOD
SELECT
	code_views.id,
	code_views.title,
	code_views.content,
	code_views.updated_at,
	code_views.created_at,
	code_views.is_edit,
	company_user_template.company_user_id
FROM
	code_views
INNER JOIN company_user_template ON company_user_template.template_id = code_views.id
WHERE
	company_user_id = $company_code
EOD;

        $res = DB::connection()
            ->select($sql);

      return $res ;

    }
    static public function qitem($templateid)
    {
        $sql = <<<EOD
SELECT
code_views.id,
code_views.title,
code_views.content,
code_views.updated_at,
code_views.created_at,
code_views.is_edit
FROM
code_views
WHERE
id = $templateid
EOD;

        $res = DB::connection()
            ->select($sql);
        $res =  collect($res)->first();

        return $res ;

    }
    static public function q_company_cd($templateid)
    {
        $sql = <<<EOD
SELECT
company_user_template.company_user_id,
company_user_template.template_id
FROM
company_user_template
WHERE
template_id =  $templateid
EOD;

        $res = DB::connection()
            ->select($sql);


        $res =  collect($res)->first();
        dd($res) ;
    }


}