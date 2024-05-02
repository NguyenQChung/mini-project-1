<?php

namespace App\Controllers;

use App\Models\TicketsModel;
use App\Models\UsersModel;

class List_Ticket extends BaseController
{
    public function index()
    {
        $session = session('user');
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!$session) {
            return redirect()->to('login');
        }
        $dataUsers = new UsersModel();
        // Sử dụng model Ticket thay vì model Users
        $ticketModel = new TicketsModel();
        $data['tickets'] = $ticketModel->orderBy('id', 'DESC')->paginate(5, 'group1');
        // dd($data['tickets']);
        $data['pager'] = $ticketModel->pager;
        $data['user'] = $this->user;

        return view('examples/list_Ticket', $data);
    }

}
