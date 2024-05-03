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
                $newTicket = $ticketModel->where('id', $result)->first();
                $createdAt = $newTicket['created_at'];
                $createdAtFormatted = date('d/m/Y', strtotime($createdAt));
                $userName = $session['name'];
                $email = \Config\Services::email();
                $email->setTo($emailManager);
                $email->setFrom('ST@gmail.com', 'Quang Chung');
                $email->setSubject('Xử lý phiếu yêu cầu');
                $email->setMessage($userName . ' đã tạo phiếu yêu cầu vào ngày ' . $createdAtFormatted . '.');

                $email->send();
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
