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
                <label class="col-sm-3 col-lg-2 control-label">Highest Qualification<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="qualification_id" data-rule-required="true" id="qualification_id" onchange="loadSpecialization(this);"  >
                      <option value="">--Select Qualification--</option>
                      @if(isset($arr_qualification) && count($arr_qualification)>0)
                        @foreach($arr_qualification as $qualification)
                        <option @if($arr_data['user_profile']['qualification_id']==$qualification['id']) selected="" @endif value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
                        @endforeach
                        @endif  
                    </select>
                    <span class="help-block">{{ $errors->first('qualification_id') }}</span>
                </div>
            </div>

                <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="passing_month" data-rule-required="true"  >
                      <option value="">Passing Month</option>
                      
                        <option @if($arr_data['user_profile']['passing_month']='jan') selected="" @endif value="jan">Jan</option>
                        <option @if($arr_data['user_profile']['passing_month']='feb') selected="" @endif value="feb">Feb</option>
                        <option @if($arr_data['user_profile']['passing_month']='mar') selected="" @endif value="mar">Mar</option>
                        <option @if($arr_data['user_profile']['passing_month']='apr') selected="" @endif value="apr">Apr</option>
                        <option @if($arr_data['user_profile']['passing_month']='may') selected="" @endif value="may">May</option>
                        <option @if($arr_data['user_profile']['passing_month']='jun') selected="" @endif value="jun">Jun</option>
                        <option @if($arr_data['user_profile']['passing_month']='jul') selected="" @endif value="jul">Jul</option>
                        <option @if($arr_data['user_profile']['passing_month']='aug') selected="" @endif value="aug">Aug</option>
                        <option @if($arr_data['user_profile']['passing_month']='sep') selected="" @endif value="sep">Sep</option>
                        <option @if($arr_data['user_profile']['passing_month']='oct') selected="" @endif value="oct">Oct</option>
                        <option @if($arr_data['user_profile']['passing_month']='nov') selected="" @endif value="nov">Nov</option>
                        <option @if($arr_data['user_profile']['passing_month']='dec') selected="" @endif value="dec">Dec</option>
                         
                    </select>
                    <span class="help-block">{{ $errors->first('passing_month') }}</span>
                </div>
                
                
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="passing_year" data-rule-required="true"  >
                      <option value="">Passing Year</option>
                      @for($i=$current_year;$i>=1992;$i--) 
                      <option @if($arr_data['user_profile']['passing_year']==$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                        
                    </select>
                    <span class="help-block">{{ $errors->first('passing_year') }}</span>
                </div>
                
                </div>
                <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label"></label>Marks:
                  <input type="radio" name="marks_type" @if($arr_data['user_profile']['marks_type']=='percentage') checked="" @endif value="percentage">Percentage
                  <input type="radio" name="marks_type" @if($arr_data['user_profile']['marks_type']=='cgpa') checked="" @endif value="cgpa" >  CGPA(out of 10)
                </div>
                <div class="error_msg" id="err_marks_type"></div>
                <div class="form-group" style="">
                    <label class="col-sm-3 col-lg-2 control-label"></label>
                    <div class="col-sm-9 col-lg-4 controls" >
                    <input type="text" name="marks_input" id="marks_input" data-rule-required="true" data-rule-digits="true" class="form-control" placeholder="Marks" value="{{isset($arr_data['user_profile']['marks'])?$arr_data['user_profile']['marks']:'NA'}}">
                    <div class="error_msg" id="err_marks_input" style="color:red"></div>
                </div>
                </div>


                <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Select Specialization<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="specialization_id" data-rule-required="true"   >
                      {{-- <option value="">Select Specialization</option> --}}
                      <option value="{{$arr_data['user_profile']['qualification_id']}}">{{$arr_data['user_profile']['specialization']}}</option>
                      
                    </select>
                    <span class="help-block">{{ $errors->first('role') }}</span>
                </div>
                </div>

                <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Job Categories<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="category_id" data-rule-required="true" id="category_id" >
                      <option value="">--Select Category--</option>
                      @if(isset($arr_category) && count($arr_category)>0)
                        @foreach($arr_category as $category)
                        <option @if($arr_data['user_profile']['category_id']==$category['id']) selected="" @endif value="{{ $category['id'] }}">{{ $category['category_name'] or '-' }}</option>
                        @endforeach
                        @endif  
                    </select>
                    <span class="help-block">{{ $errors->first('category_id') }}</span>
                </div>
            </div>

            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Current Work Location<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="city" data-rule-required="true"  >
                      <option value="">--Select City--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $state)
                        <optgroup label="{{$state['state_name'] or '-'}}">

                        @if(isset($state['city']) && sizeof($state['city'])>0)

                          @foreach($state['city'] as $city)
                          <option 
            @if($arr_data['user_profile']['current_work_location']==$city['city_id']) selected="" @endif value="{{ $city['city_id'] }}">{{ $city['city_name'] or '-' }}</option>  

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
                <label class="col-sm-3 col-lg-2 control-label">Birth Date</label>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="date" data-rule-required="true"  >
                      <option value=""></option>

                      @for($i=1;$i<=31;$i++) 
                      <option @if($birth_date=$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                    <span class="help-block">{{ $errors->first('role') }}</span>
                </div>

                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="month" data-rule-required="true"  >
                      <option value="">Month</option>
                      
                      <!--  <option @if($birth_month=01) selected="" @endif value="01">Jan</option>
                        <option @if($birth_month=02) selected="" @endif value="02">Feb</option>
                        <option @if($birth_month=03) selected="" @endif value="03">Mar</option>
                        <option @if($birth_month=04) selected="" @endif value="04">Apr</option>
                        <option @if($birth_month=05) selected="" @endif value="05">May</option>
                        <option @if($birth_month=06) selected="" @endif value="06">Jun</option>
                        <option @if($birth_month=07) selected="" @endif value="07">Jul</option>
                        <option @if($birth_month=08) selected="" @endif value="08">Aug</option>
                        <option @if($birth_month=09) selected="" @endif value="09">Sep</option>
                        <option @if($birth_month=10) selected="" @endif value="10">Oct</option>
                        <option @if($birth_month=11) selected="" @endif value="11">Nov</option>
                        <option @if($birth_month=12) selected="" @endif value="12">Dec</option> -->
                         
                    </select>
                    <span class="help-block">{{ $errors->first('month') }}</span>
                </div>
                
                
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="year" data-rule-required="true"  >
                      <option value="">Year</option>
                      @for($i=$current_year;$i=1976;$i--) 
                      <option @if($birth_year=$i) selected="" @endif value="{{$i}}"> {{$i}}</option>
                      @endfor
                    </select>
                    <span class="help-block">{{ $errors->first('role') }}</span>
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
