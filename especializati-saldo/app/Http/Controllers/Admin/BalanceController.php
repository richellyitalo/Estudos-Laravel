<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;
use App\Models\Historic;

class BalanceController extends Controller
{
    private $totalPages = 4;

    public function index()
    {
        $balance = auth()->user()->balance;
        $amount = $balance ? $balance->amount_readable : '0,00';

        return view('admin.balance.index', compact('amount'));
    }

    public function deposit()
    {
        return view('admin.balance.deposit');
    }

    public function depositStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->amount);

        if ($response['success']) {
            return redirect()
                ->route('admin.balance')
                ->withSuccess($response['message']);
        }

        return redirect()
            ->back()
            ->withError($response['message']);
    }

    public function withdraw()
    {
        return view('admin.balance.withdraw');
    }

    public function withdrawStore(MoneyValidationFormRequest $request)
    {
        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->withdraw($request->amount);

        if ($response['success']) {
            return redirect()
                ->route('admin.balance')
                ->withSuccess($response['message']);
        }

        return redirect()
            ->back()
            ->withError($response['message']);
    }

    public function transfer()
    {
        return view('admin.balance.transfer');
    }

    public function confirmTransfer(Request $request, User $user)
    {
        if (!$sender = $user->getSender($request->email)) {
            return redirect()
                ->back()
                ->withError('Usuário não encontrado');
        }

        if ($sender->id === auth()->user()->id) {
            return redirect()
                ->back()
                ->withError('Informe um usuário diferente de Você');
        }

        $balance = auth()->user()->balance->amount_readable;

        return view(
            'admin.balance.transfer-confirm',
            compact('sender', 'balance')
        );
    }

    public function transferStore(MoneyValidationFormRequest $request, User $user)
    {
        if (!$sender = User::find($request->sender_id)) {
            return redirect()
                ->route('admin.transfer')
                ->withError('Recebedor não encontrado');
        }

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transfer($request->amount, $sender);

        if ($response['success']) {
            return redirect()
                ->route('admin.balance')
                ->withSuccess($response['message']);
        }

        return redirect()
            ->route('admin.balance')
            ->withError($response['message']);
    }

    public function historic(Historic $historic)
    {
        $historics = auth()
            ->user()
            ->historics()
            ->with(['userSender'])
            ->paginate($this->totalPages);

        $types = $historic->type();

        return view('admin.balance.historics', compact('historics', 'types'));
    }

    public function historicSearch(Request $request, Historic $historic)
    {
        $dataForm = $request->all();

        $historics = $historic->search($dataForm,  $this->totalPages);

        $types = $historic->type();

        return view('admin.balance.historics', compact('historics', 'types', 'dataForm'));
    }
}
