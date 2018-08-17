

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
      <div class="box-content profile-admin">
        <!--new section start here-->
        <div class="row">
            <div class="col-lg-4">
              
                 
                 
                 
                 <div class="content-group">
									<div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
										<div class="content-group-sm">
											<h6 class="text-semibold no-margin-bottom">
												{{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }} {{ isset($arr_data['last_name']) && $arr_data['last_name'] !=""  ?ucfirst($arr_data['last_name']):'NA' }}
											</h6>

											<span class="display-block"></span>
										</div>

										<a href="#" class="display-inline-block content-group-sm">
											<img src={{ $user_profile_public_img_path.$arr_data['profile_image']}}  class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
										</a>

										<ul class="list-inline list-inline-condensed no-margin-bottom">
											<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>
											<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>
											<li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>
										</ul>
									</div>

								
								</div>
								
								
								
								
            </div>
            <div class="col-lg-4">
                 <div class="content-group">
								
									<div class="panel no-border-top no-border-radius-top">
										<ul class="navigation" style="padding: 0px 0px 5px;">
										
											<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> About Me</a></li>
										
										
<li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Gender" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-people"></i>  @if($arr_data['gender']=='M')
                    <h4 class="value" style=" font-size: 15px !important; line-height: 0px;">Male</h4>
                     @elseif($arr_data['gender']=='F')
                  <h4 class="value" style=" font-size: 15px !important; line-height: 0px;">Female</h4>
                     @endif </a></li>
                     
                     <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Email" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-envelop5"></i>  <h4 class="value"  style="font-size: 15px !important; line-height: 0px;">{{ isset($arr_data['email']) && $arr_data['email'] !=""  ?$arr_data['email']:'NA' }}</h4></a></li>
                     
                     
                     <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Mobile Phone" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-mobile3"></i>    <h4 class="value" style="font-size: 15px !important; line-height: 0px;">
        {{ isset($arr_data['mobile_code']) && $arr_data['mobile_code'] !=""  ?$arr_data['mobile_code']:'NA' }} -  {{ isset($arr_data['mobile_no']) && $arr_data['mobile_no'] !=""  ?$arr_data['mobile_no']:'NA' }}</h4> </a></li>
                     
                     
                     
                         <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Graduation" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-graduation"></i>    <h4 class="value" style="font-size: 15px !important; line-height: 0px;">
        {{ isset($arr_data['user_profile']['qualification']) && $arr_data['user_profile']['qualification'] !=""  ?$arr_data['user_profile']['qualification']:'NA' }}</h4> </a></li>
        
        <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Graduation Date" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-calendar2"></i>    <h4 class="value" style="font-size: 15px !important; line-height: 0px;">
        {{ isset($arr_data['user_profile']['passing_month']) && $arr_data['user_profile']['passing_month'] !=""  ?ucfirst($arr_data['user_profile']['passing_month']):'NA' }}-{{ isset($arr_data['user_profile']['passing_year']) && $arr_data['user_profile']['passing_year'] !=""  ?$arr_data['user_profile']['passing_year']:'NA' }}</h4> </a></li>
        
        
                     
                      
                      
                      
										</ul>
									</div>
								</div>
               
            </div>
            
              <div class="col-lg-4">
                 <div class="content-group">
								
									<div class="panel no-border-top no-border-radius-top">
											<ul class="navigation" style="padding: 0px 0px 5px;">
										
											<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> More Details</a></li>
										
										<li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Marks/{{ucfirst($arr_data['user_profile']['marks_type'])}}" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-sort-numeric-asc"></i>  <h4 class="value"  style="font-size: 15px !important; line-height: 0px;">{{ isset($arr_data['user_profile']['marks']) && $arr_data['user_profile']['marks'] !=""  ?$arr_data['user_profile']['marks']:'NA' }}</h4></a></li>
										
										
											<li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Specialization" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-profile"></i>  <h4 class="value"  style="font-size: 15px !important;     line-height: 20px;
    margin-top: 0px;">{{ isset($arr_data['user_profile']['specialization']) && $arr_data['user_profile']['specialization'] !=""  ?$arr_data['user_profile']['specialization']:'NA' }}</h4></a></li>
    
    
    
    <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Job Categories" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-books"></i>  @if(isset($arr_category) && count($arr_category)>0)
                     @foreach($arr_category as $category)
                     @if($arr_data['user_profile']['category_id']==$category['id']) 
                     <h4 class="value"  style="font-size: 15px !important; line-height: 0px;">{{ isset($category['category_name']) && $category['category_name'] !=""  ?$category['category_name']:'NA' }}</h4>
                     @endif 
                     @endforeach
                     @endif  </a></li>
    
    
    
      
    <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Current Work Location" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class=" icon-location4"></i> 
    
    
    @if($arr_data['user_profile']['country_id']!=358)
                        @if(isset($arr_country) && count($arr_country)>0)
                          @foreach($arr_country as $country)
                             @if($arr_data['user_profile']['country_id']==$country['id']) 
                            <span>{{ $country['country_name'] or '-' }}</span>
                             @endif 
                          @endforeach
                          
                          {{ $arr_data['user_profile']['other_city'] or '-' }}
                          
                           @endif
                     @else
                        @if(isset($arr_state) && count($arr_state)>0)
                         @foreach($arr_state as $state)
                           @if(isset($state['city']) && sizeof($state['city'])>0)
                             @foreach($state['city'] as $city)
                               @if($arr_data['user_profile']['current_work_location']==$city['city_id'])  
                               >{{ $city['city_name'] or '-' }}
                               @endif 
                             @endforeach
                           @endif  
                         @endforeach
                       @endif
                     @endif
                          
                          
                          </a></li>
    
    
    
    
      <li style=" background: whitesmoke; " data-popup="tooltip" title="" data-original-title="Date Of birth" ><a href="#" data-toggle="tab" style="  color: #26a69a;">
    <i class="icon-calendar52"></i>  {{ isset($arr_data['birth_date']) && $arr_data['birth_date'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['birth_date'])):'NA' }} </a></li>
    
    
    
										
										</ul>
									</div>
								</div>
               
            </div>
        </div>
        <!--new section end here-->
        
        
        
        
       <!--  <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-6">
                     <h3>
                        <span 
                           class="text-" 
                           ondblclick="scrollToButtom()"
                           style="cursor: default;" 
                           title="Double click to Take Action" 
                           >
                        </span>
                     </h3>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               {!! Form::open([ 
               'method'=>'POST',
               'enctype' =>'multipart/form-data',   
               'class'=>'form-horizontal', 
               'id'=>'validation-form' 
               ]) !!} 
             
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label">Profile Image</label>
                  </div>
                  <div class="col-sm-9">
                     @if($arr_data['profile_image']!="")
                     <img src= {{ $user_profile_public_img_path.$arr_data['profile_image']}}  alt="" style="width: 200px; height: 150px;"/>
                     @else NA
                     @endif
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Firstname :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Lastname :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['last_name']) && $arr_data['last_name'] !=""  ?ucfirst($arr_data['last_name']):'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Gender :</label>
                  </div>
                  <div class="col-sm-9">
                     @if($arr_data['gender']=='M')
                     <h4 class="value">Male</h4>
                     @elseif($arr_data['gender']=='F')
                     <h4 class="value">Female</h4>
                     @endif   
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Email :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['email']) && $arr_data['email'] !=""  ?$arr_data['email']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Mobile Code :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['mobile_code']) && $arr_data['mobile_code'] !=""  ?$arr_data['mobile_code']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Mobile No :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['mobile_no']) && $arr_data['mobile_no'] !=""  ?$arr_data['mobile_no']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Highest Qualification :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_profile']['qualification']) && $arr_data['user_profile']['qualification'] !=""  ?$arr_data['user_profile']['qualification']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Passing Month :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_profile']['passing_month']) && $arr_data['user_profile']['passing_month'] !=""  ?ucfirst($arr_data['user_profile']['passing_month']):'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Passing Year :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_profile']['passing_year']) && $arr_data['user_profile']['passing_year'] !=""  ?$arr_data['user_profile']['passing_year']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Marks/{{ucfirst($arr_data['user_profile']['marks_type'])}} :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_profile']['marks']) && $arr_data['user_profile']['marks'] !=""  ?$arr_data['user_profile']['marks']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Specialization :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_profile']['specialization']) && $arr_data['user_profile']['specialization'] !=""  ?$arr_data['user_profile']['specialization']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Job Categories :</label>
                  </div>
                  <div class="col-sm-6 col-lg-4 controls">
                     @if(isset($arr_category) && count($arr_category)>0)
                     @foreach($arr_category as $category)
                     @if($arr_data['user_profile']['category_id']==$category['id']) 
                     <h4 class="value">{{ isset($category['category_name']) && $category['category_name'] !=""  ?$category['category_name']:'NA' }}</h4>
                     @endif 
                     @endforeach
                     @endif  
                  </div>
               </div>
                     @if($arr_data['user_profile']['country_id']!=358)
                        @if(isset($arr_country) && count($arr_country)>0)
                          @foreach($arr_country as $country)
                             @if($arr_data['user_profile']['country_id']==$country['id']) 
                              <div class="form-group">
                                 <div class="col-sm-3 text-right">
                                 <label class="main-label" >Current Work Location :</label>
                              </div>
                              <div class="col-sm-9"> 
                                  <h4 class="value">{{ $country['country_name'] or '-' }}</h4>
                                 </div>
                               </div>
                             @endif 
                          @endforeach
                           <div class="form-group">
                                 <div class="col-sm-3 text-right">
                                 <label class="main-label" >City :</label>
                              </div>
                              <div class="col-sm-9"> 
                                  <h4 class="value">{{ $arr_data['user_profile']['other_city'] or '-' }}</h4>
                                 </div>
                           </div>
                      @endif
                     @else
                        @if(isset($arr_state) && count($arr_state)>0)
                         @foreach($arr_state as $state)
                           @if(isset($state['city']) && sizeof($state['city'])>0)
                             @foreach($state['city'] as $city)
                               @if($arr_data['user_profile']['current_work_location']==$city['city_id'])  
                               <div class="form-group">
                                 <div class="col-sm-3 text-right">
                                 <label class="main-label" >Current Work Location :</label>
                              </div>
                              <div class="col-sm-9"> 
                                  <h4 class="value">{{ $city['city_name'] or '-' }}</h4>
                                 </div>
                               </div>
                               @endif 
                             @endforeach
                           @endif  
                         @endforeach
                       @endif
                     @endif
              
             
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label">Birth Date :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['birth_date']) && $arr_data['birth_date'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['birth_date'])):'NA' }}</h4>
                  </div>
               </div>
               {!! Form::close() !!}
            </div>
         </div>-->
      </div>
   </div>
</div>
<!-- END Main Content -->
<script type="text/javascript">
   function scrollToButtom()
   {
       $("html, body").animate({ scrollTop: $(document).height() }, 1000);
   }
   
   $(document).ready(function()
   {
       $("#select_action").bind('change',function()
       {
           if($(this).val()=="cancel")
           {
               $("#reason_section").show();
           }
           else
           {
               $("#reason_section").hide();
           }
       });
   });
</script>
@stop

