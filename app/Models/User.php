<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'user_type',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function paginate($count = 10)
    {
        $where_array = [];

        $loginAdmin = Auth::guard('admin')->user();

        $query = $this->where($where_array);

        if ($loginAdmin->user_type == ADMIN) {
            $query->where(function ($q) use ($loginAdmin) {
                $q->where('parent_id', $loginAdmin->id)
                    ->orWhere('parent_id', $loginAdmin->parent_id);
            })
                ->whereIn('user_type', [ADMIN, MEMBER]);
        } else {
            $query->where('user_type', ADMIN)
                ->whereNull('parent_id');
        }

        $query->when(Auth::guard('admin')->user(), function ($q) {
            return $q->where('id', '!=', Auth::guard('admin')->user()->id);
        });

        return $query->latest()->paginate($count);
    }
}
