@extends('layouts.app')

@section('content')
@foreach($user as $u)
<div class="container"> 
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
  @endif
  
  <div class="row justify-content-end">
    
  <a href="{{route('invoices.controls')}}"><i class="fa fa-cog text-info"></i></a>
    
  </div>
  
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
    <a class="nav-link" id="home-tab" href="{{route('invoices.controls')}}" role="tab" aria-controls="home" aria-selected="true">Users</a>
    </li>
    
    
  </ul>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header"><h3>{{ __('User Acess - ') }}{{$u->name}}</h3></div>

                <div class="card-body">
                    @if($count == 0)

                    <h4>Setup Required</h4>
                    <p>Please edit the user and follow the instructions to setup the user for first time use.</p>
                    

                    @else
                    @foreach($controls as $c)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Access</th>
                                    <th>Allow</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>View Backups</td>
                                    <td><input type="checkbox" name="view"></td>
                                </tr>
                                <tr>
                                    <td>Create New Backup</td>
                                    <td><input type="checkbox" name="new"></td>
                                </tr>
                                <tr>
                                    <td>Delete Backups</td>
                                    <td><input type="checkbox" name="del"></td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
