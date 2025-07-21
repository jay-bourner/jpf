<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\Prices;

class AdminPricesController extends Controller
{
    protected $imageService;
    protected $prices;

    public function __construct(ImageService $imageService, Prices $prices) {
        $this->imageService = $imageService;
        $this->prices = $prices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = [
            'title' => 'Prices',
        ];

        return view('admin.prices', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
