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
           {!! Form::open([ 'url' => $module_url_path.'/store_education',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}
           <?php $current_year = date('Y') ?>
           @if(isset($arr_data) && sizeof($arr_data)>0)
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Highest Qualification<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="qualification_id" data-rule-required="true" id="qualification_id" onchange="loadSpecialization(this);"  >
                      <option value="">--Select Qualification--</option>
                      @if(isset($arr_qualification) && count($arr_qualification)>0)
                        @foreach($arr_qualification as $qualification)
                        <option @if($arr_data['qualification_id']==$qualification['id']) selected="" @endif value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                        @endforeach
                        @endif  
                    </select>
                    <span class="help-block">{{ $errors->first('qualification_id') }}</span>
                </div>
            </div>

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Select Specialization<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="specialization_id" data-rule-required="true"   >
                      <option value="{{$arr_data['specialization_id']}}">{{$arr_data['specialization']}}</option>
                      
                    </select>
                    <span class="help-block">{{ $errors->first('specialization_id') }}</span>
                </div>
                </div>

                <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="passing_month" data-rule-required="true"  >
                      <option value="">Passing Month</option>
                      
                        <option @if($arr_data['passing_month']=='jan') selected="" @endif value="jan">Jan</option>
                        <option @if($arr_data['passing_month']=='feb') selected="" @endif value="feb">Feb</option>
                        <option @if($arr_data['passing_month']=='mar') selected="" @endif value="mar">Mar</option>
                        <option @if($arr_data['passing_month']=='apr') selected="" @endif value="apr">Apr</option>
                        <option @if($arr_data['passing_month']=='may') selected="" @endif value="may">May</option>
                        <option @if($arr_data['passing_month']=='jun') selected="" @endif value="jun">Jun</option>
                        <option @if($arr_data['passing_month']=='jul') selected="" @endif value="jul">Jul</option>
                        <option @if($arr_data['passing_month']=='aug') selected="" @endif value="aug">Aug</option>
                        <option @if($arr_data['passing_month']=='sep') selected="" @endif value="sep">Sep</option>
                        <option @if($arr_data['passing_month']=='oct') selected="" @endif value="oct">Oct</option>
                        <option @if($arr_data['passing_month']=='nov') selected="" @endif value="nov">Nov</option>
                        <option @if($arr_data['passing_month']=='dec') selected="" @endif value="dec">Dec</option>
                         
                    </select>
                    <span class="help-block">{{ $errors->first('passing_month') }}</span>
                </div>
                
                
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="passing_year" data-rule-required="true"  >
                      <option value="">Passing Year</option>
                      @for($i=$current_year;$i>=1992;$i--) 
                      <option @if($arr_data['passing_year']==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                        
                    </select>
                    <span class="help-block">{{ $errors->first('passing_year') }}</span>
                </div>
                
                </div>
                <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label"></label>Marks:
                  <input type="radio" name="marks_type" @if($arr_data['marks_type']=='percentage') checked="" @endif value="percentage">Percentage
                  <input type="radio" name="marks_type" @if($arr_data['marks_type']=='cgpa') checked="" @endif value="cgpa" >  CGPA(out of 10)
                </div>
                <div class="error_msg" id="err_marks_type"></div>
                <div class="form-group" style="">
                    <label class="col-sm-3 col-lg-2 control-label"></label>
                    <div class="col-sm-9 col-lg-4 controls" >
                    <input onblur="markstype();"  type="text" name="marks_input" id="marks_input" data-rule-required="true" data-rule-digits="true" class="form-control" placeholder="Marks" value="{{$arr_data['marks']}}">
                    <div class="error_msg" id="err_marks_input" style="color:red"></div>
                </div>
                </div>


            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Pan No<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="pan_no" placeholder="Enter Pan No" data-rule-required="true" data-rule-pattern="[A-Za-z]{5}\d{4}[A-Za-z]{1}" data-msg-pattern="Please enter valid pan no." value="{{$arr_data['pan_no'] or 'NA'}}" />
                      <span class="help-block">{{ $errors->first('pan_no') }}</span>
                  </div>
            </div>


 <div class="form-group">
				<label class="col-sm-3 col-lg-2 control-label">Social Network</label>
				<div class="col-sm-9 col-lg-4 controls" >
				   <div class="col-sm-12">
					  <input type="text" name="facebook"  class="form-control scocial-site" placeholder="Facebook" value="{{isset($arr_data['facebook'])?$arr_data['facebook']:'NA'}}" />
				   </div>
				   <div class="col-sm-12">
					  <input type="text" name="linkedin"  class="form-control scocial-site" placeholder="Linkedin" value="{{isset($arr_data['linkedin'])?$arr_data['linkedin']:'NA'}}" />
				   </div>
				   <div class="col-sm-12">
					  <input type="text" name="twitter"  class="form-control scocial-site" placeholder="Twitter" value="{{isset($arr_data['twitter'])?$arr_data['twitter']:'NA'}}" />
				   </div>
				</div>
			 </div> 
			 
			 
			 
            {{-- <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Address<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="address" placeholder="Enter Address" data-rule-required="true"  value="{{$arr_data['address'] or 'NA'}}" />
                      <span class="help-block">{{ $errors->first('address') }}</span>
                  </div>
            </div> --}}
            
            
            

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">City<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="city" data-rule-required="true"  >
                      <option value="">--Select City--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $state)
                        <optgroup label="{{$state['state_name']}}">

                        @if(isset($state['city']) && sizeof($state['city'])>0)

                          @foreach($state['city'] as $city)
                          <option @if($arr_data['education_city']==$city['city_id']) selected="" @endif value="{{ $city['city_id'] }}">{{ $city['city_name'] or '-' }}</option>  

                          @endforeach
                        @endif  
                        </optgroup>
                          
                        @endforeach
                      @endif
                    </select>
                    <span class="help-block">{{ $errors->first('city') }}</span>
                </div>
            </div>

            {{-- <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Pincode<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" data-rule-required="true" data-rule-digits="true" value="{{ $arr_data['pincode'] or 'NA' }}" />
                      <span class="help-block">{{ $errors->first('pincode') }}</span>
                  </div>
            </div> --}}

            

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Tell Us About Your Skill Type </label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="about_member" placeholder="About You" data-rule-required="true" value="{{ $arr_data['about_member'] or 'NA' }}" />
                      <span class="help-block">{{ $errors->first('about_member') }}</span>
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


<script type="text/javascript">
     function markstype()
     {
        var value_markstype = $("input[name='marks_type']:checked").val();
     //  alert(value_cardtype);
        var value_marks = $('#marks_input').val();
        if(value_markstype=='percentage')
        {
          
          
          if(value_marks<30 || value_marks>100 )
          {
            $('#err_marks_input').html('Percentage value must be between 30 to 100.');
            return false;
          } 
        }
        if(value_markstype=='cgpa')
        {
          if(value_marks<1 || value_marks>10 )
          {
            $('#err_marks_input').html('CGPA value must be between 1 to 10.');
            return false;
          }  
        }
     }
</script>

<script type="text/javascript">
var url = "{{ url('/') }}";
    function loadSpecialization(ref)
    {
        var selected_qualification = jQuery(ref).val();

        jQuery.ajax({
                        url:url+'/admin/specialization/get_specialization/'+selected_qualification,
                        type:'GET',
                        data:'',
                        dataType:'json',
                        beforeSend:function()
                        {
                            jQuery('select[name="specialization_id"]').attr('disabled','disabled');
                        },
                        success:function(response)
                        {
                            if(response.status=="SUCCESS")
                            {
                              
                                jQuery('select[name="specialization_id"]').removeAttr('disabled');
                                if(typeof(response.arr_specialization) == "object")
                                {
                                   var option = '<option value="">Please Specialization</option>'; 
                                   jQuery(response.arr_specialization).each(function(index,specialization)
                                   {   
                                    
                                        option+='<option value="'+specialization.id+'">'+specialization.specialization_name+'</option>';
                                   });

                                   jQuery('select[name="specialization_id"]').html(option);
                                }
                            }
                            else
                            {
                              var option = '<option value="">Please Select</option>'; 
                              jQuery('select[name="specialization_id"]').html(option);
                            }
                            return false;
                        },
                        error:function(response)
                        {
                         
                        }
        });
     }    

  </script>


@stop                    
