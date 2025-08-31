<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoriesRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    protected $categories;

    public function __construct(Categories $categories) {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->getAllCategories();

        $attributes = [
            'title' => 'Categories',
            'page_action_create' => route('admin.categories.create'),
            // 'page_action_disable' => 'disable-categories',
            // 'page_action_delete' => route('admin.categories.delete'),
            'categories' => $categories,
        ];
        return view('admin.categories', compact('attributes'));
    }

    public function create() {
        $attributes = [
            'title' => 'Create New Category',
            'action' => route('admin.categories.store'),
            'method' => 'POST',
            'page_actions' => [
                [
                    'label' => 'Save',
                    'class' => 'save jp-btn-gry',
                    'icon' => 'save',
                    // 'action' => ''
                    'dataset' => 'submit-form'
                ],
                [
                    'label' => 'Cancel',
                    'class' => 'cancel jp-btn-red',
                    'icon' => 'x',
                    'action' => route('admin.categories')
                ]
            ],
        ];

        return view('admin.categories-form', compact('attributes'));
    }

    public function edit($id) {
        $category = $this->categories->getCategoryById($id);

        $attributes = [
            'title' => 'Edit Category',
            'category' => $category,
            'method' => 'POST',
            'second_method' => 'PUT',
            'action' => route('admin.categories.update', $id),
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
                    'action' => route('admin.categories')
                ]
            ],
        ];

        return view('admin.categories-form', compact('attributes'));
    }

    public function store(AdminCategoriesRequest $request) {
        $inputs = $request->validated();


        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token']);

        if($data['image']) {
            $filename = $data['image']->getClientOriginalName();
            $data['image']->move('image/uploads', $filename);
            $data['image'] = '/image/uploads/' . $filename;
        }

        $result = $this->categories->createCategory($data);

        if (isset($result['warning'])) {
            return redirect()->route('admin.categories.create')
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully!');
    }

    public function view($id) {
        $category = $this->categories->getCategoryById($id);

        $attributes = [
            'title' => ucwords($category['name']),
            'category' => $category,
            // 'page_actions' => [
            //     [
            //         'label' => 'Save',
            //         'class' => 'save jp-btn-gry',
            //         'icon' => 'save',
            //         'action' => ''
            //     ],
            //     [
            //         'label' => 'Cancel',
            //         'class' => 'cancel jp-btn-red',
            //         'icon' => 'x',
            //         'action' => route('admin.classes')
            //     ]
            // ],
        ];

        return view('admin.category-view', compact('attributes'));
    }

    public function update($id) {
        // code to update category
    }

    public function destroy($id) {
        // code to delete category
    }
}
