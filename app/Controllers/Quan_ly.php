<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Quan_ly extends BaseController
{
    public function index()
    {
        $model = new UsersModel();
        // Biến $user đã được khởi tạo trong constructor của BaseController
        $data['users'] = $model->findAll();
        return view('examples/Quan_Ly', $data);
    }
}


