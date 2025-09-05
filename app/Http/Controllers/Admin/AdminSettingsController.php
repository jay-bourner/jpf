<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\User;

class AdminSettingsController extends Controller
{
    protected $imageService;
    protected $user;

    public function __construct(ImageService $imageService, User $user) {
        $this->middleware('auth');
        $this->user = $user->getAdminUser();
        $this->imageService = $imageService;
    }

    public function index() {
        $user = $this->user;
        
        $attributes = [
            'title' => 'Settings',
            'action_create' => ['hide' => true],
            'action_disable' => ['hide' => true],
            'action_save' => ['hide' => true],
            'action_cancel' => ['hide' => true],
            'action_delete' => ['hide' => true],
        ];

        return view('admin.settings', compact('attributes'));
    }
}
