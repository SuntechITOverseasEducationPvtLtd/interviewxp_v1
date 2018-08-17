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
                <i class="fa fa-users"></i>
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
           <?php $current_year = date('Y') ?>
           @if(isset($arr_data) && sizeof($arr_data)>0)
            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Firstname<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="first_name" placeholder="Enter Firstname" data-rule-required="true" data-rule-lettersonly="true"  value="{{ isset($arr_data['first_name'])?$arr_data['first_name']:'NA' }}" />
                      <span class="help-block">{{ $errors->first('first_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Lastname<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="last_name" placeholder="Enter Lastname" data-rule-required="true" data-rule-lettersonly="true" value="{{ isset($arr_data['last_name'])?$arr_data['last_name']:'NA' }}" />
                      <span class="help-block">{{ $errors->first('last_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Email<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="email" placeholder="Enter Email" data-rule-required="true" data-rule-email="true" value="{{ isset($arr_data['email'])?$arr_data['email']:'NA' }}" />
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  </div>
            </div>

             <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Mobile No<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No." data-rule-required="true" data-rule-digits="true" data-rule-maxlength="10" data-rule-minlength="10" value="{{ isset($arr_data['mobile_no'])?$arr_data['mobile_no']:'NA' }}" />

                      <span class="help-block">{{ $errors->first('mobile_no') }}</span>
                  </div>
            </div>
    
                
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Birth Date</label>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="date" data-rule-required="true"  >
                      <option value=""></option>

                      @for($i=1;$i<=31;$i++) 
                      <option @if($birth_date==str_pad($i, 2, '0', STR_PAD_LEFT)) selected="" @endif value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}"> {{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                      @endfor
                    </select>
                    <span class="help-block">{{ $errors->first('date') }}</span>
                </div>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="month" data-rule-required="true"  >
                      <option value="">Month</option>
                      
                        <option @if($birth_month==01) selected="" @endif value="01">Jan</option>
                        <option @if($birth_month==02) selected="" @endif value="02">Feb</option>
                        <option @if($birth_month==03) selected="" @endif value="03">Mar</option>
                        <option @if($birth_month==04) selected="" @endif value="04">Apr</option>
                        <option @if($birth_month==05) selected="" @endif value="05">May</option>
                        <option @if($birth_month==06) selected="" @endif value="06">Jun</option>
                        <option @if($birth_month==07) selected="" @endif value="07">Jul</option>
                        <option @if($birth_month==08) selected="" @endif value="08">Aug</option>
                        <option @if($birth_month==09) selected="" @endif value="09">Sep</option>
                        <option @if($birth_month==10) selected="" @endif value="10">Oct</option>
                        <option @if($birth_month==11) selected="" @endif value="11">Nov</option>
                        <option @if($birth_month==12) selected="" @endif value="12">Dec</option> 
                         
                    </select>
                    <span class="help-block">{{ $errors->first('month') }}</span>
                </div>
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="year" data-rule-required="true"  >
                      <option value="">Year</option>
                      @for($i=$current_year;$i>=1976;$i--) 
                      <option @if($birth_year==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                    <span class="help-block">{{ $errors->first('year') }}</span>
                </div>
                </div>

                <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Gender<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="radio" name="gender" @if($arr_data['gender']=='M') checked="" @endif value="M" >Male
                      <input type="radio" name="gender" @if($arr_data['gender']=='F') checked="" @endif value="F">Female

                      <span class="help-block">{{ $errors->first('gender') }}</span>
                  </div>
            </div>

            <div class="error_msg" id="err_gender"></div>

             <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"> Profile Image <i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-10 controls">
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                        <img src= {{ $user_profile_public_img_path.$arr_data['profile_image']}}  alt="" />
                          
                      </div>
                      <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                         <span class="btn btn-default btn-file"><span class="fileupload-new" >Select Image</span> 
                         <span class="fileupload-exists">Change</span>
                         
                         {!! Form::file('profile_image',['id'=>'image_proof','class'=>'file-input','data-rule-required'=>'']) !!}

                         </span> 
                         <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                         <span>
                         </span> 
                      </div>
                   </div>
                    <span class='help-block'>{{ $errors->first('profile_image') }}</span>  
                </div>
            </div>
            @endif

            <input type="hidden" name="enc_id" value="{{$enc_id or '-'}}">

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