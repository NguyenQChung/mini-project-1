<?php

namespace App\Controllers;

use App\Models\TicketsModel;


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

    public function do_create()
    {
        $session = session('user');
        $ticketModel = new TicketsModel();
        $title = $this->request->getPost('inputTitle');
        $message = $this->request->getPost('inputMessage');
        $emailManager = $this->request->getPost('inputEmailManager');
        $status = $this->request->getPost('status');

        $data = ['title' => $title, 'body' => $message, 'user_id' => $session['id'], 'email_manager' => $emailManager, 'status' => $status];

        // Thử chèn dữ liệu vào cơ sở dữ liệu
        try {
            $result = $ticketModel->insert($data);

            if ($result) {
                // Phản hồi thành công
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Đăng ký thành công!'
                ])->setStatusCode(200);
            } else {
                // Phản hồi thất bại
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Đăng ký thất bại!'
                ])->setStatusCode(400);
            }
        } catch (\Exception $e) {
            // Xử lý lỗi bất ngờ
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
