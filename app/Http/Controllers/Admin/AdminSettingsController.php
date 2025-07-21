<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;

class AdminSettingsController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService) {
        $this->imageService = $imageService;
    }

    public function index() {
        $attributes = [
            'title' => 'Settings',
        ];

        return view('admin.settings', compact('attributes'));
    }
}
