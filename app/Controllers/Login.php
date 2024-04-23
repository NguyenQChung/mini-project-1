<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{

    public function index()
    {

        return view('examples/login');
    }
    public function do_Login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Xác thực người dùng
        if ($this->auth->attempt($email, $password)) {
            // Đăng nhập thành công, kiểm tra vai trò
            $user = $this->auth->user();

            // Chuyển hướng người dùng đến trang chính
            return redirect()->to('/Home');
        } else {
            // Đăng nhập thất bại, hiển thị thông báo lỗi
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->back()->withInput();
        }
    }

    public function checkRole()
    {
        // Kiểm tra xem người dùng có quyền manager hay không
        if ($this->auth->check() && $this->auth->inGroup('manager')) {
            // Người dùng có vai trò manager
            // Thực hiện các hành động dành riêng cho vai trò manager
        } else {
            // Người dùng không có vai trò manager
            // Thực hiện các hành động khác
        }
    }
}

