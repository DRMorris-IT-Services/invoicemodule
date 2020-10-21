<?php

//namespace App\Http\Controllers;
namespace duncanrmorris\invoicemodule\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use duncanrmorris\invoicemodule\App\invoices;
use duncanrmorris\invoicemodule\App\invoices_lines;
use duncanrmorris\invoicemodule\App\invoicecontrols;
use duncanrmorris\invoicemodule\App\clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(invoices $invoices, invoicecontrols $invoicecontrols)
    {
        //

        $client = clients::join('invoices','clients.client_id', '=', 'invoices.client_id')
        ->select('clients.company','invoice_id','invoices.client_id')->get();

        $unique = $client->unique('company');

       return view('invoicemodule::invoices',[
           'invoices' => $invoices->orderby('invoice_date','DESC')->paginate(15), 
           'client' => $unique,
           'controls' => $invoicecontrols->where('user_id',Auth::user()->id)->get(),
            'count' => $invoicecontrols->count(),
           ]);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $today = date('Y-m-d');
        $due = date('Y-m-d', strtotime($today. ' + 14 days'));
        $invoice_id = Str::random(60);
        
        invoices::create([
            'invoice_id' => $invoice_id,
            'invoice_date' => $today,
            'invoice_due' => $due,
            'status' => "Pending Review",
        ]);

        invoices_lines::create([
            'invoice_id' => $invoice_id,
        ]);

        return redirect("invoices/edit/$invoice_id");

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
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices, invoices_lines $invoices_lines, clients $clients, $id, invoicecontrols $invoicecontrols)
    {
        //

        $client = clients::join('invoices','clients.client_id', '=', 'invoices.client_id')
        ->where('invoice_id',$id)->get();

        return view('invoicemodule::view', [
            'invoice' => $invoices->where('invoice_id',$id)->get(), 
            'invoice_lines' => $invoices_lines->where('invoice_id',$id)->get(), 
            'client' => $client, 'id' => $id,
            'controls' => $invoicecontrols->where('user_id',Auth::user()->id)->get(),
            'count' => $invoicecontrols->count(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices, invoices_lines $invoices_lines, clients $clients, $id)
    {
        //

        $client = clients::join('invoices','clients.client_id', '=', 'invoices.client_id')
        ->select('clients.company','clients.client_id')->where('invoice_id',$id)->get();

        $total_net = invoices_lines::where('invoice_id', $id)->sum('line_net');
        $total_tax = invoices_lines::where('invoice_id', $id)->sum('line_tax');
        $grand_total = invoices_lines::where('invoice_id', $id)->sum('line_total');

        
        return view('invoicemodule::edit', ['invoice' => $invoices->where('invoice_id',$id)->get(), 'invoice_lines' => $invoices_lines->where('invoice_id',$id)->get(),
        'total_net' => $total_net, 'total_tax' => $total_tax, 'grand_total' => $grand_total, 'clients' => $clients->orderby('company','asc')->get(), 'client' => $client]);
        

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices, $id)
    {
        //

        invoices::where('invoice_id',$id)
            ->update([
            'client_id' => $request['client'],
            'invoice_ref' => $request['ref_no'],
            'invoice_date' => $request['invoice_date'],
            'invoice_due' => $request['due_date'],
            'amount_paid' => $request['amount_paid'],
            'status' => $request['status'],
            
            ]);

            return back()->withStatus(__('Invoice successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices, invoices_lines $invoices_lines, $id)
    {
        //

        invoices::where('invoice_id',$id)
        ->delete();

        invoices_lines::where('invoice_id',$id)
        ->delete();

        return back()->withdelete(__('Invoice successfully removed.'));
    }

    public function downloadPDF($id) {
        //$show = invoices::where('invoice_id',$id)->get();

        $show = clients::join('invoices','clients.client_id', '=', 'invoices.client_id')->where('invoice_id',$id)->get();
        $lines = invoices_lines::where('invoice_id',$id)->get();
        $name = $show[0]['company'];
        $inv_date = $show[0]['invoice_date'];

       $pdf = PDF::loadView('invoicemodule::pdf', ['invoice' => $show, 'lines' => $lines]);
        
       return $pdf->download("invoice $name $inv_date.pdf");
      

       

      //return view('invoices.pdf',['invoice' => $show, 'lines' => $lines]);

    }

    public function search(invoices $invoices, $search)
    {
        $client = clients::join('invoices','clients.client_id', '=', 'invoices.client_id')
        ->select('clients.company','invoice_id','invoices.client_id')->get();

        $unique = $client->unique('company');

       
        
        
        return view('invoicemodule::search',[
            'invoices' => $invoices->where('client_id', $search)->orderby('invoice_date','DESC')->paginate(15), 
            'client' => $unique
        ]);
    }
}
