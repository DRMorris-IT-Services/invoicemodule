<?php
 
namespace duncanrmorris\invoicemodule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use App\User;

use duncanrmorris\invoicemodule\App\invoicecontrols;


class InvoicescontrolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users, invoicecontrols $invoicecontrols, $id)
    {
        //

        return view('invoicemodule::controls.list',[
            'users' => $users->get(),
            'check' => $invoicecontrols->where('user_id',$id)->count(),
            'controls' => $invoicecontrols->where('user_id',$id)->get(),
            ]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(invoicecontrols $invoicecontrols, $id)
    {
        //
        invoicecontrols::create([
            'user_id' => $id,
            'invoice_admin' => 'on',
        ]);

        return back()->withStatus(__('Access Levels successfully updated.'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\backupcontrols  $backupcontrols
     * @return \Illuminate\Http\Response
     */
    public function show(invoicecontrols $invoicecontrols, User $user, $id)
    {
        //
        return view('invoicemodule::controls.view',[
            'count' => $invoicecontrols->where('user_id',$id)->count(),
            'controls' => $invoicecontrols->where('user_id',$id)->get(),
            'user' => $user->where('id',$id)->get()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\backupcontrols  $backupcontrols
     * @return \Illuminate\Http\Response
     */
    public function edit(invoicecontrols $invoicecontrols, User $user, $id)
    {
        //
        return view('invoicemodule::controls.edit',[
            'count' => $invoicecontrols->where('user_id',$id)->count(),
            'controls' => $invoicecontrols->where('user_id',$id)->get(),
            'user' => $user->where('id',$id)->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\backupcontrols  $backupcontrols
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoicecontrols $invoicecontrols, $id)
    {
        //

        invoicecontrols::where('id',$id)
        ->update([
        'invoice_admin' => $request['admin'],
        'invoice_view' => $request['view'],
        'invoice_add' => $request['new'],
        'invoice_edit' => $request['edit'],
        'invoice_download' => $request['download'],
        'invoice_del' => $request['del'],
        ]);
        return back()->withStatus(__('Access Levels successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\backupcontrols  $backupcontrols
     * @return \Illuminate\Http\Response
     */
    public function destroy(clients $backupcontrols)
    {
        //
    }
}
