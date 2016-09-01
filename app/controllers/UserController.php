<?php

class UserController extends BaseController {
	
    public function login()
    {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')),true))
        {
            // $request = Request::create('/', 'GET');
            // return Route::dispatch($request)->getContent();
            return Redirect::to('/');
        } else {
            return Redirect::to('login')
                ->withErrors(array('message' => 'err-invalid-login-credentials'))
                ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        // var_dump(Auth::check());
        return Redirect::route('index');
    }
}
