    @extends('admin.layout.master')                
    @section('main_content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/admin/jquery.tokenize.css"/>

<script type="text/javascript" src="{{url('/')}}/js/admin/jquery.tokenize.js">
    
</script>
    
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
            <li class="active"><i class="fa fa-plus-square-o"></i> {{ $page_title or ''}}</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->



    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
          <div class="box {{ $theme_color }}">
            <div class="box-title">
              <h3>
                <i class="fa fa-plus-square-o"></i>
                {{ isset($page_title)?$page_title:"" }}
              </h3>
              <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
              </div>
            </div>
            <div class="box-content">

          @include('admin.layout._operation_status')  
           {!! Form::open([ 'url' => $module_url_path.'/store_employment',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}
           <?php $current_year = date('Y') ?>
            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Job Skills<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <select id="skill_id" name="skills[]" data-rule-required="true" multiple="multiple" >
                      </select>
                      <span class="help-block">{{ $errors->first('skills') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Experience</label>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="experience_year" data-rule-required="true"  >
                      <option value="">Years</option>
                      @for($i=0;$i<=20;$i++) 
                      <option value="{{$i}}"> {{$i}}</option>
                      @endfor
                        
                    </select>
                    <span class="help-block">{{ $errors->first('experience_year') }}</span>
                </div>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="experience_month" data-rule-required="true"  >
                      <option value="">Month</option>
                      @for($i=0;$i<=11;$i++) 
                      <option value="{{$i}}"> {{$i}}</option>
                      @endfor   
                    </select>
                    <span class="help-block">{{ $errors->first('experience_month') }}</span>
                </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Current Employer<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="employer_name" placeholder="Enter Companyname" data-rule-required="true" data-rule-lettersonly="true" value="{{ old('company_name') }}" />
                      <span class="help-block">{{ $errors->first('employer_name') }}</span>
                  </div>
            </div>

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label"><i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      
                      <input type="radio" onclick="employertype();" name="employer_type" value="current" >Current Employer
                      <input type="radio" onclick="employertype();" name="employer_type" value="previous">Previous Employer

                      <span class="help-block">{{ $errors->first('employer_type') }}</span>
                  </div>
            </div>

            <div class="error_msg" id="err_employer"></div>

            <div id="current_employer" style="display:none;">
                      <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">Duration<span class="star">*</span></label>
                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="current_start_month" data-rule-required="true">
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
                                    <span class="help-block">{{ $errors->first('start_month') }}</span> 
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="current_start_year" data-rule-required="true" >
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <div id="err_duration_year" class="error"></div>
                                   <div class="error">{{ $errors->first('start_year') }}</div> 
                                 </div>
                              </div>
                              {{-- <div class="duration-to">To</div> --}}
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="current_end_month"  >
                                       <option value="Present">Present</option>
                                    </select> 
                                     <span class="help-block">{{ $errors->first('end_month') }}</span> 
                                 </div>
                              </div>
                              
                           </div>
                        </div>
                     </div>
                     
                     <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">Designation<span class="star">*</span></label>
                        <div class="col-sm-9 col-lg-4 controls" >
                        <input type="text" class="form-control" id="current_designation" placeholder="Enter Your Designation" name="current_designation" value="{{ old('designation') }}" data-rule-required="true" />
                        <span class="help-block">{{ $errors->first('current_designation') }}</span>
                        </div>
                     </div>
                     </div>
                     <!--end current employer type -->

                     <div id="previous_employer" style="display:none;">
                    <input type="button" id="add_more" class="btn btn btn-primary" value="+add another employment" />
                      <div id="previous_clone">
                        <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">Designation<span class="star">*</span></label>
                        <div class="col-sm-9 col-lg-4 controls" >
                        <input class="form-control" type="text" id="previous_designation" class="input-box-signup" placeholder="Enter Your Designation" name="previous_designation[]" value="{{ old('designation') }}" data-rule-required="true" />
                        
                        <span class="help-block">{{ $errors->first('previous_designation') }}</span>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">Company Name<span class="star">*</span></label>
                        <div class="col-sm-9 col-lg-4 controls" >
                        <input class="form-control"  id="previous_company_name" name="company_name[]" placeholder="Enter Company Name"  value="{{ old('company_name') }}" data-rule-required="true"/>
                        
                        <span class="help-block">{{ $errors->first('company_name') }}</span>
                        </div>
                        </div>

                        <div class="form-group">
                        <label class="col-sm-3 col-lg-2 control-label">Duration<span class="star">*</span></label>
                        <div class="duration">
                           <div class="row">
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="previous_start_month[]" data-rule-required="true" >
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
                                    <span class="help-block">{{ $errors->first('previous_start_month') }}</span>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="previous_start_year[]" id="previous_start_year" data-parsley-required="true" >
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                   <span class="help-block">{{ $errors->first('previous_start_year') }}</span> 
                                 </div>
                              </div>
                              {{-- <div class="duration-to">To</div> --}}
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="previous_end_month[]" id="previous_end_month" data-rule-required="true" >
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
                                     <span class="help-block">{{ $errors->first('previous_end_month') }}</span>
                                 </div>
                              </div>
                              <div class="col-sm-2">
                                 <div class="select-number">
                                    <select class="form-control" name="previous_end_year[]" id="previous_end_year" data-rule-required="true" >
                                       <option value="">Year</option>
                                     @for($i=$current_year;$i>=1976;$i--) 
                                     <option value="{{$i}}"> {{$i}}</option>
                                     @endfor
                                    </select>
                                    <span class="help-block">{{ $errors->first('previous_end_year') }}</span> 
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     
                     </div>

                    </div>

                    <!-- end previous empoyer type-->


            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Current Work Location<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="city"  >
                      <option value="">--Select City--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $state)
                        <optgroup label="{{$state['state_name']}}">
                        @if(isset($state['city']) && sizeof($state['city'])>0)
                          @foreach($state['city'] as $city)
                          <option value="{{ $city['city_id'] }}">{{ $city['city_name'] or '-' }}</option>
                          @endforeach
                        @endif  
                        </optgroup>    
                        @endforeach
                      @endif
                    </select>
                    <span class="help-block">{{ $errors->first('city') }}</span>
                </div>
            </div> 

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Upload Your Resume<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                <input type="file" name="resume" >
                </div>
            </div>
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-lg-4 controls" >
                Note: Allowed File type: docx , doc , pdf. maximum size 500 kb
                </div>
            </div>    
            <input type="hidden" name="enc_id" value="{{$enc_id or '-'}}">
            <input type="hidden" name="type" value="{{$type}}">
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
<script type="text/javascript">
  $(document).ready(function()
  {
    $('#skill_id').tokenize(
      {
        newElements:false,
        datas: site_url+'/admin/members/get_skills',
            textField:'skill_name',
            valueField:'id'
            
        });

   });

</script>

<script type="text/javascript">
     function employertype()
     {
        var value_employertype = $("input[name='employer_type']:checked").val();
     //  alert(value_cardtype);
        if(value_employertype=='current')
        {
          $('#previous_employer').hide();
          $('#current_employer').show(); 
        }
        if(value_employertype=='previous')
        {
          $('#current_employer').hide();  
          $('#previous_employer').show();
        }
     }
</script>
<script type="text/javascript">
  var count = 1;  
    $("#add_more").click(function()
    {
      if(count < 3)
      {
        $("#previous_clone").clone().appendTo("#previous_employer");
        count++;
      }
      if(count > 2)
      {
        $("#add_more").hide();
      }  
    });
  </script>
@stop                    
