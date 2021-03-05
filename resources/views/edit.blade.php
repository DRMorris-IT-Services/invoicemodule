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
            <a class="nav-link" id="home-tab" href="{{route('invoices')}}" role="tab" aria-controls="home" aria-selected="false"><b>Home</b></a>
        </li>

        <li class="nav-item">
            <a class="nav-link bg-success text-white" id="add-tab" href="{{route('invoices.ln.new',['id' => $inv->invoice_id])}}" role="tab" aria-controls="add" aria-selected="false" ><b>Add New Line</b></a>
        </li>
        
    </ul>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Update Invoice - Ref: {{$inv->invoice_ref}} </h3></div>

                <div class="card-body">

                    <form action="{{ route('invoices.update',['id' => $inv->invoice_id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  
                        
                        <div class="row">        
                                <div class="col-md-4">
                                        
                                                <h5>Client</h5>
                                                
                                            <select class="form-control" name="client" onchange="submit()">
                                            @foreach ($client as $c)<option value="{{$c->client_id}}">{{ $c->company }}</option>@endforeach
                                            <option></option>
                                            @foreach ($clients as $cl)
                                                <option value="{{$cl->client_id}}">{{$cl->company}}</option>
                                            @endforeach
                                                </select>
                                                    
                        
                                                <br><br>
                                                <h6>Invoice Reference: <input type="text" class="form-control" name="ref_no" value="{{$inv->invoice_ref}}" onchange="submit()"></h6>
                                        
                                </div>
                    
                                <div class="col-md-4 ">
                                        
                                                <h5>Dates</h5>
                                            
                                                <h6>Invoice Date: <input type="text" class="form-control" name="invoice_date" value="{{$inv->invoice_date}}" onchange="submit()"></h6>
                                                <h6>Invoice Due: <input type="text" class="form-control" name="due_date" value="{{$inv->invoice_due}}" onchange="submit()"></h6>
                                                <h6>Created On: {{ $inv->created_at }}</h6>
                                                <h6>Updated On: {{ $inv->updated_at }}</h6>
                                                
                                            
                                </div>
                    
                                
                    
                                <div class="col-md-4">
                                   
                                            <h5>Status</h5>
                                        
                                            <select class="form-control" name="status" onchange="submit()">
                                            <option>{{ $inv->status}}</option>
                                            <option>--------</option>
                                            <option>UnPaid</option>
                                            <option>Part Paid</option>
                                            <option>In Dispute 
                                            <option>Paid</option>
                                            </select>
                                            
                                            <br><br>
                                            <label>Amount Paid:</label>
                                            <input type="text" class="form-control" name="amount_paid" value="{{$inv->amount_paid}}" onchange="submit()">
                                            
                                        
                                </div>
                            </div>
                        </form>
                            
                        
                

                         <br><br>   
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
                                            <th></th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($invoice_lines as $ln)
                                                    <form action="{{ route('invoices.ln.update',['id' => $ln->id, 'iid' => $inv->invoice_id]) }}" method="POST" enctype="multipart/form-data" >
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                    <tr>
                                                    <td width="100px"><input type="text" id="qty" class="form-control col-12" name="qty" value="{{$ln->qty}}" onchange="submit()"></td>
                                                    <td><input type="text" class="form-control col-12 " name="description" value="{{$ln->description}}" onchange="submit()"></td>
                                                    <td width="150px"><input type="text" id="price" class="form-control col-12" name="price" value="{{$ln->line_price}}" onchange="submit()" ></td>
                                                    <td width="150px"><input type="text" id="net" class="form-control col-12" name="net" value="{{$ln->line_net}}" onchange="submit()"></td>
                                                    <td width="150px"><input type="text" id="tax" class="form-control col-12" name="tax" value="{{$ln->line_tax}}" onchange="submit()"></td>
                                                    <td width="80px">@if($ln->line_tax_exempt == "on")<input type="checkbox" class="form-control" name="no-tax" onchange="submit()" checked>@else <input type="checkbox" class="form-control" name="no-tax" onchange="submit()">@endif</td>
                                                    <td width="150px"><input type="text" id="totalPrice" class="form-control col-12 " name="total" value="{{$ln->line_total}}" onchange="submit()"></td>
                                                    <td><a href="{{route('invoices.ln.del',['id' => $ln->id])}}" ><i class="fa fa-trash text-danger"></i></a></td>
                                                    </tr>
                                                    </form>
                                                    @endforeach
                                                </tbody>
                                            </table>
                            </div>
                        </div>
                        
                    
                            <br><br>
                                <div class="row justify-content-end">
                                <div class="col-md-3">
                                   
                                            <h5>Totals</h5>
                                        
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


    

@endforeach
@endsection

