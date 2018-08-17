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
           {!! Form::open([ 'url' => $module_url_path.'/store_education',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}
           <?php $current_year = date('Y'); ?>
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">Highest Qualification<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="qualification_id" data-rule-required="true" id="qualification_id" onchange="loadSpecialization(this);"  >
                      <option value="">--Select Qualification--</option>
                      @if(isset($arr_qualification) && count($arr_qualification)>0)
                        @foreach($arr_qualification as $qualification)
                        <option value="{{ $qualification['id'] }}">{{ $qualification['qualification_name'] or '-' }}</option>
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
                      {{-- <option value="">Select Specialization</option> --}}
                      
                    </select>
                    <span class="help-block">{{ $errors->first('specialization_id') }}</span>
                </div>
                </div>

                <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label"></label>
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="passing_month" data-rule-required="true"  >
                      <option value="">Passing Month</option>
                      
                        <option value="jan">Jan</option>
                        <option value="feb">Feb</option>
                        <option value="mar">Mar</option>
                        <option value="apr">Apr</option>
                        <option value="may">May</option>
                        <option value="jun">Jun</option>
                        <option value="jul">Jul</option>
                        <option value="aug">Aug</option>
                        <option value="sep">Sep</option>
                        <option value="oct">Oct</option>
                        <option value="nov">Nov</option>
                        <option value="dec">Dec</option>
                         
                    </select>
                    <span class="help-block">{{ $errors->first('passing_month') }}</span>
                </div>
                
                
                <div class="col-sm-9 col-lg-2 controls" >
                    <select class="form-control"  name="passing_year" data-rule-required="true"  >
                      <option value="">Passing Year</option>
                      @for($i=$current_year;$i>=1992;$i--) 
                      <option value="{{$i}}"> {{$i}}</option>
                      @endfor
                        
                    </select>
                    <span class="help-block">{{ $errors->first('passing_year') }}</span>
                </div>
                
                </div>
                <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label"></label>Marks:
                  <input type="radio" name="marks_type" value="percentage">Percentage
                  <input type="radio" name="marks_type" value="cgpa" >  CGPA(out of 10)
                </div>
                <div class="error_msg" id="err_marks_type"></div>
                <div class="form-group" style="">
                    <label class="col-sm-3 col-lg-2 control-label"></label>
                    <div class="col-sm-9 col-lg-4 controls" >
                    <input onblur="markstype();"  type="text" name="marks_input" id="marks_input" data-rule-required="true" data-rule-digits="true" class="form-control" placeholder="Marks">
                    <div class="error_msg" id="err_marks_input" style="color:red"></div>
                </div>
                </div>


            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Pan No<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="pan_no" data-rule-pattern="[A-Za-z]{5}\d{4}[A-Za-z]{1}" data-msg-pattern="Please enter valid pan no." placeholder="Enter Pan No" data-rule-required="true" value="{{ old('pan_no') }}" />
                      <span class="help-block">{{ $errors->first('pan_no') }}</span>
                  </div>
            </div>

           <!--  <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Address<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="address" placeholder="Enter Address" data-rule-required="true" data-rule-lettersonly="true" value="{{ old('address') }}" />
                      <span class="help-block">{{ $errors->first('address') }}</span>
                  </div>
            </div>
 -->
            <div class="form-group" style="">
                <label class="col-sm-3 col-lg-2 control-label">City<i style="color: red;">*</i></label>
                <div class="col-sm-9 col-lg-4 controls" >
                    <select class="form-control"  name="city" data-rule-required="true"  >
                      <option value="">--Select City--</option>
                      @if(isset($arr_state) && count($arr_state)>0)
                        @foreach($arr_state as $state)
                        <optgroup label="{{$state['state_name']}}">

                        @if( isset($state['city']) && sizeof($state['city'])>0)

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

           <!--  <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Pincode<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" data-rule-required="true" data-rule-digits="true" value="{{ old('pincode') }}" />
                      <span class="help-block">{{ $errors->first('pincode') }}</span>
                  </div>
            </div>
 -->
            

            <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Tell Us About Your Skill Type </label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="about_member" placeholder="About You" data-rule-required="true" value="{{ old('about_member') }}" />
                      <span class="help-block">{{ $errors->first('about_member') }}</span>
                  </div>
            </div>

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
