<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User as ModelsUser;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserController extends Controller
{



public function index(Request $request)
{
$data = ModelsUser::orderBy('id','DESC')->paginate(5);
return view('users.index',compact('data'))
->with('i', ($request->input('page', 1) - 1) * 5);
}

public function create()
{
$roles = Role::pluck('name','name')->all();
return view('users.create',compact('roles'));
}

public function store(Request $request)
{
$this->validate($request, [
'name' => 'required',
'email' => 'required|email|unique:users,email',
'password' => 'required|same:confirm-password',
'roles' => 'required'
]);
$input = $request->all();
$input['password'] = Hash::make($input['password']);
$user = ModelsUser::create($input);
$user->assignRole($request->input('roles'));
return redirect()->route('users')
->with('success','User created successfully');
}


public function show($id)
{
$user = ModelsUser::find($id);
return view('users.show',compact('user'));
}


public function edit($id)
{
$user = ModelsUser::find($id);
$roles = Role::pluck('name','name')->all();
$userRole = $user->roles->pluck('name','name')->all();
return view('users.edit',compact('user','roles','userRole'));
}


public function update(Request $request, $id)
{
$this->validate($request, [
'name' => 'required',
'email' => 'required|email|unique:users,email,'.$id,
'password' => 'same:confirm-password',
'roles' => 'required'
]);
$input = $request->all();
if(!empty($input['password'])){
$input['password'] = Hash::make($input['password']);
}else{
$input = array_except($input,array('password'));
}
$user = ModelsUser::find($id);
$user->update($input);
DB::table('model_has_roles')->where('model_id',$id)->delete();
$user->assignRole($request->input('roles'));
return redirect()->route('users')
->with('success','User updated successfully');
}

public function destroy($id)
{
    ModelsUser::find($id)->delete();
return redirect()->route('users')
->with('success','User deleted successfully');
}

public function show_user_article()
{
$users = ModelsUser::all();
foreach($users as $user)
{
    $articles=Article::where('user_id',$user->id)->select('name','detail')->get();
    $user['article'] = $articles;
}
return response()->json([
    'users' => $users
],200);
}

}
