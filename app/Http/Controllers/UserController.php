<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the register page
     *
     * @return \Illuminate\Http\Response
     */
    public function registerPage()
    {
        return view('registerPage');
    }

    /**
     * Display the login page.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginPage()
    {
        return view('loginPage');
    }

    /**
     * Register a newly created account in the users table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(StoreRegisterRequest $request)
    {
        try {
            $data = $request->validated();
         } catch (ValidationException $e) {
             return response()->json($e->errors());
         }
 
         $user = User::create($data);
         $user->save();

         session()->flash('success', 'Account created succesfully!');
         return redirect('/');
    }

        /**
     * Login the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(StoreLoginRequest $request)
    {
        try {
            $data = $request->validated();
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }
        $email = $data['email'];
        $password = $data['password'];
        $user = User::where([
            ['password', '=', $password], ['email', '=', $email]
            ])->first();
            if (empty($user)) {
                dd('This input does NOT match any user in the database');
            }
        dd('input matches with user: ' . $user['name']); 
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
        //
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
    }
}
