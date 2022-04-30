<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchPassword;


class UserController extends Controller
{
    private $page = "admin.user.";
    private $redirectTo = "admin.user.index";
    private $destination = "images/admin/avatar/";

    public function index()
    {

        $users = User::orderBy('id', 'DESC')->where('type', 'Admin')->get();
        return view($this->page . 'index', compact('users'))->with("id");
    }
    public function frontuser()
    {
        $frontusers = User::orderBy('id', 'DESC')->where('type', 'user')->get();
        return view($this->page . 'frontuser', compact('frontusers'))->with("id");

    }
    public function create()
    {
        return view($this->page . 'create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required"],
            "email" => ["required", "email:dns", "unique:users,email"],
            "password" => ["required", "min:8", "regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/", "confirmed"],
            "avatar" => ["nullable", "image", "mimes:jpeg,jpg,png", "max:2048"],
           
        ], [
            
            "email.unique" => "Email has already been taken",
            'password.required' => 'Password field is required',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be of at least 8 characters.',
            'password.regex' => 'Password must contain at least one uppercase , lowercase, digit and special character',
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $input["password"] = Hash::make($request->password);
                if ($request->hasFile("avatar")) {
                    $image = Upload::image($request, "avatar", $this->destination);
                    $imageName = $input["avatar"] = $image["imageName"];
                }
                $input['type'] = 'Admin';
                User::create($input);
                DB::commit();
                if ($request->hasFile("avatar")) {
                    $image["image"]->move($this->destination, $imageName);
                }
                return response()->json(["msg" => "User created successfully", "redirectRoute" => route($this->redirectTo)]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["db_error" => $e->getMessage()]);
            }
        }

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view($this->page . 'edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => ["required"],
            "email" => ["required", "email:dns", "unique:users,email," . $id],
            "password" => ["nullable", "min:8", "regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/", "confirmed"],
            "avatar" => ["nullable", "image", "mimes:jpeg,jpg,png", "max:2048"],

        ], [

            "email.unique" => "Email has already been taken",
            'password.required' => 'Password field is required',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be of at least 8 characters.',
            'password.regex' => 'Password must contain at least one uppercase , lowercase, digit and special character',
        ]);
        if ($validator->fails()) {
            return response()->json(['error', $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $user = User::findOrFail($id);
                $oldImage = $user->avatar;
                $oldPassword = $user->password;
                $input = $request->except('_token');
                if ($request->has("password")) {
                    $input["password"] = Hash::make($request->password);
                } else {
                    $input["password"] = $oldPassword;
                }
                if ($request->hasFile("avatar")) {
                    $image = Upload::image($request, "avatar", $this->destination);
                    $imageName = $input["avatar"] = $image["imageName"];
                }
                $input['type'] = 'Admin';
                $user->update($input);
                DB::commit();
                
                if ($request->hasFile('avatar')) {
                    FileUnlink($this->destination, $oldImage);
                    $image["image"]->move($this->destination, $imageName);
                }
                return response()->json(['msg' => 'User Updated Successfully', 'redirectRoute' => route($this->redirectTo)]);

            } catch (\Exception $e) {
                return response()->json(['error', $e->getMessage()]);
            }
        }

    }

    public function updateStatus(Request $request)
    {
        $user = User::where("id", $request->user_id)->first();
        if ($user->status == 0) {
            $user->update(["status" => 1]);
            $msg = "User is active";
        } else {
            $user->update(["status" => 0]);
            $msg = "User is inactive";
        }
        $status = $user->status;
        return response()->json(["msg" => $msg, "status" => $status]);
    }
    public function profile()
    {
        $user = getUser();
        return view($this->page . 'profile', compact('user'));
    }
    public function adminNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchPassword],
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase , lowercase, digit and special character',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                User::find(getUser()->id)->update(['password' => Hash::make($request->password)]);
                Auth::logout();
                Session::flush();
                return redirect()->route('login');
            } catch (\Exception $e) {
                return redirect()->back()->with(notify('warning', $e->getMessage()));
            }
        }

    }

    public function changeAdminEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:dns',
        ]);
        User::find(getUser()->id)->update(['email' => $request->email]);
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Email changed successfully.',
        );
        return redirect()->back()->with($notification);
    }

    public function changeAdminAvatar(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'image.required' => 'Image is required',

        ]);
        $input = $request->except('_token');
        $oldImage = getUser()->avatar;
        if ($request->hasFile('image')) {
            $image = Upload::image($request, 'image', $this->destination);
            $imageName = $input['avatar'] = $image["imageName"];
        } else {
            $input['avatar'] = $oldImage;
        }
        getUser()->update($input);
        if ($request->hasFile('image')) {
            FileUnlink($this->destination, $oldImage);
            $image["image"]->move($this->destination, $imageName);
        }
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Profile changed successfully.',
        );
        return redirect()->back()->with($notification);
    }
}
