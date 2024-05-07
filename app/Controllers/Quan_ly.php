<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Quan_ly extends BaseController
{

    public function index()
    {
        // dd($this->user);
        $session = session('user');
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!$session) {
            return redirect()->to('login');
        }
        if ($this->user['role'] !== 'manager') {
            return view('Home', ['user' => $this->user]);
        }
        $dataUsers = new UsersModel();

        $searchTerm = $this->request->getGet('h');

        if (!empty($searchTerm)) {
            // Thực hiện tìm kiếm với điều kiện tên người dùng chứa từ khóa tìm kiếm
            $data['users'] = $dataUsers->where('role', 'employee')->like('name', $searchTerm)->orderBy('id', 'DESC')->paginate(10, 'group1');
        } else {
            // Nếu không có từ khóa tìm kiếm, lấy tất cả người dùng
            $data['users'] = $dataUsers->where('role', 'employee')->orderBy('id', 'DESC')->paginate(10, 'group1');
        }
        $data['pager'] = $dataUsers->pager;
        $data['user'] = $this->user;

        return view('examples/Quan_Ly', $data);
    }

    public function index1()
    {
        // dd($this->user);
        // $session = session('user');
        // // Kiểm tra xem người dùng đã đăng nhập chưa
        // if (!$session) {
        //     return redirect()->to('login');
        // }
        // if ($this->user['role'] !== 'manager') {
        //     return view('Home', ['user' => $this->user]);
        // }
        $dataUsers = new UsersModel();

        $searchTerm = $this->request->getGet('h');

        if (!empty($searchTerm)) {
            // Thực hiện tìm kiếm với điều kiện tên người dùng chứa từ khóa tìm kiếm
            $data['users'] = $dataUsers->like('name', $searchTerm)->orderBy('id', 'DESC')->paginate(10, 'group1');
        } else {
            // Nếu không có từ khóa tìm kiếm, lấy tất cả người dùng
            $data['users'] = $dataUsers->orderBy('id', 'DESC')->paginate(10, 'group1');
        }
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
                echo '1';
            } else {
                // Xử lý lỗi khi di chuyển tệp
                session()->setFlashdata('error', 'Failed to upload file');

            }
        } else {
            // Xử lý khi không có tệp được tải lên
            session()->setFlashdata('error', 'No file uploaded');

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
        echo '1';
    }

    public function deleteUser()
    {
        $this->user = new UsersModel();
        $id = $this->request->getVar('id');
        $this->user->delete($id);
        echo 1;
    }
    public function resetPassword()
    {
        $this->user = new UsersModel();
        $id = $this->request->getVar('id');
        $password = 'Nhanvien123';
        $password = password_hash($password, PASSWORD_BCRYPT);
        $userModel = new UsersModel();
        $userModel->update($id, ['password' => $password]);
        echo 1;
    }

}

