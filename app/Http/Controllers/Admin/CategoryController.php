<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    private $page = 'admin.category.';
    private $redirectTo = 'admin.category.index';

    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->get();
        return view($this->page . 'index', compact('categories'))->with('id');
    }
    public function create()
    {
        return view($this->page . 'create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required", "unique:categories,name"],
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $input['slug'] = getSlug($request->name);
                Category::create($input);
                DB::commit();
                return response()->json(["msg" => " category created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }

    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view($this->page . "edit", compact("category"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', "unique:categories,name," . $id],
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $category = Category::findOrFail($id);
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->name);

                $category->update($input);
                DB::commit();
                return response()->json(["msg" => " Category updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with(notify("error", "Category deleted successfully"));

    }
    public function updateStatus(Request $request)
    {
        $category = Category::where("id", $request->category_id)->first();
        if ($category->status == 0) {
            $category->update(["status" => 1]);
            $msg = " Category is active";
        } else {
            $category->update(["status" => 0]);
            $msg = " Category is inactive";
        }
        $status = $category->status;
        return response()->json(["msg" => $msg, "status" => $status]);

    }
}
