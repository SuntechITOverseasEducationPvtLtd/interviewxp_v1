    @extends('admin.layout.master')                


    @section('main_content')

    
    <!-- BEGIN Page Title -->
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
            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Job Title<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                      <input type="text" class="form-control" name="job_name" placeholder="Eg. PHP Developer" data-rule-required="true" required  value="<?=$arr_data['jobtitle'];?>" />
                      <span class="help-block">{{ $errors->first('job_name') }}</span>
                  </div>
            </div>
            
            
                 <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Experience<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                      
                      <select name="experience_name" data-rule-required="true" required class="form-control" >
                          
                          <option value="Fresher">Fresher</option>
                          <option value="1 - 2 Yrs">1 - 2 Yrs</option>
                          <option value="3 - 6 Yrs">3 - 6 Yrs</option>
                          <option value="7 - 10 Yrs">7 - 10 Yrs</option>
                          <option value="11 - 15 Yrs">11 - 15 Yrs</option>
                          <option value="30+ Yrs">30+ Yrs</option>
                           <option selected value="<?=$arr_data['experience'];?>"><?=$arr_data['experience'];?></option>
                      </select>
                
                       <span class="help-block">{{ $errors->first('experience_name') }}</span>
                      
                  </div>
            </div>
            
            
                 <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Job Type<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                      <?php if($arr_data['type']==1) { $checked='checked'; } elseif($arr_data['type']==2) { $checked1='checked'; } else { $checked2='checked'; } ?>
              

											<label class="radio-inline">
												<input type="radio" class="styled" value="1" name="jobtype" <?=@$checked;?> >
												Regular In office/On field
											</label>

											<label class="radio-inline">
												<input type="radio" class="styled" value="2" name="jobtype" <?=@$checked1;?>>
												Work from Home
											</label>
									
										<label class="radio-inline">
												<input type="radio" class="styled"  value="3" name="jobtype" <?=@$checked2;?>>
												Part time In office/ On field
											</label>
									
									 <span class="help-block">{{ $errors->first('jobtype') }}</span>
									
                      
                      
                  </div>
            </div>
            
            
            
              <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Number of Opening<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                      <input type="text" class="form-control" name="job_opening" placeholder="Eg. 5" data-rule-required="true" required  value="<?=$arr_data['opening'];?>" />
                      <span class="help-block">{{ $errors->first('job_opening') }}</span>
                  </div>
            </div>
            
            
              <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Annual Salary<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                    
                      <select name="annual_salary" data-rule-required="true" required class="form-control" >
                          
                          
                          <option value="100000 to 300000 PA">100000 to 300000 PA</option>
                          <option value="400000 to 700000 PA">400000 to 700000 PA</option>
                          <option value="800000 to 1100000 PA">800000 to 1100000 PA</option>
                          <option value="1200000 to 1500000 PA">1200000 to 1500000 PA</option>
                          <option value="1600000 to 1900000 PA">1600000 to 1900000 PA</option>
                          <option value="2000000 to 2500000 PA">2000000 to 2500000 PA</option>
                          
                          <option value="2600000 to 3000000 PA">2600000 to 3000000 PA</option>
                          <option value="3000000+ PA">3000000+ PA</option>
                          
                           <option selected value="<?=$arr_data['anualsalary'];?>"><?=$arr_data['anualsalary'];?></option>
                           
                           
                      </select>
                <span class="help-block">{{ $errors->first('annual_salary') }}</span>
                  </div>
            </div>
            
            
            
            
          
            
            
            
            
            
               <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Job Description<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                   <textarea class="form-control"  placeholder="Page Content" name="page_desc" cols="50" rows="10"><?=$arr_data['jobdescription'];?></textarea>
                      
                  </div>
            </div>
            
            
               <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Email<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                      <input type="email" class="form-control" name="email" placeholder="Eg. example@gmail.com" data-rule-required="true" required  value="<?=$arr_data['email'];?>" />
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  </div>
            </div>
            
            
            
               <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Phone<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-6 controls" >
                      <input type="text" class="form-control" name="phone" placeholder="Eg. 9898789878" data-rule-required="true" required  value="<?=$arr_data['phone'];?>" />
                      <span class="help-block">{{ $errors->first('phone') }}</span>
                  </div>
            </div>
            
            
            
            

            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                  
                     
                  <input type="hidden" name="enc_id" value="{{$enc_id}}"> 
                 
                  {!! Form::submit('Edit Job',['class'=>'btn bg-teal-400','value'=>'3','name'=>'post'])!!}
              </div>
            </div>
    
          {!! Form::close() !!}
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->     
 <script type="text/javascript">

    function saveTinyMceContent()
    {
      tinyMCE.triggerSave();
    }

    $(document).ready(function()
    {
      tinymce.init({
        selector: 'textarea',
        height:350,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
        ]
      });  
    });
    
      $(document).ready(function()  {
          
   $(".saveh").on('mouseover', function(e) { 
     
    $('.savevalue').val(1);	

 });
    $(".drafth").on('mouseover', function(e) { 
     
    $('.savevalue').val(2);	

 });
    $(".posth").on('mouseover', function(e) {
     
    $('.savevalue').val(3);	

 });
 
 
  
    });
    
    
  </script>

  @stop                 
