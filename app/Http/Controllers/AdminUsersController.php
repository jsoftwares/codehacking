<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

use App\Http\Requests;
use App\User;
use App\Role;
use App\Photo;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //We create an array of roles that we display in our create form using list() method
        //the array returns role name & field a we will use in the select option content & value attribute
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        //We check if password field is empty so as not to include it in the post request
        if (trim($request->password == '')) {
            $input = $request->except('password');
        }else {
            $input = $request->all();
        }
        //If in the form post request, there is value for a file element with name 'photo' then
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id; //after putting file in photos table, we set its value in the form post request
        }
        //If no photo was attacahed, then
        $input['password'] = bcrypt($request->password);
        User::create($input);
        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);

        //We check if password field is empty so as not to include it in the post request
        if (trim(!$request->has('password'))) {
            $input = $request->except('password');
        }else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            if ($user->photo_id != null) {
                $photo = $user->photo()->update(['file'=>$name]);
                $input['photo_id'] = $user->photo->id;
            }else {
                $photo = Photo::create(['file'=>$name]);
                $input['photo_id'] = $photo->id;
            }
            
        }
        
        // $input['password'] = bcrypt($request->password);
         $user->update($input);
         return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        unlink(public_path() . $user->photo->file);
        $user->photo->delete();
        $user->delete();
        Session::flash('deleted_user', 'User Deleted!');
        return redirect('admin/users');
    }
}
