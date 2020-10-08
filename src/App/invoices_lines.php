<?php

//namespace App;
namespace duncanrmorris\invoicemodule\app;

use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class invoices_lines extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'client_id','qty', 'description', 'line_price', 'line_net', 'line_tax', 'line_total', 'tax_exempt',
    ];

}
