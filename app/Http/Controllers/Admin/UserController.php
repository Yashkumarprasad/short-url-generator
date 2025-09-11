<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->users = resolve(User::class);
    }
    public function index(Request $request)
    {
        if (Auth::guard('admin')->user()->user_type != SUPER_ADMIN) {
            $formData = array(
                'parent_id' => Auth::guard('admin')->user()->id,
                'user_type' => [ADMIN, MEMBER]
            );
        } else {
            $formData = [
                'user_type' => ADMIN
            ];
        }

        $requestData = $request->all();

        $users = $this->users->paginate(10, $formData);

        $title = 'Manage Users';

        return view('admin.users.list', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Invite New Client';

        return view('admin.users.add', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $requestData = $request->all();
        // pr($requestData, 1);
        $loginAdmin = Auth::guard('admin')->user();

        $user_type = ADMIN;
        if ($loginAdmin->user_type != SUPER_ADMIN && isset($requestData['role']) && !empty($requestData['role'])) {
            $user_type = $requestData['role'];
        }

        $parent_id = ($loginAdmin->user_type == SUPER_ADMIN) ? NULL : $loginAdmin->id;

        User::create([
            'parent_id' => $parent_id,
            'user_type' => $user_type,
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password'])
        ]);

        return redirect()->route('admin.user.list')->with('success', 'User added successfully.');
    }
}
