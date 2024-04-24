<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Biến $user đã được khởi tạo trong constructor của BaseController
        return view('Home', ['user' => $this->user]);
    }
}
