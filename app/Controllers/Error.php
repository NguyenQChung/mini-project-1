<?php

namespace App\Controllers;

class Error extends BaseController
{
    public function index()
    {
        // Biến $user đã được khởi tạo trong constructor của BaseController
        return view('Error');
    }
}
