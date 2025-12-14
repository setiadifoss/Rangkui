<?php

namespace App\Modules\Login\Controllers;

use App\Controllers\BaseController;
use App\Modules\Login\Models\LoginModel;


class Login extends BaseController
{

    public function index()
    {
        if ($this->session->has('user_id')) {
            return redirect()->to('home')->with('message', 'Yo was logged in');
        }
        $css   = [];
        $js    = [];
        $view  = "login";
        $title = "DIFOSS";

        $content['data'] = [];
        _renderLogin($view, $title, $content, $js, $css);
    }
    public function login()
    {
        if ($this->session->has('user_id')) {
            return redirect()->to('home')->with('message', 'Yo was logged in');
        }
        $validation = \Config\Services::validation();

        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$this->validate($validation->getRules())) {
            return view('App\Modules\Login\Views\login', [
                'validation' => $this->validator
            ]);
        }
        $username = $this->request->getPost('username');
        $password = trim($this->request->getPost('password'));

        $userModel = new LoginModel();
        $user      = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['passwd'])) {
            session()->set('user_id', $user['user_id']); // Simpan hanya ID atau informasi minimal
            session()->set('groups', unserialize($user['groups'])[0]);
            session()->set('name', $user['realname']);
            session()->set('user_type', $user['user_type']);
            return redirect()->to('/home')->with('message', 'Login successful!');
        }

        return redirect()->back()->with('error', 'Invalid username or password');
        // return view('App\Modules\Login\Views\login', ['error' => 'Invalid username or password']);
    }
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }
}
