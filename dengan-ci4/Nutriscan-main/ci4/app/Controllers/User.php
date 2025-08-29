<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function profile()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        return view('profile', ['user' => $user]);
    }

    public function editProfile()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('edit_profile', ['user' => $user]);
    }

    public function updateProfile()
{
    $session = session();
    $userId = $session->get('user_id');

    if (!$userId) {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();

    $data = [
        'username' => $this->request->getPost('username'),
        'email'    => $this->request->getPost('email'),
    ];

    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $userModel->update($userId, $data);

    // Set alert dan redirect ke dashboard
    return redirect()->to('/dashboard')->with('success', 'Profil berhasil diperbarui!');
}
}
