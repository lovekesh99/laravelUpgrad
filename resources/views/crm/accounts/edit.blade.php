@extends('layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="overview-wrap">
                        <h2 class="title-1">Edit Account</h2><br/><br/>
                        <!--button class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add item</button-->                           
                    </div>
                </div>
                <div class="col-md-6 text-right mb-2">
                    <a href="{{route('accounts')}}" class="btn btn-primary btn-md">
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
            <form action="{{route('accounts.update',$account_data->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Account Information</strong>
                        </div>
                        <div class="card-body card-block">    
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Account Image</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file"  name="account_image" class="form-control">
                                        @error('account_image')
                                        <small class="help-block form-text text-danger">{{$message}}</small> 
                                        @enderror
                                        @if($account_data->account_image!='')
                                        <img src="{{URL::to('storage/'."$account_data->account_image")}}" alt="" width="100"/>
                                        @else
                                        <h5 class="text-danger mt-2">Please Upload Account Image </h5>
                                        @endif
                                    </div>
                                </div>           
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class="form-control-label">Account Owner</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <p class="form-control-static">{{session('USER_NAME')}}</p>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="account_name" class=" form-control-label">Account Name</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="text-input" name="account_name" placeholder="Enter Account Name" class="form-control" value="{{$account_data->account_name}}">
                                        @error('account_name')
                                        <small class="help-block form-text text-danger">{{$message}}</small> 
                                        @enderror
                                    </div>
                                </div>                               
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="account_site" class=" form-control-label">Account Site</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="account_site" name="account_site" placeholder="Enter Account Site " class="form-control" value="{{$account_data->account_site}}">
                                        <small class="help-block form-text"></small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="account_number" class=" form-control-label">Account Number</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="account_number" name="account_number" placeholder="Enter Account Number " class="form-control" value="{{$account_data->account_number}}">
                                        <small class="help-block form-text"></small>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="account_type_id" class=" form-control-label">Account Type</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="account_type_id" id="account_type_id" class="form-control">
                                            <option value="">Please select</option>
                                            @foreach ($account_type as $list)
                                            @if($account_data->account_type_id == $list->id)
                                            <option value="{{$list->id}}" selected>{{$list->name}}</option> 
                                            @else  
                                            <option value="{{$list->id}}">{{$list->name}}</option> 
                                            @endif
                                            @endforeach                                                                             
                                        </select>
                                    </div>
                                </div>                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="mobile" class=" form-control-label">Mobile</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile" class="form-control" value="{{$account_data->mobile}}">
                                        <small class="help-block form-text"></small>
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
                                        <label for="industry" class=" form-control-label">Industry</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="industry_id" id="industry_id" class="form-control">  
                                            <option value="">Please select</option>                                        
                                            @foreach ($industry_data as $list)                                         
                                            @if ($account_data->industry_id == $list->id)
                                            <option value="{{$list->id}}" selected>{{$list->name}}</option>   
                                            @else
                                           <option value="{{$list->id}}">{{$list->name}}</option>   
                                            @endif                                                        
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="revenue" class=" form-control-label">Revenue</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="text" id="revenue" name="revenue" placeholder="Enter Revenue" class="form-control" value="{{$account_data->revenue}}">
                                        <small class="help-block form-text"></small>
                                    </div>
                                </div>                                                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="rating_id" class=" form-control-label">Rating</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="rating_id" id="rating_id" class="form-control">
                                            <option value="">Please select</option>  
                                            @foreach ($rating_data as $list)
                                            @if ($account_data->rating_id == $list->id)
                                            <option value="{{$list->id}}" selected>{{$list->name}}</option>        
                                            @endif
                                            <option value="{{$list->id}}">{{$list->name}}</option>       
                                            @endforeach                                                                     
                                        </select>
                                    </div>
                                </div>                                
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="multiple-select" class=" form-control-label">Multiple select</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <select name="multiple-select" id="multiple-select" multiple="" class="form-control">
                                            <option value="1">Option #1</option>
                                            <option value="2">Option #2</option>
                                            <option value="3">Option #3</option>
                                            <option value="4">Option #4</option>
                                            <option value="5">Option #5</option>
                                            <option value="6">Option #6</option>
                                            <option value="7">Option #7</option>
                                            <option value="8">Option #8</option>
                                            <option value="9">Option #9</option>
                                            <option value="10">Option #10</option>
                                        </select>
                                    </div>
                                </div> --}}
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Radios</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check">
                                            <div class="radio">
                                                <label for="radio1" class="form-check-label ">
                                                    <input type="radio" id="radio1" name="radios" value="option1" class="form-check-input">Option 1
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio2" class="form-check-label ">
                                                    <input type="radio" id="radio2" name="radios" value="option2" class="form-check-input">Option 2
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label for="radio3" class="form-check-label ">
                                                    <input type="radio" id="radio3" name="radios" value="option3" class="form-check-input">Option 3
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label class=" form-control-label">Inline Checkboxes</label>
                                    </div>
                                    <div class="col col-md-9">
                                        <div class="form-check-inline form-check">
                                            <label for="inline-checkbox1" class="form-check-label ">
                                                <input type="checkbox" id="inline-checkbox1" name="inline-checkbox1" value="option1" class="form-check-input">One
                                            </label>
                                            <label for="inline-checkbox2" class="form-check-label ">
                                                <input type="checkbox" id="inline-checkbox2" name="inline-checkbox2" value="option2" class="form-check-input">Two
                                            </label>
                                            <label for="inline-checkbox3" class="form-check-label ">
                                                <input type="checkbox" id="inline-checkbox3" name="inline-checkbox3" value="option3" class="form-check-input">Three
                                            </label>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-input" class=" form-control-label">File input</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-input" name="file-input" class="form-control-file">
                                    </div>
                                </div> --}}
                                {{-- <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="file-multiple-input" class=" form-control-label">Multiple File input</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <input type="file" id="file-multiple-input" name="file-multiple-input" multiple="" class="form-control-file">
                                    </div>
                                </div> --}}
                            
                        </div>

                    </div>
                </div>
				
                           <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">                  
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="employees" class=" form-control-label">Employees</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="employees" name="employees" placeholder="Enter Employees" class="form-control" value="{{$account_data->employees}}">
                                                  @error('employees')
                                                    <small class="help-block form-text text-danger">{{$message}}</small>
                                                  @enderror
                                                </div>
                                            </div> 
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="ownership_id" class=" form-control-label">Ownership</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <select name="ownership_id" id="ownership_id" class="form-control">
                                                        <option value="">Please select</option>  
                                                        @foreach ($ownership_data as $list)
                                                            @if ($account_data->ownership_id == $list->id)
                                                            <option value="{{$list->id}}" selected>{{$list->name}}</option>   
                                                            @else
                                                             <option value="{{$list->id}}">{{$list->name}}</option>  
                                                             @endif
                                                        @endforeach                                                                                         
                                                    </select>
                                                </div>
                                            </div> 
                                    </div>
                                </div>                          
                                <div class="card">
                                    <div class="card-header">
                                    <strong>Description Information</strong>
                                    </div>
                                    <div class="card-body">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="description" class=" form-control-label">Description</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="description" id="description" name="description" placeholder="Enter Description" class="form-control" value="{{$account_data->description}}">
                                                    <small class="help-block form-text"></small>
                                                </div>
                                            </div>                                                                                                                              
                                    </div>
                                </div>                           
                            </div>	                           
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                    <strong>Address Information</strong>
                                    </div>
                                    <div class="card-body">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="street" class=" form-control-label">Mailing Street</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="street" id="street" name="street" placeholder="Enter Street" class="form-control" value="{{$account_data->street}}">
                                                    <small class="help-block form-text"></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="state" class=" form-control-label">Mailing State</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="state" id="state" name="state" placeholder="Enter State" class="form-control" value="{{$account_data->state}}">
                                                    <small class="help-block form-text"></small>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="country" class=" form-control-label">Mailing Country</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="country" id="country" name="country" placeholder="Enter Country" class="form-control" value="{{$account_data->country}}">
                                                    <small class="help-block form-text"></small>
                                                </div>
                                            </div> 
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="city" class=" form-control-label">Mailing City</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="city" id="city" name="city" placeholder="Enter City" class="form-control" value="{{$account_data->city}}">
                                                    <small class="help-block form-text"></small>
                                                </div>
                                            </div> 
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="zip_code" class=" form-control-label">Mailing ZipCode</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="zip_code" id="zip_code" name="zip_code" placeholder="Enter Zip Code" class="form-control" value="{{$account_data->zip_code}}">
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