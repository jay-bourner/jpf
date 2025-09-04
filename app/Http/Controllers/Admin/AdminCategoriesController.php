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
        $this->middleware('auth');
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->categories->getAllCategories();

        $attributes = [
            'title' => 'Categories',
            'categories' => $categories,
            'action_create' => ['hide' => false, 'action' => route('admin.categories.create')],
            'action_disable' => ['hide' => false, 'dataset' => 'disable-categories'],
            'action_delete' => ['hide' => false, 'dataset' => 'delete-categories'],
        ];
        return view('admin.categories', compact('attributes'));
    }

    public function create() {
        $attributes = [
            'title' => 'Create New Category',
            'action' => route('admin.categories.store'),
            'method' => 'POST',
            'action_save' => ['hide' => false, 'dataset' => 'submit-form'],
            'action_cancel' => ['hide' => false, 'action' => route('admin.categories')],
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
            'action_save' => ['hide' => false, 'dataset' => 'submit-form'],
            'action_cancel' => ['hide' => false, 'action' => route('admin.categories')],
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
            'action_edit' => ['hide' => false, 'action' => route('admin.categories.edit', $id)],
            'action_delete' => ['hide' => false, 'action' => route('admin.categories.delete', $id)],
            'category' => $category,
        ];

        return view('admin.category-view', compact('attributes'));
    }

    public function update(AdminCategoriesRequest $request, string $id) {
        $inputs = $request->validated();

        $data = $request->safe()
            ->merge($inputs)
            ->except(['_token', '_method']);

        $result = $this->categories->updateCategory($id, $data);

        if(isset($result['warning'])) {
            return redirect()->route('admin.categories.edit', $id)
                ->withErrors($result['warning']);
        }

        return redirect()->route('admin.categories')
            ->with($result['success']);
    }

    public function destroy($id) {
        // code to delete category
    }
}
