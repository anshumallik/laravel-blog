<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    private $page = "admin.blog.";
    private $redirectTo = "admin.blog.index";
    private $destination = "images/admin/blog/";

    public function index()
    {
        $blogs = Blog::orderBy('id', 'ASC')->get();
        return view($this->page . "index", compact("blogs"))->with("id");
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        return view($this->page . "create", compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => ["nullable"],
            "name" => ["required", "unique:blogs,name"],
            "description" => ["required"],
            "avatar" => ["requried", "image", "mimes:jpeg,jpg,png", "max:2048"],

        ], [
            'name.required' => 'Name is required',
            'description.required' => 'Description is required',
            'image.required' => 'Image field is required',
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $input['slug'] = getSlug($request->name);
                $input['user_id'] = Auth::user()->id;
                $categories = $request->categories;
                $tags = $request->tags;
                if ($request->hasFile("image")) {
                    $image = Upload::image($request, "image", $this->destination);
                    $imageName = $input["image"] = $image["imageName"];
                }

                $blog = Blog::create($input);
                $blog->categories()->sync($categories);
                $blog->tags()->sync($tags);
                DB::commit();
                if ($request->hasFile("image")) {
                    $image["image"]->move($this->destination, $imageName);
                }

                return response()->json(["msg" => "Blog created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $tags = Tag::all();
        $categories = Category::all();
        return view($this->page . "edit", compact("tags", 'categories', 'blog'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "user_id" => ["nullable"],
            "name" => ["required", "unique:blogs,name," . $id],
            "description" => ["required"],
        ], [
            "name.required" => "Name is required",
            "description.required" => "Description is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $blog = Blog::findOrFail($id);
                $oldImage = $blog->image;
                $input = $request->except("_token");
                $input['slug'] = getSlug($request->name);
                $input['user_id'] = Auth::user()->id;
                if ($request->hasFile("image")) {
                    $image = Upload::image($request, "image", $this->destination);
                    $imageName = $input["image"] = $image["imageName"];
                }

                $blog->update($input);
                $blog->tags()->sync($request->tags);
                $blog->categories()->sync($request->categories);
                DB::commit();
                if ($request->hasFile('image')) {
                    FileUnlink($this->destination, $oldImage);
                    $image["image"]->move($this->destination, $imageName);
                }

                return response()->json(["msg" => "Blog updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function updateStatus(Request $request)
    {
        $blog = Blog::where("id", $request->blog_id)->first();
        if ($blog->status == 0) {
            $blog->update(["status" => 1]);
            $msg = "Blog is active";
        } else {
            $blog->update(["status" => 0]);
            $msg = "Blog is inactive";
        }
        $status = $blog->status;
        return response()->json(["msg" => $msg, "status" => $status]);

    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with(notify("error", "Blog deleted successfully"));
    }

}
