<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Transaction;
use App\Imports\TransactionImport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function create()
    {
        return view('admin.transactions.create');
    }

    public function import(Request $request)
    {
        $rules = [
            'import' => 'required'
        ];

        $messages = [
            'import.required' => 'File Excel tidak boleh kosong'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect()->route('transactions.create')->withErrors($validator)->withInput($request->all());

        }else{

            $import = $request->file('import');

            Excel::import(new TransactionImport, $import);

            \Session::flash('message', 'Transaction successfully imported');

            return redirect()->route('transactions.index');

        }
    }

    public function index()
    {
        $transactions = Transaction::orderBy('updated_at', 'DESC')->paginate(5);

        return view('admin.transactions.index', compact('transactions'));
    }
}
