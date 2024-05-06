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
        // Sử dụng model Ticket thay vì model Users
        $ticketModel = new TicketsModel();

        $searchTerm = $this->request->getGet('q');

        if ($this->user['role'] === 'manager') {
            if (!empty($searchTerm)) {
                // Thực hiện tìm kiếm với điều kiện tên người dùng chứa từ khóa tìm kiếm
                $data['tickets'] = $ticketModel->like('title', $searchTerm)->orderBy('id', 'DESC')->paginate(10, 'group1');
            } else {
                // Nếu không có từ khóa tìm kiếm, lấy tất cả người dùng
                $data['tickets'] = $ticketModel->orderBy('id', 'DESC')->paginate(10, 'group1');
            }
        } else {
            // Nếu là employee, chỉ lấy ticket của họ
            $data['tickets'] = $ticketModel->where('user_id', $this->user['id'])->orderBy('id', 'DESC')->paginate(10, 'group1');
        }
        // dd($data['tickets']);
        $data['pager'] = $ticketModel->pager;
        $data['user'] = $this->user;
        $data['readOnly'] = ($this->user['role'] === 'manager') ? 'readonly' : ''; // Xác định trường hợp chỉ đọc

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
        $status = $this->request->getPost('status');
        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        if ($this->user['role'] === 'manager') {
            // Nếu là manager, chỉ cập nhật trạng thái của ticket
            $this->ticketModel->update($ticketId, [
                'status' => $status,
            ]);

        } else {
            // Nếu không phải manager, cập nhật tất cả các trường
            $title = $this->request->getPost('title');
            $email_manager = $this->request->getPost('email_manager');
            $body = $this->request->getPost('body');
            // Cập nhật thông tin của ticket
            $this->ticketModel->update($ticketId, [
                'title' => $title,
                'email_manager' => $email_manager,
                'body' => $body,
            ]);

        }
        echo '1';
    }

    public function updateStatus()
    {
        $this->ticketModel = new TicketsModel();
        // Nhận dữ liệu từ biểu mẫu gửi đi
        $ticketId = $this->request->getPost('updateId');
        $status = $this->request->getPost('status');
        // Cập nhật thông tin người dùng trong cơ sở dữ liệu
        $this->ticketModel->update($ticketId, [
            'status' => $status,
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
