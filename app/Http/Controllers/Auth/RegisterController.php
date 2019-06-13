<?php

namespace App\Http\Controllers\Auth;
use App\Cities;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $cities=Cities::pluck('name','cityId');
        return view('auth.register',compact('cities'));
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'firstname' =>['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'between:8,20', 'confirmed'],
            'phone' =>['required','phone:BE'],
            'street'=>['required','string','max:255'],
            'streetNum'=>['required','string'],
            'boxNum'=>['sometimes','nullable','string'],
            'cityId'=>['required','integer'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *associate this user to default role visitor
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user=new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->firstname=$data['firstname'];
        $user->phone=$data['phone'];
        $user->street=$data ['street'];
        $user->streetNum=$data ['streetNum'];
        $user->cityId=$data['cityId'];
        $user->assignRole('visitor');
        $user->save();
        return $user;



    }
}
