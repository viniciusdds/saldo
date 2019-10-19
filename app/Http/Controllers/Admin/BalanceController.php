<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;
use App\Models\Historic;

class BalanceController extends Controller
{
    private $totalPage = 2;
    
    public function index(){
        
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount : 0;
        
        return view('admin.balance.index', compact('amount'));
    }
    
    public function deposito(){
        return view('admin.balance.deposito');
    }
    
    public function depositoStore(MoneyValidationFormRequest $request) {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);
        
        if($response['success']):
            return redirect()->route('admin.balance')->with('success', $response['message']);
        else:
            return redirect()->back()->with('error', $response['message']);    
        endif;
    }
    
    public function withdraw() {
        return view('admin.balance.withdraw');
    }
    
    public function withdrawStore(MoneyValidationFormRequest $request) {
        
        //dd($request->all());
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->value);
        
        if($response['success']):
            return redirect()->route('admin.balance')->with('success', $response['message']);
        else:
            return redirect()->back()->with('error', $response['message']);    
        endif;
    }
    
    public function transfer() {
        return view('admin.balance.transfer');
    }
    
    public function confirmTransfer(Request $request, User $user) {
        if(!$sender = $user->getSender($request->sender)){
            return redirect()
                        ->back()
                        ->with('error', 'Usuário informado não foi encontrado!');
        }
        
        if($sender->id === auth()->user()->id){
            return redirect()
                        ->back()
                        ->with('error', 'Não pode transferir para você mesmo!');
        }
        
        $balance = auth()->user()->balance;
        
        return view('admin.balance.transfer-confirm', compact('sender', 'balance'));  
    }
    
    public function transferStore(MoneyValidationFormRequest $request, User $user) {
        
        if(!$sender = $user->find($request->sender_id)){
            return redirect()
                        ->route('balance.transfer')
                        ->with('success', 'Recebedor Não Encontrado!');
        }
        
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->value, $sender);
        
        if($response['success']):
            return redirect()->route('admin.balance')->with('success', $response['message']);
        else:
            return redirect()->route('balance.transfer')->with('error', $response['message']);    
        endif;
    }
    
    public function historico(Historic $historic) {
        $historics = auth()->user()->historics()->with(['userSender'])->paginate($this->totalPage);
        
        $types = $historic->type();
        
        return view('admin.balance.historics', compact('historics', 'types'));
    }
    
    public function searchHistorico(Request $request, Historic $historic) {
        $dataForm = $request->except('_token');
        
        $historics = $historic->search($dataForm, $this->totalPage);
        
        $types = $historic->type();
        
        return view('admin.balance.historics', compact('historics', 'types', 'dataForm'));
    }
}
