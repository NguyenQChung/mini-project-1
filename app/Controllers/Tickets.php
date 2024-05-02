<?php

namespace App\Controllers;


class Tickets extends BaseController
{
    public function index()
    {
        $session = session('user');
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!$session) {
            return redirect()->to('login');
        }
        return view('examples/tickets', ['user' => $this->user]);
    }
}
