@extends('layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-wrap">
                        <h2 class="title-1">Total's Leads <span class="text-danger">({{$count}})</span></h2><br/><br/>                       
                    </div>
                </div>
                <div class="col-md-6 text-right mb-2">
                    <a href="{{route('leads.create')}}" class="btn btn-primary btn-md">
                       Create Leads
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
                                    <th>Lead Name</th>
                                    <th>Company</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Lead Owner</th>
                                    <th>Lead Source</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                              
                                @foreach ($leads as $list)    
                                <tr>   
                                    <td>{{$list->lead_name}}</td>                    
                                    <td>{{$list->company}}</td>
                                    <td>{{$list->email}}</td>
                                    <td>{{$list->mobile}}</td>
                                    <td>{{session('USER_NAME')}}</td>  
                                        @foreach ($lead_source_data as $list1)
                                            @if($list->lead_source_id == $list1->id)
                                            <td>{{$list1->name}}</td>  
                                            @endif                                         
                                        @endforeach  
                                     <td>
                                      @if($list->status == 0)
                                      <a href="{{route('leads.edit',$list->id)}}" class="btn btn-success btn-sm">
                                        Edit
                                      </a>
                                      <a href="{{route('leads.destroy',$list->id)}}" class="btn btn-danger btn-sm">
                                         Delete
                                       </a>
                                      
                                           @if ($activity == 1)
                                           <a href="{{route('activities')}}" class="btn btn-dark btn-sm">
                                            View Activity
                                          </a>
                                          @elseif($activity == 0)
                                          <a href="{{route('activities.create',$list->id)}}" id="activity" class="btn btn-dark btn-sm">
                                            Activity
                                          </a>
                                           @endif
                            
                                      
                                     
                                      <a href="{{route('leads.convert',[$list->id,$list->status])}}" class="btn btn-info btn-sm">
                                        Convert
                                      </a> 
                                      @elseif($list->status == 1)
                                      <a href="javascript:void(0)"  onclick="converted('{{$list->lead_name}}','{{$list->mobile}}')" class="btn btn-primary btn-sm">
                                        Converted
                                      </a> 
                                      @endif
                                    </td>                                                                                                  
                                     </tr>        
                                                                            
                                @endforeach                         
                            </tbody>
                        </table>
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   

  

  

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h1>Sorry, you cannot access the Lead.</h1>
            <p>The Lead you are trying to access has been converted already.</p>   
            <b>Conversion Details :</b> 
            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>Account</th>
                        <th>Contact</th>
                    </tr>
                </thead> 
                <tbody>                  
                    <tr>                        
                         <td><h5 class="modal-title" id="lead_name"></h5>                        
                        </td>  
                        <td><h5 class="modal-title" id="lead_mobile"></h5>                        
                        </td>                                                                                                 
                         </tr>                     
                </tbody>
            </table>      
        </div>

        </div>
    </div>
    </div>            
@endsection            
