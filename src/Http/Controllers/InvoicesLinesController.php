<?php

namespace duncanrmorris\invoicemodule\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use duncanrmorris\invoicemodule\App\invoices_lines;
use duncanrmorris\invoicemodule\App\invoices;
use Illuminate\Http\Request;

class InvoicesLinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //

        invoices_lines::create([
            'invoice_id' => $id,
        ]);

        return back()->withstatus(__('Invoice Line successfully added.'));
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
     * @param  \App\invoices_lines  $invoices_lines
     * @return \Illuminate\Http\Response
     */
    public function show(invoices_lines $invoices_lines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices_lines  $invoices_lines
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices_lines $invoices_lines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices_lines  $invoices_lines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices_lines $invoices_lines, $id, $iid)
    {
        //

        $qty =  $request['qty'];
        $price = $request['price'];

        $net = $qty * $price;
        if($request['no-tax'] == "on")
        {
            $tax = 0;
        }else{
        $tax = $net * 0.19;
        }
        $total = $net + $tax;

        invoices_lines::where('id',$id)
            ->update([
            'qty' => $request['qty'],
            'description' => $request['description'],
            'line_price' => $request['price'],
            'line_net' => $net,
            'line_tax' => $tax,
            'line_tax_exempt' => $request['no-tax'],
            'line_total' => $total,
            
            ]);

            $total_net = invoices_lines::where('invoice_id', $iid)->sum('line_net');
            $total_tax = invoices_lines::where('invoice_id', $iid)->sum('line_tax');
            $grand_total = invoices_lines::where('invoice_id', $iid)->sum('line_total');

            invoices::where('invoice_id',$iid)
            ->update([
            'net_total' => $total_net,
            'tax_total' => $total_tax,
            'grand_total' => $grand_total,
            ]);

            return back()->withStatus(__('Invoice Line successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices_lines  $invoices_lines
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices_lines $invoices_lines)
    {
        //
    }
}
