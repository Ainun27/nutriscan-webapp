<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('register', [
            'success' => session()->getFlashdata('success'),
            'error'   => session()->getFlashdata('error'),
        ]);
    }

    public function processRegister()
{
    $userModel = new UserModel();

    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    // Cek apakah username sudah ada
    if ($userModel->where('username', $username)->first()) {
        return redirect()->back()->withInput()->with('error', 'Username sudah digunakan.');
    }

    // Cek apakah email sudah ada
    if ($userModel->where('email', $email)->first()) {
        return redirect()->back()->withInput()->with('error', 'Email sudah digunakan.');
    }

    $data = [
        'username' => $username,
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    ];

    $userModel->insert($data);

    return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
}

    public function login()
    {
        return view('login', [
            'success' => session()->getFlashdata('success'),
            'error'   => session()->getFlashdata('error'),
        ]);
    }

    public function processLogin()
    {
        $userModel = new UserModel();

        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $login)->orWhere('email', $login)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Username/email atau password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
