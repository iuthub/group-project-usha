<?php

namespace App\Http\Controllers;

use App\Message;
use App\Post;
use App\User;
use App\UserSkill;
use App\Skill;

use Illuminate\Http\Request;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use ImageUpload;


    public function __construct()
    {
        $this->middleware(['auth', 'needInfo']);
    }


    //home page
    public function index(Request $request, $type = 'home')
    {
        $user_id = Auth()->user()->id;
//        dump($request->get('needInfo'));
        if ($type === 'archive') {
            $needInfo = $request->get('needInfo');
            if ($needInfo == true) {
                $skills = Skill::all();
            }
            $posts = Post::getPosts();
            $archiveChats = array_unique(Message::getArchivedChats());
            $user_info_about_archived_chats = User::find($archiveChats);
            $data = [
                'posts' => $posts,
                'render' => $type,
                'archivedChats' => $user_info_about_archived_chats,
                'info' => $needInfo,
                'skills' => $skills ?? null
            ];
            return view('home', ['data' => $data]);
        } else {
            $render = 'home';
            $posts = Post::getPosts();
            $needInfo = $request->get('needInfo');
            if ($needInfo == true) {
                $skills = Skill::all();
            }
            $data = [
                'posts' => $posts,
                'render' => $render,
                'info' => $needInfo,
                'skills' => $skills ?? null
            ];
            return view('home', ['data' => $data]);
        }
        // $posts = \DB::table('posts')->orderBy('created_at', 'desc')->get();
    }

    public function myPosts()
    {
        $user = Auth()->user();
        $posts = $user->posts()->paginate(10);
        $render = 'home';
        $data = [
            'posts' => $posts,
            'render' => 'home'
        ];

        return view('home', ['data' => $data]);
    }

    //Settings page of the user
    public function dashboard()
    {
        $userPosts = Auth()->user()->posts;
        $userSkills = Auth()->user()->skills;
        $skills = Skill::all();


        return view('dashboard', [
            'userPosts' => $userPosts,
            'userSkills' => $userSkills,
            'skills' => $skills,
            'includeCroppieCss' => true,
        ]);
    }

    //Change about of the user
    public function changeAbout(Request $request)
    {
        $skills = $request->skills;

        $validated = $request->validate([
            'about' => 'min:10'
        ]);

        $user = \App\User::find(auth()->user()->id);

        foreach ($skills as $skill) {
            if (UserSkill::where('name', $skill)->where('user_id', $user->id)->count() == 0) {
                UserSkill::create([
                    'name' => $skill,
                    'user_id' => $user->id
                ]);
            }
        }

        \App\User::find(auth()->user()->id)->update($validated);

        return redirect('/home')
            ->with('msg', 'About info of user has been updated successfully');
    }


    //change personal info
    public function personalInfo(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5',
            'role' => 'required',
            'contact' => ''
        ]);

        \App\User::find(auth()->user()->id)
            ->update($validated);
        return redirect('/home')
            ->with('msg', 'Personal info of user has been updated successfully');

    }

    public function uploadRequiredModalInfo(Request $request)
    {
        if ($request->ajax() && !$request->has('about')) {
            $user_id = Auth()->user()->id;
            $validated = $request->validate([
                'role' => 'required',
            ]);
            User::find(Auth()->user()->id)
                ->update($validated);

            foreach ($request->skills as $skill) {
                if (UserSkill::where('name', $skill)->where('user_id', $user_id)->count() == 0) {
                    UserSkill::create([
                        'name' => $skill,
                        'user_id' => $user_id
                    ]);
                }
            }

            return response()->json([
                'message' => 'Information successfully stored'
            ]);
        } else if ($request->ajax() && $request->has('about')) {
            $validatedAbout = $request->validate([
                'about' => 'required|min:10'
            ]);
            User::find(Auth()->user()->id)->update($validatedAbout);
            return response()->json([
                'message' => 'Information successfully saved'
            ]);
        }
    }

    public function uploadImage(Request $request)
    {
        if (isset($request->avatar)) {

            if (\File::exists(Auth()->user()->avatar)) {
                \File::delete(Auth()->user()->avatar);
            }
            $filePath = $this->UserOnlyImageUpload($request->avatar); //Passing $data->image as parameter to our created method

            User::find(auth()->user()->id)->update([
                'avatar' => $filePath,
            ]);
            return response()->json([
                'message' => 'Image saved Successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'File is not provided'
            ]);
        }
    }


    //See all users
    public function users()
    {
        $users = User::where('profileType', 'freelancer')->paginate(10);

        return view('/users', ['users' => $users]);
    }


    //Search users
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'min:1'
        ]);
        $search = $request->search;
        $users = User::find(1)
            ->where('name', 'like', '%' . $search . '%')
            ->orderBy('created_at')
            ->paginate(10);

        return view('/users', ['users' => $users]);

    }

    public function user($id)
    {
        $user = User::findOrFail($id);
        return view('user/show', ['user' => $user]);
    }

    public function seeArchive($id)
    {
        $user_id = Auth()->user()->id;

        $msg = DB::select('SELECT * FROM messages WHERE ((from_user_id = ? AND user_id = ?) OR (from_user_id = ? AND user_id = ?)) ORDER BY created_at',
            [$user_id, $id, $id, $user_id]);
        $user = User::find($id);

        $posts = Post::getPosts();
        $render = 'archive/messages';
        $data = [
            'posts' => $posts,
            'render' => $render,
            'messages' => $msg,
            'user' => $user
        ];
        return view('home', ['data' => $data]);
    }

}
