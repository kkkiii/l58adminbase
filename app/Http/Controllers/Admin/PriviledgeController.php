<?php

namespace App\Http\Controllers\Admin;
use App\Model\Admin;
use App\Model\AdminRole;
use App\Model\AdminRolesModel;
use App\My\Helpers ;
use App\My\MyAuth;
use App\My\MyStr;
//use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\URL ;
use Illuminate\Support\Facades\DB ;
use Symfony\Component\HttpKernel\Exception\HttpException ;
use Illuminate\Support\Str ;
class PriviledgeController extends AdminBase
{
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['list']
        ]);

    }

    public function list(){
        parent::check_module() ;

//        $url = URL::current() ;
//     $res =   Helpers::str_retrive_left($url , '/') ;
//print_r($res) ; die() ;


//        var_dump($url) ;
//        $pos = strrpos ($url,'/') ;
//        var_dump($pos) ;
//      print_r(  substr($url , $pos) );
//
//        die() ;

        return view('admin.priviledge.list') ;
    }
    public function roles(){
parent::check_module() ;
        $roles = DB::table('admin_roles')->paginate(10);
        return view('admin.priviledge.roles', ['roles' => $roles]);

    }

    public function add_role(){
        parent::check_module() ;

        parent::check_module() ;


        return view('admin.priviledge.add_role');

    }
    public function add_role_post(Request $request){
        parent::check_module() ;
        $data = $this->validate($request,[
            'name'=>'required|min:3',
            'remark'=>'required|min:5',
        ]) ;


        $role =new AdminRolesModel ;
        $role->name =$data['name'] ;
        $role->remark = $data['remark'] ;

        $res = $role->save() ;

        if($res)
        {

            session()->flash(
                'success','添加成功'
            ) ;
            return redirect(route('priviledge.roles')) ;
        }
        else
        {
            session()->flash(
                'success','添加失败'
            ) ;
            return back() ;
        }

    }
    public function modules2role(Request $request,$id)
    {
        parent::check_module() ;
        $sql = <<<EOD
SELECT
modules.id,
modules.`name`,
modules.menus,
modules.routes
FROM
modules
EOD;

        $modules =  DB::select($sql);




        $sql2 = <<<EOD
SELECT
	admin_role_module.admin_role_id,
	admin_role_module.module_id
FROM
	admin_role_module
WHERE
	admin_role_id = $id
EOD;



        $role_selected_moduels =  DB::select($sql2);
        $moduel_ids =[] ;
        foreach ($role_selected_moduels as $item){
         array_push($moduel_ids ,$item->module_id )   ;
        }


//       dd (in_array(2 ,$moduel_ids)) ;

        return view('admin.priviledge.modules2role',compact('modules' ,'id','moduel_ids')) ;

    }
    public function modules2role_post(Request $request)
    {
        parent::check_module() ;
        $options = $request->post() ;

        $rid = $request->post('role_id') ;


        $arr = [] ;

        foreach ($options as $key=>$option)
        {
            if ( strrpos ($key,'opt') !== false)
            {
                $digit_num  = Str::replaceFirst( 'opt' , '' ,$key ) ;
                array_push($arr,['module_id'=>$digit_num,'admin_role_id'=>$rid]) ;
            }
        }

        Helpers::p($arr) ;

        // 删除所有 已有 模块 权限
        $deleted = DB::delete("delete from admin_role_module where admin_role_id = $rid ");


        // 按照新选的 插入
        $inserted = DB::table('admin_role_module')->insert($arr);


        return redirect(route('priviledge.roles')) ;
    }

    public function edit_role($id){

        parent::check_module() ;
        $role = DB::table('admin_roles')->where('id', $id)->first();
        dd($role) ;
        return view('admin.priviledge.edit_role', ['role' => $role]);

    }
    public function edit_role_post(Request $request){
        parent::check_module() ;
//        $roles = DB::table('admin_roles')->paginate(10);
//        return view('admin.priviledge.roles', ['roles' => $roles]);
        $id =$request->input('id');
        $name =$request->input('name');
        var_dump($name) ;
        $remark =$request->input('remark');
        var_dump($remark) ;


        $admin_role = AdminRole::find($id);
        $admin_role->name = $name ;
        $admin_role->remark = $remark ;
        $admin_role->save();
//        $post->title = '测试文章标题';
//        $post->content = '测试文章内容';
//        $post->user_id = 1;
//        $post->save();
        return redirect(route('priviledge.roles'));

    }
    public function del(Request $request,$id){   parent::check_module() ;
        parent::check_module() ;
      $admin_role =  AdminRole::find($id);
        $admin_role->delete();
        return redirect(route('priviledge.roles'));
    }

    public function mgrs()
    {   parent::check_module() ;
        $users = DB::table('admins')->paginate(15);
        return view('admin.priviledge.mgrs',compact('users'))  ;

    }
    public function edit_mgr($id){

        $admin = Admin::find($id);
        return view('admin.priviledge.edit_mgr',compact('admin'))  ;
    }

    public function add_admin(){
        parent::check_module() ;
        parent::check_module() ;
        return view('admin.priviledge.add_admin');

    }

    public function add_admin_post(Request $request){
        parent::check_module() ;
        $data = $this->validate($request,[
            'uname'=>'required|min:5',
            'password'=>'required|min:6',
        ]) ;

        $admin = new Admin($data);
        $admin->password = MyAuth::set_pwd($data['password']) ;
        $admin->save() ;
        return redirect(route('priviledge.mgrs'));
    }

    public function roles2mgrs_fill(Request $request,$id){

        parent::check_module() ;
        $sql = <<<EOD
SELECT
	admin_roles.id,
	admin_roles.`name`,
	admin_roles.`status`,
	admin_roles.remark,
	admin_roles.listorder,
	admin_roles.updated_at,
	admin_roles.created_at,
	admin_role.admin_id
FROM
admin_roles
LEFT JOIN admin_role ON admin_roles.id = admin_role.role_id
WHERE admin_id = $id or ISNULL(admin_id)
order by admin_roles.id
EOD;
        $roles =  DB::select($sql);

        $id = (int)$id ;

        return view('admin.priviledge.roles2mgrs_fill',compact('roles' ,'id')) ;


    }
    public function roles2mgrs_fill_post(Request $request){
        parent::check_module() ;
        $options = $request->post() ;
        $uid = $request->post('uid') ;
        $arr = [] ;

        foreach ($options as $key=>$option)
        {
           if ( strrpos ($key,'opt') !== false)
           {
               $digit_num  = Str::replaceFirst( 'opt' , '' ,$key ) ;
               array_push($arr,['role_id'=>$digit_num,'admin_id'=>$uid]) ;
           }
        }

        $uid =$request->post('uid') ;
//        Helpers::p( $arr) ; dd($arr) ;
        // 删除所有 已有 模块 权限
        $deleted = DB::delete("delete from admin_role where admin_id = $uid ");


        // 按照新选的 插入
        $inserted = DB::table('admin_role')->insert($arr);
//
//
//        DB::table('admin_role')->insert([
//            ['email' => 'taylor@example.com', 'votes' => 0],
//            ['email' => 'dayle@example.com', 'votes' => 0]
//        ]);

//        Helpers::p($deleted) ;
//        Helpers::p( $inserted) ;
        return redirect(route('priviledge.mgrs')) ;

    }


}
