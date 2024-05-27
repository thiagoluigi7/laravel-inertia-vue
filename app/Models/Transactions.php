<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Transactions extends Model
{
    use HasFactory;

    public function from(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function to(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'to');
    }

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(int $userId)
    {
        return Transactions::where('from', $userId)->orWhere('to', $userId)->get();
        // dd($results[0]->relations['from']->name);
    }

    public function transfer(int $from, int $to, float $value)
    {
        DB::transaction(function () use ($from, $to, $value) {
            $wallet = $this->user->getWallet($from);

            if ($wallet > $value) {
                $this->makeTransfer($from, $to, $value);
            } else {
                throw new \Exception('Not enough money');
            }
        });
    }

    protected $fillable = [
        'value',
    ];

    protected $with = ['from', 'to'];

    protected $user;

    private function makeTransfer(int $from, int $to, float $value)
    {
        $this->user->removeMoney($from, $value);
        $this->user->addMoney($to, $value);

        $transaction = new Transactions();
        $transaction->from = $from;
        $transaction->to = $to;
        $transaction->value = $value;

        $this->store($transaction);
    }

    private function store(Transactions $data)
    {
        return $data->save();
    }
}
