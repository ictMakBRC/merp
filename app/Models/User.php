<?php

namespace App\Models;

use App\Models\asset\Asset;
use App\Models\Humanresource\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'employee_id',
        'emp_id',
        'name',
        'email',
        'password',
        'contact',
        'title',
        'is_active',
        'declaration',
        'avatar',
        'color_scheme',
        'left_sidebar_theme',
        'left_sidebar_compact',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public static function boot()
    {
        parent::boot();
        if (Auth::check()) {
            self::creating(function ($model) {
                $model->created_by = auth()->id();
            });
        }
    }
}
