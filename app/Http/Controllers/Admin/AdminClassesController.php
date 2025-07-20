<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;

class AdminClassesController extends Controller
{
    private $data = array(
        'footer_class' => 'admin-footer'
    );

    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('admin.classes', ['data' => $this->data]);
    }

    public function create() {
        return view('admin.classes-form', ['data' => $this->data]);
    }
}
