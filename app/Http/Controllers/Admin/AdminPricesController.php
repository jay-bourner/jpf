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
            'page_action_create' => route('admin.prices.create'),
            'page_action_delete' => route('admin.prices.delete'),
            'prices' => $this->prices->getAllPrices(),
        ];

        return view('admin.prices', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $attributes = [
            'title' => 'Create New Price',
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'action' => ''
                ],
                [
                    'label' => 'Cancel',
                    'class' => 'cancel jp-btn-red',
                    'icon' => 'x',
                    'action' => route('admin.prices')
                ]
            ],
        ];

        return view('admin.prices-form', compact('attributes'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    
    public function edit($id) {
        $price = $this->prices->getPriceById($id);

        if (!$price) {
            return redirect()->route('admin.prices')->with('error', 'Price not found.');
        }

        $attributes = [
            'title' => 'Edit Price',
            'price' => $price,
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'action' => ''
                ],
                [
                    'label' => 'Cancel',
                    'class' => 'cancel jp-btn-red',
                    'icon' => 'x',
                    'action' => route('admin.prices')
                ]
            ],
        ];
        return view('admin.prices-form', compact('attributes'));
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
