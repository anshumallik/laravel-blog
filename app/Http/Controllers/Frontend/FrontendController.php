<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Rules\MatchPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Searchable\Search;

class FrontendController extends Controller
{
    private $destination = "avatars/";
    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(6);
        return view('frontend.index', compact('blogs'));
    }
    public function blog($slug)
    {
        $blog_category = Category::where('slug', $slug)->first();
        $blogs = $blog_category->blogs()->where('status', 1)->paginate(6);
        return view('frontend.blog', compact('blogs', 'blog_category'));
    }
    public function blog_tag($slug)
    {
        $blog_tag = Tag::where('slug', $slug)->first();
        $blog_tags = $blog_tag->blogs()->where('status', 1)->paginate(6);
        return view('frontend.blog_tag', compact('blog_tags', 'blog_tag'));
    }

    public function blog_detail($slug)
    {
        $blog = Blog::where("slug", $slug)->firstOrFail();
        return view('frontend.blog-detail', compact('blog'));
    }
    public function login()
    {
        return view('frontend.login');
    }
    public function register()
    {
        return view('frontend.register');
    }
    public function user_profile()
    {
        $user = Auth::user();
        return view('frontend.user_profile', compact('user'));
    }

    public function userNewPassword(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchPassword()],
            'password' => 'required|confirmed|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase , lowercase, digit and special character',
            'password.required' => 'Password is required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                User::find(getUser()->id)->update(['password' => Hash::make($request->password)]);
                Auth::logout();
                Session::flush();
                return redirect()->route('frontend.login')->with(notify('success', 'Password updated successfully'));
            } catch (\Exception $e) {
                return redirect()->back()->with(notify('warning', $e->getMessage()));
            }
        }

    }

    public function changeUserProfile(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'name' => "required",
            'avatar' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ], [
            'name.required' => "Name is required",
        ]);

        $input = $request->except('_token');
        $oldImage = getUser()->avatar;

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            if (!file_exists($this->destination)) {
                mkdir($this->destination, 0777, true);
            }
            if ($oldImage != null && file_exists($this->destination . $oldImage)) {
                unlink($this->destination . getUser()->avatar);
            }
            $input['avatar'] = $imageName;
        } else {
            $input['avatar'] = $oldImage;
        }

        getUser()->update($input);
        if ($request->hasFile('avatar')) {
            $image->move($this->destination, $imageName);
        }

        $notification = array(
            'alert-type' => 'success',
            'message' => 'Profile changed successfully.',
        );
        return redirect()->back()->with($notification);

    }

    public function changeUserEmail(Request $request)
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

    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Blog::class, 'name', 'description')

            ->perform($request->input('query'));

        return view('frontend.search', compact('searchResults'));
    }
}
