<?php

namespace App\Http\Controllers\Admin;

use App\Biz\Area;
use App\Biz\Org;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\My\Helpers;
use App\My\Category;
use App\Model\Org as OrgModel;

class GovMgrController extends AdminBase
{
    public function user_list()
    {
        parent::check_module();
        return view('admin.govmgr.user_list');
    }

    public function org_list()
    {
        parent::check_module();
        $res = Org::build_tree();

        return view('admin.govmgr.org_list', compact('res'));
    }

    public function org_list_del(Request $request, $id)
    {
        parent::check_module();

        OrgModel::find($id)->delete();
        $res = Org::build_tree();
        return view('admin.govmgr.org_list', compact('res'));
    }

    public function org_list_edit(Request $request, $id)
    {
        parent::check_module() ;
        $org = OrgModel::find($id);

        $provinces = DB::table('dict_provinces')->pluck("name", "code");

        return view('admin.govmgr.org_list_edit', compact('provinces', 'org'));
    }

    public function org_list_edit_post(Request $request)
    {
        parent::check_module() ;
        $org = \App\Model\Org::find($request->post('id'));
        $org->org_name = $request->post('org_name');
        $org->province_id = $request->post('province');
        $org->province = Area::q_name($request->post('province'), 'dict_provinces')[0]->name;
        $org->city_id = $request->post('city');
        $org->city = Area::q_name($request->post('city'), 'dict_cities')[0]->name;
        $org->district_id = $request->post('district');
        $org->district = Area::q_name($request->post('district'), 'dict_areas')[0]->name;
        $org->save();
        $res = Org::build_tree();
        return view('admin.govmgr.org_list', compact('res'));

    }
    public function org_list_sub(Request $request, $id)
    {
        parent::check_module() ;
        $org = OrgModel::find($id);

        $provinces = DB::table('dict_provinces')->pluck("name", "code");

        return view('admin.govmgr.org_list_sub', compact('provinces', 'org'));
    }
    public function org_list_sub_post(Request $request)
    {
        parent::check_module() ;
        $org =new \App\Model\Org();
        $org->org_name = $request->post('org_name');
        $org->province_id = $request->post('province');
        $org->province = Area::q_name($request->post('province'), 'dict_provinces')[0]->name;
        $org->city_id = $request->post('city');
        $org->city = Area::q_name($request->post('city'), 'dict_cities')[0]->name;
        $org->district_id = $request->post('district');
        $org->district = Area::q_name($request->post('district'), 'dict_areas')[0]->name;

        $org->parentid = $request->post('id');

        $org->save();
        $res = Org::build_tree();
        return view('admin.govmgr.org_list', compact('res'));

    }
    public function org_list_root(Request $request)
    {
        parent::check_module() ;

        $provinces = DB::table('dict_provinces')->pluck("name", "code");

        return view('admin.govmgr.org_list_root', compact('provinces', 'org'));
    }
    public function org_list_root_post(Request $request)
    {
                parent::check_module() ;
        $org =new \App\Model\Org();
        $org->org_name = $request->post('org_name');
        $org->province_id = $request->post('province');
        $org->province = Area::q_name($request->post('province'), 'dict_provinces')[0]->name;
        $org->city_id = $request->post('city');
        $org->city = Area::q_name($request->post('city'), 'dict_cities')[0]->name;
        $org->district_id = $request->post('district');
        $org->district = Area::q_name($request->post('district'), 'dict_areas')[0]->name;

        $org->save();
        $res = Org::build_tree();
        return view('admin.govmgr.org_list', compact('res'));
    }

}
