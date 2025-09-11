<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $loginAdmin = Auth::guard('admin')->user();

        $users = User::when($loginAdmin->user_type == SUPER_ADMIN, function ($query) {
            $query->where('user_type', ADMIN)
                ->whereNull('parent_id');
        })
            ->when($loginAdmin->user_type == ADMIN, function ($query) use ($loginAdmin) {
                $query->where(function ($parent_id_query) use ($loginAdmin) {
                    $parent_id_query->where('parent_id', $loginAdmin->id)
                        ->orWhere('parent_id', $loginAdmin->parent_id);
                })
                    ->whereIn('user_type', [ADMIN, MEMBER]);
            })
            ->get();

        $userIds = $users->pluck('id')->toArray();

        // \DB::enableQueryLog();
        $url_query = ShortUrl::query();

        if (in_array($loginAdmin->user_type, [MEMBER, ADMIN])) {
            if ($loginAdmin->user_type == ADMIN) {
                $url_query->where(function ($query) use ($loginAdmin, $userIds) {
                    $query->where('user_id', $loginAdmin->id)
                        ->orWhereIn('user_id', $userIds);
                });
            } else {
                $url_query->where('user_id', $loginAdmin->id);
            }
        }

        $urls = $url_query->count();
        // pr(\DB::getQueryLog(), 1);

        $title = 'Admin Dashboard';
        $users = ($users->isNotEmpty()) ? count($users->toArray()) : 0;

        return view('admin.dashboard', compact('title', 'users', 'urls'));
    }
}
