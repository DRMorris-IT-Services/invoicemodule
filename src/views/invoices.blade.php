
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'invoices'
])

@section('content')

    <div class="content">
    @include('layouts.alerts')
   
        <div class="row">
        <div class="col-md-12 text-white">
        
	<!-- TOP LEVEL NAV --> 
	<ul class="nav nav-tabs" id="myTab" role="tablist">
	    <li class="nav-item">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
	    </li>
	    @if (AUTH::user()->invoices_add == "on")
	    <li class="nav-item">
		<a class="nav-link" id="profile-tab" href="{{route('invoices.new')}}" role="tab" aria-selected="false">New Invoice</a>
	    </li>
	    @endif
	</ul>
	<!-- END OF NAV -->

                        <h2>Invoices</h2>
                    
                        <div class="table-responsive">
                            <table class="table">
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
                                        <td>@foreach($client as $c) @if($i->client_id == $c->client_id) {{$c->company}} @endif @endforeach</td>
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
                                       @if (AUTH::user()->invoices_view == "on")
                                        <a href="{{route('invoices.view',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-success fa fa-eye"></button></a>
                                        @endif
                                        @if (AUTH::user()->invoices_edit == "on")
                                        <a href="{{route('invoices.edit',['id' => $i->invoice_id])}}"><button class="btn btn-sm btn-outline-warning fa fa-edit"></button></a>
                                        @endif
                                        @if (AUTH::user()->invoices_del == "on")
                                        <button class="btn btn-sm btn-outline-danger"data-toggle="modal" data-target="#invoice_del{{$i->id}}"><i class="fa fa-trash"></i></button>
                                        
                                        <!-- MODAL DELETE INVOICE -->
                                        <form class="col-md-12" action="{{ route('invoices.del',['id' => $i->invoice_id]) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                
                                                <div class="modal fade" id="invoice_del{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-dark" id="exampleModalLongTitle">REMOVE Invoice??</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-dark text-white">
                                                    
                                                    <h3><i class="fa fa-warning" ></i> WARNING!!</h3>
                                                    <h5>You are going to remove this invoice, are you sure?</h5>
                                                    <h5>This action can <b><u>NOT BE UNDONE!</u></b></h5>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger">DELETE</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                </form>

                                                <!-- END MODAL FOR DELETE CLIENT --> 
                                            @endif
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

@endsection
