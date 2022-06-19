<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    // $users = User::all();
      $users = User::paginate(10);
      return view('users.index',[
          'users'=>$users
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create',[
            'user'=>(new User())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email",
            "password"=>"required|string|min:8|confirmed",
            "role" => "required",
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "date_of_birth" => "required|date",
            "address_1" => "required|string",
            "address_2" => "required|string",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "phone" => "required|string|max:255",
            "mobile" => "required|string|max:255",
          
         ]);
         //Hashing the password
         $validated['password'] = Hash::make($validated['password']);
         
         //Create a new user
         $user = User::create($validated);

         //Pass success message to the session
     session()->flash('success', 'User '. $user->name . ' has been Created successfully');



     //redirect back to index.user page
          return redirect()->route('users.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
         return view('users.show',[
             'user'=>$user
         ]);

          
  

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
   
        return view('users.edit',[
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    
        //validation
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email,{$user->id}",
            "password"=>"nullable|string|min:8|confirmed",
            "role" => "required",
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "date_of_birth" => "required|date",
            "address_1" => "required|string",
            "address_2" => "required|string",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "phone" => "required|string|max:255",
            "mobile" => "required|string|max:255",
          
         ]);

    // changing the password
    if (is_null($validated['password'])) {
        unset($validated['password']);
    } else {
        $validated['password'] = Hash::make($validated['password']);
    }



        //Update user object
     $user->update($validated);

     //Pass success message to the session
     session()->flash('success','User '. $user->name . ' details has been edited successfully');



//redirect back to index.user page
     return redirect()->route('users.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

         //Pass success message to the session
        session()->flash('success','User '. $user->name . ' has been deleted successfully');

        //redirect back to index.user page
     return redirect()->route('users.index');
    }
}
