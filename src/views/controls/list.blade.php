@extends('layouts.app')

@foreach($controls as $c)
@if($c->invoice_admin == null)
<script>window.location = "/home";</script>
@endif
@endforeach


@section('content')
<div class="container"> 
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
  @endif
  
  <div class="row justify-content-end">
    
  <a href="{{route('invoices.controls',['id' => AUTH::user()->id])}}"><i class="fa fa-cog text-info"></i></a>
    
  </div>
  
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
    <a class="nav-link" id="home-tab" href="{{route('invoices')}}" role="tab" aria-controls="home" aria-selected="true">Home</a>
    </li>
    
    
  </ul>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>{{ __('invoices Controls') }}</h3></div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $u)
                            <tr>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                <a href="{{route('invoices.controls.view',['id' => $u->id])}}" ><button class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></button></a>
                                <a href="{{route('invoices.controls.edit',['id' => $u->id])}}" ><button class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
