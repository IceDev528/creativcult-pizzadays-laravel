<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class TransactionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transaction = Transaction::all();

        return view('backEnd.transaction.index', compact('transaction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Transaction::create($request->all());

        Session::flash('message', __('messages.transaction_created'));
        Session::flash('status', 'success');

        return redirect('transaction');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('backEnd.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('backEnd.transaction.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        Session::flash('message', __('messages.transaction_updated'));
        Session::flash('status', 'success');

        return redirect('transaction');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        Session::flash('message', __('messages.transaction_deleted'));
        Session::flash('status', 'success');

        return redirect('transaction');
    }

}
