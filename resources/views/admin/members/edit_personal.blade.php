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
           {!! Form::open([ 'url' => $module_url_path.'/update',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}
           <?php $current_year = date('Y') ?>
           @if(isset($arr_data) && sizeof($arr_data)>0)
            <!-- <div class="form-group" style="margin-top: 25px;">
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
-->
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
                      
                        <option value="01" @if($birth_month=='01') selected="" @endif>Jan</option>
                        <option value="02" @if($birth_month=='02') selected="" @endif>Feb</option>
                        <option value="03" @if($birth_month=='03') selected="" @endif>Mar</option>
                        <option value="04" @if($birth_month=='04') selected="" @endif>Apr</option>
                        <option value="05" @if($birth_month=='05') selected="" @endif>May</option>
                        <option value="06" @if($birth_month=='06') selected="" @endif>Jun</option>
                        <option value="07" @if($birth_month=='07') selected="" @endif>Jul</option>
                        <option value="08" @if($birth_month=='08') selected="" @endif>Aug</option>
                        <option value="09" @if($birth_month=='09') selected="" @endif>Sep</option>
                        <option value="10" @if($birth_month=='10') selected="" @endif>Oct</option>
                        <option value="11" @if($birth_month=='11') selected="" @endif>Nov</option>
                        <option value="12" @if($birth_month=='12') selected="" @endif>Dec</option> 
                         
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
            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Training Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="training_tab" @if($arr_data['training_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('gender') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Company Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="company_qa_tab" @if($arr_data['company_qa_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('gender') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Real Time Issues Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="real_issues_qa_tab" @if($arr_data['real_issues_qa_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('gender') }}</span>
                  </div>
            </div>
			
			<div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Company Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="company_qa_tab" @if($arr_data['company_qa_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('gender') }}</span>
                  </div>
            </div>
			
			<div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Combo Company Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="combo_company_tab" @if($arr_data['combo_company_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('combo_company_tab') }}</span>
                  </div>
            </div>
			
			<div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Combo QA Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="combo_qa_tab" @if($arr_data['combo_qa_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('combo_qa_tab') }}</span>
                  </div>
            </div>
			
			<div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Combo Real issues Tab</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="checkbox" name="combo_realissues_tab" @if($arr_data['combo_realissues_tab']=='1') checked="" @endif value="1" >
                      
                      <span class="help-block">{{ $errors->first('combo_realissues_tab') }}</span>
                  </div>
            </div>

            <div class="error_msg" id="err_gender"></div>

             <div class="form-group">
                <label class="col-sm-3 col-lg-2 control-label"> Profile Image <i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-10 controls">
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px; text-align:center">
                        <img style="height: 100%;" src= {{ $user_profile_public_img_path.$arr_data['profile_image']}}  alt="" />
                          
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