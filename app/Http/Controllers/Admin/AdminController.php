<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user->getAdminUser();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = [
            'title' => 'Dashboard',
            'action_create' => ['hide' => true],
            'action_disable' => ['hide' => true],
            'action_save' => ['hide' => true],
            'action_cancel' => ['hide' => true],
            'action_delete' => ['hide' => true],
            'user_name' => $this->user['name']
        ];

        return view('admin.index', compact('attributes'));
    }
}
