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

    public function paginate($count = 10, $formData = array())
    {
        $where_array = [];

        $query = $this->where($where_array);

        $query->when(!empty($formData['parent_id']), function ($q) use ($formData) {
            return $q->where('parent_id', $formData['parent_id']);
        });

        $query->when(isset($formData['user_type']) && (is_array($formData['user_type']) || !empty($formData['user_type'])), function ($q) use ($formData) {
            if (is_array($formData['user_type'])) {
                return $q->whereIn('user_type', $formData['user_type']);
            } else {
                return $q->where('user_type', $formData['user_type']);
            }
        });

        $query->when(Auth::guard('admin')->user(), function ($q) {
            return $q->where('id', '!=', Auth::guard('admin')->user()->id);
        });

        return $query->paginate($count);
    }
}
