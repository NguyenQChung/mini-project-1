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
        $userModel = new UsersModel();

        // Lấy dữ liệu từ form đăng nhập
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Kiểm tra xác thực
        if ($this->authenticate($email, $password)) {
            // Đăng nhập thành công, kiểm tra vai trò
            $role = $this->checkUserRole($email);

            // Chuyển hướng đến trang chính
            return redirect()->to('/Home');
        } else {
            // Đăng nhập thất bại, hiển thị thông báo lỗi
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->back()->withInput();
        }
    }

    protected function authenticate($email, $password)
    {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $userModel = new UsersModel();
        $user = $userModel->findByEmail($email);

        // Kiểm tra xác thực mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            // Xác thực thành công
            return true;
        } else {
            // Xác thực thất bại
            return false;
        }
    }

    protected function checkUserRole($email)
    {
        // Lấy thông tin người dùng từ cơ sở dữ liệu
        $userModel = new UsersModel();
        $user = $userModel->findByEmail($email);

        // Kiểm tra vai trò của người dùng
        return $user['role']; // Giả sử vai trò được lưu trong cột 'role'
    }

    public function logout()
    {
        // Xóa tất cả các session của người dùng để đăng xuất
        session()->destroy();

        // Chuyển hướng đến trang đăng nhập
        return redirect()->to('/login');
    }
}

