<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Session\Session;

class Login extends BaseController
{
    protected $session;

    public function __construct()
    {
        // Khởi tạo đối tượng Session
        $this->session = session();
    }

    public function index()
    {

        return view('examples/login');
    }
    public function do_Login()
    {
        $rules = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);
        if (!$rules) {
            return view('examples/login', ['rules' => $this->validator]);
        } else {
            $userModel = new UsersModel();

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if ($email && $password) {
                // Tìm người dùng dựa trên email
                $result = $userModel->where('email', $email)->first();

                if ($result) {
                    // So sánh mật khẩu
                    if (password_verify($password, $result['password'])) {
                        // Khởi tạo session
                        $this->session->set('user', $result);
                        // Lấy ID của người dùng từ đối tượng $result
                        $userId = $result['id'];
                        session()->set('updateId', $userId);
                        session()->set('logged_in', true);
                        return redirect()->to('/Home');
                    } else {
                        // Lưu thông báo lỗi vào biến data
                        $data['loginError'] = 'Sai mật khẩu!';
                        // Trả về view login cùng với thông báo lỗi
                        return view('examples/login', $data);
                    }
                } else {
                    // Lưu thông báo lỗi vào biến data
                    $data['loginError'] = 'Tài khoản không tồn tại !';
                    // Trả về view login cùng với thông báo lỗi
                    return view('examples/login', $data);
                }
            }
        }
    }

    public function logout()
    {
        // Xóa tất cả các session của người dùng để đăng xuất
        session()->destroy();

        // Chuyển hướng đến trang đăng nhập
        return redirect()->to('/login');
    }
}

