    @extends('admin.layout.master')                


    @section('main_content')
<style type="text/css">
                          .rounded-box {
                                  border-radius: 0%;
                                  height: 67px;
                                  overflow: hidden;
                                  width: 80px;
                                  float: left;
                          }
                          .rounded-box img {
                              border-radius: 50%;
                              float: left;
                              height: 73%;
                              width: 73%;
                          }
                           .proimgset {
                                height: 60px !important;
    width: 60px !important;
                          }
                           .table td {   padding: 2px 7px !important; }
                           p {
    margin: 0 0 3px; }
                        </style>



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
           {!! Form::open([ 'url' => $module_url_path.'/store_upload_approvals_comment',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}


            <div class="form-group" >
                  <label class="col-sm-3 col-lg-2 control-label">Comment<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <textarea  style="height:200px; width:800px;" class="form-control" name="comment" placeholder="Enter Comment" data-rule-required="true" data-rule-maxlength="200"/>{{$arr_comment_info or ''}}</textarea>
                      <span class="help-block">{{ $errors->first('comment') }}</span>
                  </div>
            </div>

            <input type="hidden" name="enc_id" value="{{isset($enc_id)?$enc_id:''}}">
            <input type="hidden" name="interview_id" value="{{isset($interview_id)?$interview_id:''}}">
            <input type="hidden" name="comment_status" value="{{isset($comment_status)?$comment_status:''}}">


            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
               
                {!! Form::submit('Save',['class'=>'btn btn btn-primary','value'=>'true'])!!}
                &nbsp;
                {{-- <a class="btn btn-primary call_loader" href="{{ $module_url_path }}">Back</a> --}}
              </div>
            </div>

            
    
          {!! Form::close() !!}
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->

@stop                    
