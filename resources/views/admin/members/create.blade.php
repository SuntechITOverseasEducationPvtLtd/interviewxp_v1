    @extends('admin.layout.master')                


    @section('main_content')





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
           {!! Form::open([ 'url' => $module_url_path.'/store',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}
           <?php $current_year = date('Y') ?>
            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Firstname<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="first_name" placeholder="Enter Firstname" data-rule-required="true" data-rule-lettersonly="true"  value="{{ old('first_name') }}" />
                      <span class="help-block">{{ $errors->first('first_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Lastname<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="last_name" placeholder="Enter Lastname" data-rule-required="true" data-rule-lettersonly="true" value="{{ old('last_name') }}" />
                      <span class="help-block">{{ $errors->first('last_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Email<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="email" placeholder="Enter Email" data-rule-required="true" data-rule-email="true" value="{{ old('email') }}" />
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Password<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="password" class="form-control" name="password" placeholder="Enter Password" data-rule-required="true" value="{{ old('password') }}" />
                      <span class="help-block">{{ $errors->first('password') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Mobile No<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile No." data-rule-required="true" data-rule-digits="true" data-rule-maxlength="10" data-rule-minlength="10" value="{{ old('mobile_no') }}" />

                      <span class="help-block">{{ $errors->first('mobile_no') }}</span>
                  </div>
            </div>

            
                
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Birth Date</label>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="date" data-rule-required="true"  >
                      <option value="">Date</option>
                      @for($i=1;$i<=31;$i++) 
                      <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}"> {{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                      @endfor
                    </select>
                    <span class="help-block">{{ $errors->first('date') }}</span>
                </div>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="month" data-rule-required="true"  >
                      <option value="">Month</option>
                      
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                         
                    </select>
                    <span class="help-block">{{ $errors->first('month') }}</span>
                </div>
                
                
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="year" data-rule-required="true"  >
                      <option value="">Year</option>
                      @for($i=$current_year-23;$i>=1976;$i--) 
                      <option value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                    <span class="help-block">{{ $errors->first('year') }}</span>
                </div>
                </div>

                <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Gender<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="radio" name="gender" value="M" >Male
                      <input type="radio" name="gender" value="F">Female

                      <span class="help-block">{{ $errors->first('gender') }}</span>
                  </div>
            </div>
            <div class="error_msg" id="err_gender"></div>

             <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"> Profile Image </label>
                <div class="col-sm-9 col-lg-10 controls">
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                          
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
