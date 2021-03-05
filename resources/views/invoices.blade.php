
@extends('layouts.app')

@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
    {{ session('status') }}
    </div>
    @endif




    <!-- TOP LEVEL NAV --> 
	<ul class="nav nav-tabs" id="myTab" role="tablist">
	    <li class="nav-item">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><b><i class="fa fa-list"></i> Home</b></a>
	    </li>
        
	    <li class="nav-item">
		<a class="nav-link bg-success text-white" id="profile-tab" href="{{route('invoices.new')}}" role="tab" aria-selected="false"><b><i class="fa fa-plus-square"></i> New Invoice</b></a>
	    </li>
        
	    
	</ul>
    <!-- END OF NAV -->
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>{{ __('Invoices') }}</h3></div>

                <div class="card-body">
               
                    <div class="table-responsive">  
                        <table id="invoices" class="table">
                            <thead class=" text-primary">
                                <tr>
                                    <th>Client</th>
                                    <th>Invoice Ref</th>
                                    <th>Invoice Date</th>
                                    <th>Due Date</th>
                                    <th>Net</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>Amount Paid</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($invoices as $i)
                                <tr>
                                <td>@foreach($client as $cl) @if($i->client_id == $cl->client_id) {{$cl->company}} @endif @endforeach</td>
                                    <td>{{$i->invoice_ref}}</td>
                                    <td>{{date('d/m/y', strtotime($i->invoice_date))}}</td>
                                    <td>{{date('d/m/y', strtotime($i->invoice_due))}}</td>
                                    <td>{{number_format($i->net_total,2,',','.')}}</td>
                                    <td>{{number_format($i->tax_total,2,',','.')}}</td>
                                    <td>{{number_format($i->grand_total,2,',','.')}}</td>
                                    <td>{{number_format($i->amount_paid,2,',','.')}}</td>
                                    <td>{{$i->status}}</td>
                                    <td>
                                    
                                    <a href="{{route('invoices.download',['id' => $i->invoice_id])}}"> <button class="btn btn-sm btn-outline-primary fa fa-download"></button></a>
                                    
                                    <a href="{{route('invoices.view',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-success fa fa-eye"></button></a>
                                    @can('isAdmin')
                                    <a href="{{route('invoices.edit',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-warning fa fa-edit"></button></a>
                                    @elsecan('isManager')
                                    <a href="{{route('invoices.edit',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-warning fa fa-edit"></button></a>
                                    @endcan

                                    @can('isAdmin')
                                    <button class="btn btn-sm btn-outline-danger fa fa-trash" data-toggle="modal" data-target="#invoice_del{{$i->id}}"></button>
                                    
                                    <!-- MODAL DELETE INVOICE -->
                                    <form class="col-md-12" action="{{ route('invoices.del',['id' => $i->invoice_id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                            
                                            <div class="modal fade" id="invoice_del{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">REMOVE Invoice??</h5>
                                                </div>
                                                <div class="modal-body">
                                                
                                                <h3><i class="fa fa-warning" ></i> WARNING!!</h3>
                                                <h5>You are going to remove this invoice, are you sure?</h5>
                                                <h5>This action can <b><u>NOT BE UNDONE!</u></b></h5>
                                                    
                                                </div>
                                                <div class="modal-footer card-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            </form>

                                            <!-- END MODAL FOR DELETE CLIENT --> 
                                        @elsecan('isManager')
                                        <button class="btn btn-sm btn-outline-danger fa fa-trash" data-toggle="modal" data-target="#invoice_del{{$i->id}}"></button>
                                    
                                    <!-- MODAL DELETE INVOICE -->
                                    <form class="col-md-12" action="{{ route('invoices.del',['id' => $i->invoice_id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                            
                                            <div class="modal fade" id="invoice_del{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">REMOVE Invoice??</h5>
                                                </div>
                                                <div class="modal-body">
                                                
                                                <h3><i class="fa fa-warning" ></i> WARNING!!</h3>
                                                <h5>You are going to remove this invoice, are you sure?</h5>
                                                <h5>This action can <b><u>NOT BE UNDONE!</u></b></h5>
                                                    
                                                </div>
                                                <div class="modal-footer card-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            </form>

                                            <!-- END MODAL FOR DELETE CLIENT --> 
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $invoices->links() }}
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

@push('scripts')
   
@endpush