<?php

namespace App\Services\Admin;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesForDataTable($request)
    {
        $categories = $this->categoryRepository->all()->load('translations');

        return DataTables::of($categories)
            ->addColumn('name', function ($category) {
                $translation = $category->translations->firstWhere('language_code', 'en');
                return $translation ? $translation->name : 'No name available';
            })
            ->addColumn('description', function ($category) {
                $translation = $category->translations->firstWhere('language_code', 'en');
                return $translation ? $translation->description : 'No description available';
            })
            ->addColumn('action', function ($category) {
                return '
                    <a href="' . route('admin.categories.edit', $category->id) . '" class="btn btn-primary btn-sm">Edit</a>
                    <form action="' . route('admin.categories.destroy', $category->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this category?\');">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created category.
     */
    public function store(array $translations)
    {
        $rules = [];
        $filteredTranslations = [];

        foreach ($translations as $lang => $data) {
            $hasContent = !empty($data['name']) || !empty($data['description']) || !empty($data['image']);

            if ($hasContent) {
                $filteredTranslations[$lang] = $data;
                $rules["$lang.name"] = 'required|string|max:255';
                $rules["$lang.description"] = 'nullable|string';
                $rules["$lang.image"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000';
            }
        }

        if (empty($rules)) {
            return back()->withErrors(['translations' => 'Please fill at least one language tab.'])->withInput();
        }

        $validator = Validator::make($filteredTranslations, $rules, trans('category'));

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $this->categoryRepository->storeWithTranslations($filteredTranslations);
    }

    /**
     * Update an existing category.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $translations = $request->input('translations', []);

        $rules = [];
        $filteredTranslations = [];

        foreach ($translations as $lang => $data) {
            $hasContent = !empty($data['name']) || !empty($data['description']) || $request->hasFile("translations.$lang.image");

            if ($hasContent) {
                $filteredTranslations[$lang] = $data;
                $rules["translations.$lang.name"] = 'required|string|max:255';
                $rules["translations.$lang.description"] = 'nullable|string';
                $rules["translations.$lang.image"] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000';
            }
        }

        if (empty($rules)) {
            return back()->withErrors(['translations' => 'Please fill at least one language tab.'])->withInput();
        }

        $validated = $request->validate($rules);

        return $this->categoryRepository->updateWithTranslations($category, $filteredTranslations);
    }

    /**
     * Delete an existing category.
     */
    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }

    /**
     * Find a category by its ID.
     */
    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * Uploads an image and returns the full storage URL.
     */
    private function uploadImage($image)
    {
        $fileName = time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('categories', $fileName, 'public');
        return 'storage/' . $path;
    }
}
