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

    public function updateUser()
    {
        $this->userModel = new UsersModel();
        // Nhận dữ liệu từ biểu mẫu gửi đi
        $userId = $this->request->getPost('updateId');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');

        // Kiểm tra xem người dùng có tải lên ảnh mới không
        $newAvatar = $this->request->getFile('avatar');
        if ($newAvatar->isValid() && !$newAvatar->hasMoved()) {
            // Lưu ảnh mới và lấy tên file
            $avatarName = $newAvatar->getRandomName();
            $newAvatar->move(ROOTPATH . 'public/uploads', $avatarName);

            // Cập nhật thông tin người dùng trong cơ sở dữ liệu
            $this->userModel->update($userId, [
                'name' => $name,
                'email' => $email,
                'avatar' => $avatarName,
                'role' => $role
            ]);
        } else {
            // Không có ảnh mới được tải lên, chỉ cập nhật các thông tin khác
            $this->userModel->update($userId, [
                'name' => $name,
                'email' => $email,
                'role' => $role
            ]);
        }

        // Chuyển hướng người dùng về trang danh sách người dùng hoặc trang khác
        return redirect()->to(base_url('quanly'));
    }

    public function deleteUser()
    {
        $this->user = new UsersModel();
        $id = $this->request->getVar('id');
        $this->user->delete($id);
        echo 1;

    }
}

