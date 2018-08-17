@extends('admin.layout.master')    
@section('main_content')
<!-- BEGIN Page Title -->


<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->


<div class="row">
  <div class="col-md-8 col-md-offset-2">



<div class="panel panel-flat">
                  <div class="panel-heading">
                    <h5 class="panel-title">  </i>{{ isset($page_title)?$page_title:"" }} <a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
                    <div class="heading-elements">
                      <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                              </ul>
                            </div>
                  </div>












  <div class="panel-body">
      <div class="box-content">
        @include('admin.layout._operation_status')
        {!! Form::open([ 'url' => $module_url_path.'/update_manage_email/'.base64_encode($arr_data['id']),
        'method'=>'POST',   
        'class'=>'form-horizontal', 
        'id'=>'validation-form' 
        ]) !!}
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">General Email
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('general_email',$arr_email[0]['general_email'],['class'=>'form-control','data-rule-required'=>'true','data-rule-email'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'General Email']) !!}
            <span class='help-block'>{{ $errors->first('general_email') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Opening Mail
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('opening_email',$arr_email[0]['opening_email'],['class'=>'form-control','data-rule-required'=>'true','data-rule-email'=>'true','data-rule-maxlength'=>'255', 'placeholder'=>'Opening Mail']) !!}
            <span class='help-block'>{{ $errors->first('opening_email') }}
            </span>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 col-lg-2 control-label">Hr Email
            <i class="red">*
            </i>
          </label>
          <div class="col-sm-9 col-lg-4 controls">
            {!! Form::text('hr_mail',$arr_email[0]['hr_mail'],['class'=>'form-control', 'data-rule-required'=>'true', 'data-rule-email'=>'true', 'data-rule-maxlength'=>'255', 'placeholder'=>'Hr Email']) !!}
            <span class='help-block'>{{ $errors->first('hr_mail') }}
            </span>
          </div>
        </div>
        <input type="hidden" name="enc_id" value="{{$arr_email[0]['id'] or '-'}}">
        <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
            {!! Form::submit('Update',[ 'class'=>'btn btn btn-primary','value'=>'true'])!!}
          </div>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- END Main Content -->
  @endsection
