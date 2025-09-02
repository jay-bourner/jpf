<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Models\Prices;
use App\Http\Requests\AdminPricesRequest;

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
            'prices' => $this->prices->getAllPrices(),
            'action_create' => ['action' => route('admin.prices.create')],
            'action_disable' => ['dataset' => 'disable-prices'],
            'action_save' => ['hide' => true],
            'action_cancel' => ['hide' => true],
            'action_delete' => ['dataset' => 'delete-prices'],
        ];

        return view('admin.prices', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $attributes = [
            'title' => 'Create New Price',
            'action' => route('admin.prices.store'),
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'method' => 'POST',
                    'dataset' => 'submit-form'
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
            'method' => 'POST',
            'second_method' => 'PUT',
            'action' => route('admin.prices.update', $id),
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    'dataset' => 'submit-form'
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
    public function store(AdminPricesRequest $request)
    {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        $result = $this->prices->createPrice($data);

        if(isset($result['warning'])) {
            return redirect()->route('admin.prices.create')
                ->withErrors($result['warning']);
        }
        return redirect()->route('admin.prices')
            ->with($result['success']);
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $price = $this->prices->getPriceById($id);

        if(!$price) {
            return redirect()->route('admin.prices')->with('error', 'Class not found.');
        }

        $attributes = [
            'title' => ucwords($price['type']) . ' Price',
            'price' => $price,
            // 'page_actions' => [
            //     [
            //         'label' => 'Edit',
            //         'class' => 'edit jp-btn-gry',
            //         'icon' => 'pencil',
            //         'action' => route('admin.prices.edit', $price['id'])
            //     ],
            //     [
            //         'label' => 'Delete',
            //         'class' => 'delete jp-btn-red',
            //         'icon' => 'trash',
            //         'action' => route('admin.prices.delete', $price['id'])
            //     ]
            // ],
        ];
        return view('admin.price-view', compact('attributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminPricesRequest $request, string $id)
    {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        $result = $this->prices->updatePrice($id, $data);

        if(isset($result['warning'])) {
            return redirect()->route('admin.prices.edit', $id)
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.prices')
            ->with($result['success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
