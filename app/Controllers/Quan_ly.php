<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Quan_ly extends BaseController
{

    public function index()
    {
        $dataUsers = new UsersModel();
        $data['users'] = $dataUsers->orderBy('id', 'DESC')->paginate(5, 'gruop1');
        $data['pager'] = $dataUsers->pager;
        $data['user'] = $this->user;

        return view('examples/Quan_Ly', $data);
    }
    public function saveUser()
    {
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $password = 'Nhanvien123';
        $password = password_hash($password, PASSWORD_BCRYPT);
        $role = $this->request->getVar('role');

        $file = $this->request->getFile('avatar');
        if ($file && !$file->hasMoved()) {
            // Xác định thư mục đích để lưu file
            $destination = FCPATH . 'uploads/';

            // Di chuyển file đến thư mục đích
            if ($file->isValid() && $file->move($destination)) {
                // Lấy tên file đã di chuyển
                $filename = $file->getName();

                // Lưu thông tin người dùng vào cơ sở dữ liệu
                $userModel = new UsersModel();
                $userModel->save([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'role' => $role,
                    'avatar' => $filename // Lưu tên file ảnh đại diện vào cơ sở dữ liệu
                ]);

                session()->setFlashdata('success', 'Data inserted successfully');
                return redirect()->to(base_url('quanly'));
            } else {
                // Xử lý lỗi khi di chuyển tệp
                session()->setFlashdata('error', 'Failed to upload file');
                return redirect()->to(base_url('quanly'));
            }
        } else {
            // Xử lý khi không có tệp được tải lên
            session()->setFlashdata('error', 'No file uploaded');
            return redirect()->to(base_url('quanly'));
        }
    }

    public function getSingleUser($id)
    {
        $this->user = new UsersModel();
        $data = $this->user->find($id); // Sử dụng phương thức find() để lấy dữ liệu của user có id tương ứng
        echo json_encode($data);
    }
}
