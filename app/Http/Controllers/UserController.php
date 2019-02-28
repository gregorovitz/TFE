<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        $id=Auth::id();
        return view('user.view',compact('data','id'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function edit(User $user)
    {
        $settings=User::all();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('user.edit',compact('user','roles','userRole'));
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show',compact('user'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getHome(){
        return view('/');
    }
    public function update(Request $request, $id)

    {


        $input = $request->all();

        if (!auth()->user()->hasRole('admin')) {
            if (!empty($input['password'])) {
                if ($input['password']===$input['confirm-password']) {
                    $newpassword = Hash::make($input['password']);
                }
            } else {
                $input = array_except($input, array('password'));
            }
        }


        $user = User::find($id);
        if (!isset($input['name'])) {
            $name = $user->name;
        } else {
            $name = $input['name'];
        }
        $user->name = $name;
        if (!isset($input['firstname'])) {
            $firstname = $user->name;
        } else {
            $firstname = $input['firstname'];
        }
        $user->firstname = $firstname;
        if (!isset($input['email'])) {
            $email = $user->email;
        } else {
            $email = $input['email'];
        }
        $user->email = $email;
        if (!isset($input['function'])) {
            $function = $user->function;
        } else {
            $function = $input['function'];
        }


        if(isset($newpassword)) {
            $password=$newpassword;
            $user->isNew=0;
        }
        else {
            $password=$user->password;
        }
        $user->password=$password;
        $user->save();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($function);

        return redirect()->route('home')
            ->with('success', __('messages.user.update'));


    }
}
