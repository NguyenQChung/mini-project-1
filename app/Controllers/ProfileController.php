<?php

namespace App\Controllers;

use App\Models\UsersModel;

class ProfileController extends BaseController
{
    public function index()
    {
        // Biến $user đã được khởi tạo trong constructor của BaseController
        return view('examples/profile', ['user' => $this->user]);
    }

    public function changePassword()
    {
        $userModel = new UsersModel();
        //lấy id từ session
        $userId = session()->get('updateId');

        //tìm người dùng dựa vào id 
        $user = $userModel->find($userId);
        $password = $this->request->getPost('password');
        $newPassword = $this->request->getPost('matKhauMoi');
        $reNewPassword = $this->request->getPost('nhapLai');

        $response = [];
        if (password_verify($password, $user['password'])) {
            if ($newPassword == $reNewPassword) {
                $hash_password = password_hash($newPassword, PASSWORD_BCRYPT);
                $userModel->update($userId, [
                    'password' => $hash_password,
                ]);

                echo '1';
            } else {

                echo '2';
            }
        } else {
            echo '3';
        }
    }
}