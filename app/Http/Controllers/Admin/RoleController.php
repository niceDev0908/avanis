<?php
    
namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Yajra\DataTables\DataTables;
use Session;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store','data']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('admin.roles.index');
      // return view('admin.roles.index',compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function data(){
        $tables = Role::get(['id','name']);
        return DataTables::of($tables)->addColumn('action',function($tables){
                $icon = '<a class="btn btn-primary" title="Edit" href="roles/'.$tables->id.'/edit"><i class="fas fa-edit" aria-hidden="true"></i></a> &nbsp;&nbsp;'; 
                $icon .= '<a class="btn btn-dark delete_record" title="Delete" id="del_role" href="javascript:;" data-id="'.$tables->id.'"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>';
                return $icon;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        die;
        return view('admin.roles.show',compact('role','rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('admin.roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    
    public function destroy($id)
    {
        $data = Role::find($id);
        $response = $data->delete();
        if ($response) {
            Session::flash('success', 'Role deleted successfully.');
            $success = 1;
        } else {
            Session::flash('danger', 'Error in deleting Role. Please try again.');
            $success = 0;
        }

        $return['success'] = $success;
        return response()->json($return);
    }
}