<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Http\Requests\updateUserRequest;
use App\Organisation;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
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
    public function editRole( $id)
    {
        $user=User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('user.edit_role',compact('user','roles','userRole'));
    }
    public function edit(User $user)
    {
//        $settings=User::all();
//        $roles = Role::pluck('name','name')->all();
//        $userRole = $user->roles->pluck('name','name')->all();
        $cities=Cities::pluck('name','cityId');
        $organisation=Organisation::pluck('name','id');
//        return view('user.edit',compact('user','roles','userRole','cities','organisation'));
        return view('user.edit',compact('user','cities','organisation'));

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

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
    public function updateRole(Request $request,$id){
        $input = $request->all();
        $user = User::find($id);
        if (!isset($input['function'])) {

        } else {
            $function = $input['function'];
        }
        if (isset($function)) {

            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($function);
        }

        return redirect()->route('user.index')
            ->with('success', __('messages.user.update'));


    }

    public function update(updateUserRequest $request, $id)

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
            $firstname = $user->firstname;
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

        if (!isset($input['street'])) {
            $street = $user->street;
        } else {
            $street = $input['street'];
        }
        $user->street = $street;
        if (!isset($input['streetNum'])) {
            $streetNum = $user->streetNum;
        } else {
            $streetNum = $input['streetNum'];
        }
        $user->streetNum = $streetNum;
        if (!isset($input['boxNum'])) {
            $boxNum = $user->boxNum;
        } else {
            $boxNum = $input['boxNum'];
        }
        $user->boxNum = $boxNum;
        if (!isset($input['cityId'])) {
            $cityId = $user->cityId;
        } else {
            $cityId = $input['cityId'];
        }
        $user->cityId = $cityId;
        if (!isset($input['phone'])) {
            $phone= $user->phone;
        } else {
            $phone = $input['phone'];
        }
        $user->phone = $phone;

        if(isset($newpassword)) {
            $password=$newpassword;
            $user->isNew=0;
        }
        else {
            $password=$user->password;
        }
       /* if (!isset($input['organisationId'])) {
            if (isset ($input['organisationAdd'])) {
                $organisation = Organisation::create(['name' => $input['organisationAdd']]);
                $organisationId = $organisation->id;
                echo $organisationId;die();
            }else{
            $organisationId= $user->organisationId;
            }
        } else {
            $organisationId =$input['organisationId'];
        }*/
        if (isset ($input['organisationAdd'])) {
            $organisation = Organisation::create(['name' => $input['organisationAdd']]);
            $organisationId = $organisation->id;
        }elseif (!isset($input['organisationId'])) {
            $organisationId= $user->organisationId;
        }
        else {
        $organisationId =$input['organisationId'];
        }

        $user->organisationId=$organisationId;
        $user->password=$password;
        $user->updated_at=now();
        $user->save();

        return redirect()->route('home')
            ->with('success', __('messages.user.update'));


    }
}
