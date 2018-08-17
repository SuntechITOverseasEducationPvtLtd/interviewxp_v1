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
                <i class="fa fa-video-camera"></i>
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

           @if(isset($arr_data) && count($arr_data) > 0)   


            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Title<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="title" readonly="" placeholder="Enter title" data-rule-required="true"   value="{{ $arr_data['title'] or 'NA' }}" />
                      <span class="help-block">{{ $errors->first('title') }}</span>
                  </div>
            </div>

            <div class="form-group" {{-- style="margin-top: 25px;" --}}>
                  <label class="col-sm-3 col-lg-2 control-label">Description<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <textarea  class="form-control" name="description" placeholder="Enter Description" data-rule-required="true"/>
                        {{$arr_data['description'] or 'NA'}}
                      </textarea>
                      <span class="help-block">{{ $errors->first('description') }}</span>
                  </div>
            </div>

            
            <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label">Profile Image<i style="color: red;">*</i> </label>
              <div class="col-sm-9 col-lg-10 controls">
                 <div class="fileupload fileupload-new" data-provides="fileupload">
                   <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                      <img src={{ $advertise_public_image_path.$arr_data['advertise_image']}} alt="" />  
                  </div>
                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
                         {{-- <img src={{ $user_profile_public_img_path.$arr_data['profile_image']}} alt="" /> --}}  
                    </div>
                    <div>
                       <span class="btn btn-default btn-file"><span class="fileupload-new" >Select Image</span> 
                       <span class="fileupload-exists">Change</span>
                       
                       {!! Form::file('advertise_image',['id'=>'advertise_image','class'=>'file-input','data-rule-required'=>'']) !!}

                       </span> 
                       <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                       <span>
                       </span> 
                    </div>
                 </div>
                
                @if($slug == 'right_advertise')
                 <i style="color:#ff6666;">Please upload image of size(271x190) . Support Formats: jpg, jpeg, png, bmp.</i> 
                @elseif($slug == 'bottom_advertise')
                    <i style="color:#ff6666;">Please upload image of size(971x187) . Support Formats: jpg, jpeg, png, bmp.</i> 
                @endif    

                  <span class='help-block'><b>{{ $errors->first('advertise_image') }}</b></span>  
              </div>
            </div>
             <input type="hidden" name="advt_slug" value="{{isset($slug)?$slug:''}}">
             <input type="hidden" name="enc_id" value="{{isset($enc_id)?$enc_id:''}}">

            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
               
                {!! Form::submit('Save',['class'=>'btn btn btn-primary','value'=>'true'])!!}
                &nbsp;
                {{-- <a class="btn btn-primary call_loader" href="{{ $module_url_path }}">Back</a> --}}
              </div>
            </div>

            @else 
              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                  <h3><strong>No Record found..</strong></h3>     
                </div>
              </div>
            @endif
    
          {!! Form::close() !!}
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->

@stop                    
