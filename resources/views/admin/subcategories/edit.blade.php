@extends('admin.layout.master')                


    @section('main_content')

    
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ url($admin_panel_slug.'/dashboard') }}" class="call_loader">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span>
            <li>
                <i class="fa fa-list-alt"></i>
                <a href="{{ $module_url_path }}" class="call_loader">{{ $module_title or ''}}</a>
            </li>   
            <span class="divider">
                <i class="fa fa-angle-right"></i>
            </span>
            <li class="active"><i class="fa fa-edit"></i> {{ $page_title or ''}}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->



    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
          <div class="box {{ $theme_color }}">
            <div class="box-title">
              <h3>
                <i class="fa fa-edit"></i>
                {{ isset($page_title)?$page_title:"" }}
              </h3>
              <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
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
                <label class="col-sm-3 col-lg-2 control-label">Category<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="category_id" data-rule-required="true"  >
                      <option value="">--Select Category--</option>
                      @if(isset($arr_category) && count($arr_category)>0)
                        @foreach($arr_category as $key => $value)
                          <option @if($arr_subcategory['category_id']==$value['id']) selected="" @endif value="{{ $value['id'] }}">{{ $value['category_name'] }}</option>
                        @endforeach
                      @endif
                    </select>
                    <span class="help-block">{{ $errors->first('role') }}</span>
                </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Subcategory<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="subcategory_name" placeholder="Enter Category" data-rule-required="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_subcategory['subcategory_name'])?$arr_subcategory['subcategory_name']:'' }}" />
                      <span class="help-block">{{ $errors->first('subcategory_name') }}</span>
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
