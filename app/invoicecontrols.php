<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class invoicecontrols extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'invoice_admin', 'invoice_view', 'invoice_add', 'invoice_edit', 'invoice_download', 'invoice_del',
    ];
}
