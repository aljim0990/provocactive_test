<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Voucher;
use Validator;
use Hash;
class AdminController extends Controller
{
    public function index()
    {

        return view('pages.admins.index');
        
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
     
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            'password'=>bcrypt($request->input('password'))
        ]);

        $user->save();
        return response()->json('User created!');
    }
    public function update($id, Request $request)
    {
        $user = User::find($id);
       
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name,'.$user->id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
       

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        if (Hash::needsRehash($request->input('password')))
        {
            $user->password=bcrypt($request->input('password'));
           
        }    
        $user->role=$request->input('role');
        $user->save();
        return response()->json('User updated!');
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json('User deleted!');
    }
    public function users()
    {
        $users = User::all();
        return response()->json($users);
    }

  
}
