<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Historic extends Model
{
    protected  $fillable = [
        'type',
        'amount',
        'total_before',
        'total_after',
        'user_id_transaction',
        'date',
    ];
    
    public function type($type = null) {
        $types = [
            'I' => 'Depósito',
            'O' => 'Saque',
            'T' => 'Transferência',
        ];
        
        if(!$type):
            return $types;
        else:
            if($this->user_id_transaction != null && $type == 'I'):
                return 'Valor Recebido';
            endif;
            
            return $types[$type];
        endif;
    }
    
    public function scopeUserAuth($query) {
        return $query->where('user_id', auth()->user()->id);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function userSender() {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }
    
    public function getDateAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function search(Array $data, $totalPage) {
        $historics = $this->where(function($query) use ($data){
            if(isset($data['id'])):
                $query->where('id', $data['id']);
            endif;
            
            if(isset($data['date'])):
                $query->where('date', $data['date']);
            endif;
            
            if(isset($data['type'])):
                $query->where('type', $data['type']);
            endif;
        })//->toSql();dd($historics);
        //->where('user_id', auth()->user()->id)
        ->userAuth()
        ->with(['userSender'])
        ->paginate($totalPage);
        
        return $historics;
    }
}
