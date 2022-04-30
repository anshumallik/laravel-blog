<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    private $page = 'admin.tag.';
    private $redirectTo = 'admin.tag.index';

    public function index()
    {
        $tags = Tag::orderBy('id', 'ASC')->get();
        return view($this->page . 'index', compact('tags'))->with('id');
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
                Tag::create($input);
                DB::commit();
                return response()->json(["msg" => " Tag created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }

    }
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view($this->page . "edit", compact("tag"));
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
                $tag = Tag::findOrFail($id);
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->name);

                $tag->update($input);
                DB::commit();
                return response()->json(["msg" => " Tag updated successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->back()->with(notify("error", "Tag deleted successfully"));

    }
    public function updateStatus(Request $request)
    {
        $tag = Tag::where("id", $request->tag_id)->first();
        if ($tag->status == 0) {
            $tag->update(["status" => 1]);
            $msg = " Tag is active";
        } else {
            $tag->update(["status" => 0]);
            $msg = " Tag is inactive";
        }
        $status = $tag->status;
        return response()->json(["msg" => $msg, "status" => $status]);

    }
}
