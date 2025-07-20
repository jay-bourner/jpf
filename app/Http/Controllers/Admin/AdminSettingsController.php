<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    private $data = array(
        'footer_class' => 'admin-footer'
    );

    public function index() {
        return view('admin.settings', ['data' => $this->data]);
    }
}
