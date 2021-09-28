@extends('layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-wrap">
                        <h2 class="title-1">Total's Contact <span class="text-danger">({{$count}})</span></h2><br/><br/>                       
                    </div>
                </div>
                <div class="col-md-6 text-right mb-2">
                    <a href="{{route('contacts.create')}}" class="btn btn-primary btn-md">
                       Create Contact
                    </a>
                </div>
            </div>   
            @if(session()->has('success'))
            <div class="text-left">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            </div>
            @endif         
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-40">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th>Contact Name</th>
                                    <th>Account Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                              
                                @foreach ($contacts as $list)    
                                <tr>   
                                    <td>{{$list->first_name}} {{$list->last_name}}</td>                   
                                    <td>account</td>
                                    <td>{{$list->email}}</td>
                                    <td>{{$list->mobile}}</td> 
                                     <td><a href="{{route('contacts.edit',$list->id)}}" class="btn btn-success btn-sm">
                                       Edit
                                     </a>
                                     <a href="{{route('contacts.destroy',$list->id)}}" class="btn btn-danger btn-sm">
                                        Delete
                                      </a></td>                                                        
                                     </tr>                                 
                                @endforeach                         
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection            