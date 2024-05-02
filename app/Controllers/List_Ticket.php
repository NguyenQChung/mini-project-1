<?php

namespace App\Controllers;

class List_Ticket extends BaseController
{
    public function index()
    {
        // Biến $user đã được khởi tạo trong constructor của BaseController
        return view('examples/list_Ticket', ['user' => $this->user]);
    }
}
