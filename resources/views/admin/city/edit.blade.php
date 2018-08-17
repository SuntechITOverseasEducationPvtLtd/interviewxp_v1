@extends('admin.layout.master')                


    @section('main_content')

    
    <!-- BEGIN Page Title -->
<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
                      </div>
            </div>

  
 
      <div class="box-content">
          @include('admin.layout._operation_status')  
           {!! Form::open([ 'url' => $module_url_path.'/update',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}

           <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">State<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="state_id" data-rule-required="true"  >
                      <option value="">--Select State--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $key => $value)
                          <option @if($arr_city['state_id']==$value['id']) selected="" @endif value="{{ $value['id'] }}">{{ $value['state_name'] }}</option>
                        @endforeach
                      @endif
                    </select>
                    <span class="help-block">{{ $errors->first('state_id') }}</span>
                </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">City<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="city_name" placeholder="Enter City" data-rule-required="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_city['city_name'])?$arr_city['city_name']:'' }}" />
                      <span class="help-block">{{ $errors->first('city_name') }}</span>
                  </div>
            </div>

            <input type="hidden" name="enc_id" value="{{isset($enc_id)?$enc_id:''}}"  >


            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
               
                {!! Form::submit('Save',['class'=>'btn btn btn-primary','value'=>'true'])!!}
                
              </div>
            </div>
    
          {!! Form::close() !!}
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->     
@stop                    
