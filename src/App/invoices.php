<?php

//namespace App;
namespace duncanrmorris\invoicemodule\app;

use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class invoices extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'client_id', 'invoice_date', 'invoice_due', 'status', 'net_total', 'tax_total', 'grand_total', 'amount_paid', 'invoice_ref',
    ];
}
