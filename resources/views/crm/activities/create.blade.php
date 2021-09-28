@extends('layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-wrap">
                        <h2 class="title-1">Create Activity</h2><br/><br/>
                        <!--button class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add item</button-->                           
                    </div>
                </div>
                <div class="col-md-6 text-right mb-2">
                    <a href="{{route('activities')}}" class="btn btn-primary btn-md">
                       Back
                    </a>
                </div>
            </div>
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            @endforeach
            @endif
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
            <form action="{{route('activities.store',$lead_id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Activity Information</strong>
                        </div>
                        <div class="card-body card-block">              
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="subject" class=" form-control-label">Subject</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="subject" placeholder="Enter Subject" class="form-control">
                                        @error('subject')
                                        <small class="help-block form-text text-danger">{{$message}}</small>  
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="due_date" class=" form-control-label">Due Date</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="due_date" name="due_date" placeholder="Enter Due Date" class="form-control">
                                        <small class="help-block form-text"></small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="account_id" class=" form-control-label">Account</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="account_id" id="account_id" class="form-control">
                                            <option value="0">Please select</option>
                                            @foreach ($accounts as $list)
                                            <option value="{{$list->id}}">{{$list->account_name}}</option>
                                            @endforeach                                 
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="disabled-input" class=" form-control-label">Disabled Input</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="disabled-input" name="disabled-input" placeholder="Disabled" disabled="" class="form-control">
                                    </div>
                                </div> --}}
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Textarea</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <textarea name="textarea-input" id="textarea-input" rows="9" placeholder="Content..." class="form-control"></textarea>
                                    </div>
                                </div> --}}
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="contact_id" class=" form-control-label">Contact</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="contact_id" id="contact_id" class="form-control">
                                            <option value="0">Please select</option>
                                            @foreach ($contacts as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach                                       
                                        </select>
                                    </div>
                                </div>                              
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="status_id" class=" form-control-label">Status</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="status_id" id="status_id" class="form-control">                                 
                                            <option value="0">Please select</option>
                                            @foreach ($activities_status as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach                                                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="priority_id" class=" form-control-label">Priority</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="priority_id" id="priority_id" class="form-control">                                 
                                            <option value="0">Please select</option>
                                            @foreach ($priority as $list)
                                            <option value="{{$list->id}}">{{$list->name}}</option>
                                            @endforeach                    
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="description" class=" form-control-label">Description</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="description" name="description" placeholder="Enter Due Date" class="form-control">
                                        <small class="help-block form-text"></small>
                                    </div>
                                </div>                                
                                
                        </div>

                    </div>
                </div>                       	
            </div>
            <div class="card-footer">
                <input type="submit" name="submit" value="submit" class="btn btn-primary btn-lg">
                <button type="reset" class="btn btn-danger btn-lg">
                    <i class="fa fa-ban"></i> Reset
                </button>
            </div>
        </form>		
        </div>
    </div>
</div>        
@endsection