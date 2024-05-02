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
        if ($this->user['role'] === 'manager') {
            // Nếu là manager, lấy tất cả ticket
            $data['tickets'] = $ticketModel->orderBy('id', 'DESC')->paginate(10, 'group1');
        } else {
            // Nếu là employee, chỉ lấy ticket của họ
            $data['tickets'] = $ticketModel->where('user_id', $this->user['id'])->orderBy('id', 'DESC')->paginate(10, 'group1');
        }
        // dd($data['tickets']);
        $data['pager'] = $ticketModel->pager;
        $data['user'] = $this->user;

        return view('examples/list_Ticket', $data);
    }
    public function getSingleTicket($id)
    {
        $this->ticket = new TicketsModel();
        $data = $this->ticket->find($id); // Sử dụng phương thức find() để lấy dữ liệu của user có id tương ứng
        echo json_encode($data);
    }

    public function updateTicket()
    {
        $this->ticketModel = new TicketsModel();
        // Nhận dữ liệu từ biểu mẫu gửi đi
        $ticketId = $this->request->getPost('updateId');
        $title = $this->request->getPost('title');
        $email_manager = $this->request->getPost('email_manager');
        $body = $this->request->getPost('body');
        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        $this->ticketModel->update($ticketId, [
            'title' => $title,
            'email_manager' => $email_manager,
            'body' => $body,
        ]);

        // Chuyển hướng người dùng về trang danh sách người dùng hoặc trang khác
        echo '1';
    }

    public function deleteTicket()
    {
        $this->ticket = new TicketsModel();
        $id = $this->request->getVar('id');
        $this->ticket->delete($id);
        echo 1;
    }
}
