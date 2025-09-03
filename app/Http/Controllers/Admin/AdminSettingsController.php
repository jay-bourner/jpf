<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;

class AdminSettingsController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService) {
        $this->middleware('auth');
        $this->imageService = $imageService;
    }

    public function index() {
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
