<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{

    function __construct()
    {
            $this->middleware('auth');
//        $this->middleware('permission:role-list');
//        $this->middleware('permission:role-create', ['only' => ['create','store']]);
//        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index(Request $request)
    {
        $permissions = Permission::orderBy('id','DESC')->paginate(10);
        return view('Permission.view',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }*/

   public function index (Request $request){
       $permissions = Permission::all();
       return view('permission.view1',compact('permissions'));
   }
   public function getPermission(){
       return DataTables::of(Permission::query())
           //permet l'ajout de class pour chaque ligne du dataTable
           // si paire rajoute text-succes (text en vert) si impaire rajoute text-danger (text en rouge)
           ->setRowClass(function($permission){
               return $permission->id %2==0?'text-success':'text-danger';
           })
           //permet l'ajout d'un id pour chaque ligne
           //rajoute comme id l'id de la permission
           ->setRowId (function($permission){
               return $permission->id;
           })
           //permet d'ajoutté un attribu a chaque ligne du dataTable
           // align le text  au centre dans les lignes du da tatable
           ->setRowAttr(['align'=>'center'])
            // permet l'ajout d'une column
           ->addColumn('name_view', function(Permission $permission){
               return __($permission->name);
            })
           ->make(true);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',

        ]);


        $permission = Permission::create(['name' => $request->input('name')]);



        return redirect()->route('permissions.index',['lang'=>session('applocale')])
            ->with('success',__('messages.permission.create'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);



        return view('permission.edit',compact('permission'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'Rule::unique(\'permissions\')->ignore($this->permissions)]',
        ]);


        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->save();

        return redirect()->route('permissions.index',['lang'=>session('applocale')])
            ->with('success',__('messages.permission.updates'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang,$id)
    {
        DB::table("permission")->where('id',$id)->delete();
        return redirect()->route('permissions.index',['lang'=>session('applocale')])
            ->with('success',__('messages.permission.delete'));
    }


}
