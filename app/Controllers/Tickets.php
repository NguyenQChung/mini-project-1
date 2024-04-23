<?php

namespace App\Controllers;

class Tickets extends BaseController
{
    public function index(): string
    {
        return view('examples/tickets');
    }
}
