<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getById($userId)
    {
        return User::find($userId);
    }

    public function transactionsSent(): BelongsTo
    {
        return $this->belongsTo(Transactions::class, 'from');
    }

    public function transactionsReceived(): BelongsTo
    {
        return $this->belongsTo(Transactions::class, 'to');
    }

    public function getWallet(int $userId)
    {
        $user = User::find($userId);

        return $user->wallet;
    }

    public function removeMoney(int $userId, float $value)
    {
        $user = User::find($userId);

        $user->wallet = $user->wallet - $value;

        $user->save();
    }

    public function addMoney(int $userId, float $value)
    {
        $user = User::find($userId);

        $user->wallet = $user->wallet + $value;

        $user->save();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
