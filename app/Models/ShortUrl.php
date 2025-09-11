<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ShortUrl extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'original_url',
        'code'
    ];

    public function paginate($count = 10)
    {
        $loginAdmin = Auth::guard('admin')->user();

        // Get related users based on admin type
        $users = User::when($loginAdmin->user_type == SUPER_ADMIN, function ($query) {
            $query->where('user_type', ADMIN);
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

        $query = $this->newQuery();

        if (in_array($loginAdmin->user_type, [ADMIN, MEMBER])) {
            if ($loginAdmin->user_type == ADMIN) {
                $query->where(function ($q) use ($loginAdmin, $userIds) {
                    $q->where('user_id', $loginAdmin->id)
                        ->orWhereIn('user_id', $userIds);
                });
            } else {
                $query->where('user_id', $loginAdmin->id);
            }
        }

        return $query->latest()->paginate($count);
    }

}
