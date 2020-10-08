@extends('layouts.app')

@section('content')
@foreach ($invoice as $inv)

<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="home-tab" href="{{route('invoices')}}" role="tab" aria-controls="home" aria-selected="false">Home</a>
        </li>
        
        <li class="nav-item">
                <a class="nav-link" id="edit-tab" href="{{route('invoices.edit',['id' => $inv->invoice_id])}}" role="tab" aria-controls="edit" aria-selected="false">Edit Invoice</a>
        </li>
       
    </ul>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Invoice Ref: {{$inv->invoice_ref}}</h3></div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                               
                                        <h5>Client</h5>
                                        
                                    
                                       @foreach ($client as $c)
                                       {{ $c->company }} <br>
                                        {{ $c->address }} <br>
                                        {{ $c->town }} <br>
                                        {{ $c->county }} <br>
                                        {{ $c->postcode }} <br>
                                        {{ $c->country }} <br>
                                        <br>
                                        Tax ID: {{ $c->vat_no }}
                                        <br>
                                       @endforeach
                                           
                                   
                            </div>
                
                        <div class="col-md-4 ">
                               
                                        <h5>Dates</h5>
                                   
                                        <p>Invoice Date: {{ date('d/m/y', strtotime($inv->invoice_date)) }}<br>
                                        Invoice Due: {{ date('d/m/y', strtotime($inv->invoice_due)) }}<br>
                                        Created On: {{ date('d/m/y H:i', strtotime($inv->created_at)) }}<br>
                                        Updated On: {{ date('d/m/y H:i', strtotime($inv->updated_at)) }}</p>
                                        
                                    
                            </div>
                
                           
                
                            <div class="col-md-4">
                                
                                        <h5>Status</h5>
                                    
                                        <p>{{ $inv->status}}</p>
                                    
                            </div>
                
                
                        </div>
                
                        <br>
                        <br>
                        <div class="row">
                        <div class="col-md-12">
                                
                                        <h5>Invoice Items</h5>
                                    
                                        <table class="table">
                                            <thead>
                                        <tr>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Unit Price</th>
                                        <th>Net Total</th>
                                        <th>Tax </th>
                                        <th>Tax Exempt</th>
                                        <th>Gross Total</th>
                                        </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($invoice_lines as $ln)
                                            
                                            <tr>
                                            <td width="100px">{{$ln->qty}}</td>
                                            <td>{{$ln->description}}</td>
                                            <td width="150px">{{$ln->line_price}}</td>
                                            <td width="150px">{{$ln->line_net}}</td>
                                            <td width="150px">{{$ln->line_tax}}</td>
                                            <td width="80px">@if($ln->line_tax_exempt == "on") Yes @else No @endif</td>
                                            <td width="150px">{{$ln->line_total}}</td>
                                            </tr>
                                           
                                            @endforeach
                                            </tbody>
                                        </table>
                                        
                            </div>
                
                        </div>
                        
                        <br><br>
                        <div class="row justify-content-end">
                        <div class="col-md-3">
                                
                                        <h5 >Totals</h5>
                                        
                                    
                
                                        <h6>Total Net: {{ number_format($inv->net_total,2,',','.')}}&euro;</h6>
                                        <h6>Total Tax: {{ number_format($inv->tax_total,2,',','.')}}&euro;</h6>
                                        <h6>Grand Total: {{ number_format($inv->grand_total,2,',','.')}}&euro;</h6>
                                        
                                   
                            </div>
                        </div>
                
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    
@endforeach
@endsection

