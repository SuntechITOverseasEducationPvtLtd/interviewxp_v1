@extends('admin.layout.master')                
@section('main_content')
 <style type="text/css">
                          .rounded-box {
                                  border-radius: 0%;
                                  height: 67px;
                                  overflow: hidden;
                                  width: 80px;
                                  float: left;
                          }
                          .rounded-box img {
                              border-radius: 50%;
                              float: left;
                              height: 73%;
                              width: 73%;
                          }
                           .proimgset {
                                height: 60px !important;
    width: 60px !important;
                          }
                           .table td {   padding: 2px 7px !important; }
                           p {
    margin: 0 0 3px; }
    h4.value {line-height: 14px;
    font-size: 13px;
    color: #13c0b2;
    font-weight: bold;}
    
    label {
    margin-bottom: 7px;
    font-weight: 400;
    line-height: 30px;
}
                        </style>



<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
               <div class="btn-group"> 
               <a class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                  title="Refresh" 
                  href="{{ $module_url_path }}"
                  style="text-decoration:none;">
               <i class=" icon-database-refresh"></i>
               </a> 
            </div>
                      </div>
            </div>

         <div class="box-content view-details  profile-admin">
          <!--new section start here-->
           <div class="row">
               <div class="col-lg-3">
                   <div class="pro-block" style="    background: whitesmoke;">
               <div class="form-group">
                 @if(isset($arr_data['profile_image']) && $arr_data['profile_image']!="")
                        <span class="img-w"><img class="img-responsive" src= {{ $user_profile_public_img_path.$arr_data['profile_image']}}  alt="" /></span>
                        @else NA
                        @endif
                 </div>
                 
                 
                 <h5 class="pro-name" style="    background: #13c0b2;
    text-align: center;
    color: #fff;"><span>{{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }}</span> <span>{{ isset($arr_data['last_name']) && $arr_data['last_name'] !=""  ?ucfirst($arr_data['last_name']):'NA' }}</span></h5>
                 
                       
                       <div class="admin-cat-list">
                           <div class="cat-main-block" style="background: #dfdfdf;
    margin-top: 2px;
    padding: 5px 5px 5px 5px;">
                           <div class="main-h"><a href="#">About Interview <span class="arrow"><i class="fa fa-angle-down"></i></span></a></div>
                           
                               <div class="admin-sub" style="display:none">
                                   <h4 class="value"><div class="more"> {{ (isset($arr_data['member_detail']['about_interview'])&& $arr_data['member_detail']['about_interview'] !="")?ucfirst($arr_data['member_detail']['about_interview']):'NA' }}</div> </h4>

                               </div>
                           </div>
                           <div class="cat-main-block" style="background: #dfdfdf;
    margin-top: 2px;
    padding: 5px 5px 5px 5px;">
                           <div class="main-h"><a href="#">Curriculum <span class="arrow"><i class="fa fa-angle-down"></i></span></a></div>
                           
                               <div class="admin-sub" style="display:none">
                                   <h4 class="value"><div class="more"> {{ isset($arr_data['member_detail']['curriculum'])&& $arr_data['member_detail']['curriculum'] !=""  ?ucfirst($arr_data['member_detail']['curriculum']):'NA' }}</div> </h4>

                               </div>
                           </div>
                           <div class="cat-main-block" style="background: #dfdfdf;
    margin-top: 2px;
    padding: 5px 5px 5px 5px;">
                           <div class="main-h"><a href="#">Biography <span class="arrow"><i class="fa fa-angle-down"></i></span></a></div>
                           
                               <div class="admin-sub" style="display:none">
                                   <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['biography'])&& $arr_data['member_detail']['biography'] !=""  ?ucfirst($arr_data['member_detail']['biography']):'NA' }}</div> </h4>

                               </div>
                           </div>
                           <div class="cat-main-block" style="background: #dfdfdf;
    margin-top: 2px;
    padding: 5px 5px 5px 5px;">
                           <div class="main-h"><a href="#">My Interview Experience<span class="arrow"><i class="fa fa-angle-down"></i></span></a></div>
                           
                               <div class="admin-sub" style="display:none">
                                   <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['my_interview_experience'])&& $arr_data['member_detail']['my_interview_experience'] !=""  ?ucfirst($arr_data['member_detail']['my_interview_experience']):'NA' }}</div> </h4>

                               </div>
                           </div>
                           <div class="cat-main-block" style="background: #dfdfdf;
    margin-top: 2px;
    padding: 5px 5px 5px 5px;">
                           <div class="main-h"><a href="#">Present Calls in Job Market<span class="arrow"><i class="fa fa-angle-down"></i></span></a></div>
                           
                               <div class="admin-sub" style="display:none">
                                   <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['calls_job_market'])&& $arr_data['member_detail']['calls_job_market'] !=""  ?ucfirst($arr_data['member_detail']['calls_job_market']):'NA' }} </div></h4>

                               </div>
                           </div>
                           
                       </div>
                       
                 
                       
                 </div>
               </div>
               
               <div class="col-lg-9">
                   <div class="admin-pro-info">  
                       <h2><i class="fa fa-user"></i> About me</h2>
                       <div class="row">
                           <div class="col-lg-6">
                                <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2">Firstname</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }}</h4>
                     </div>
                  </div>
                          <div class="clearfix"></div>
                           <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Lastname</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['last_name']) && $arr_data['last_name'] !=""  ?ucfirst($arr_data['last_name']):'NA' }}</h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Email</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['email']) && $arr_data['email'] !=""  ?$arr_data['email']:'NA' }}</h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Mobile No</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['mobile_no']) && $arr_data['mobile_no'] !=""  ?$arr_data['mobile_no']:'NA' }}</h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Birth Date</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['birth_date']) && $arr_data['birth_date'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['birth_date'])):'NA' }}</h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Gender</label>
                     </div>
                     <div class="col-sm-7">
                        @if($arr_data['gender']=='M')
                        <h4 class="value">Male</h4>
                        @elseif($arr_data['gender']=='F')
                        <h4 class="value">Female</h4>
                        @endif   
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Job Skills</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           @if(isset($all_skill) && $all_skill!='')
                           {{ $all_skill }}
                           @else 
                           NA
                           @endif  
                        </h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Experience</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                         <?php  $exp_year =   $arr_data['member_detail']['experience_years'];
                                $exp_month =  $arr_data['member_detail']['experience_month'];
                          ?>
                        @if(isset($exp_year) && $exp_year !="" && isset($exp_month) && $exp_month !="")
                        {{ $exp_year.' Years '.$exp_month.' Month'}}  
                        @else NA
                        @endif  
                        </h4>
                     </div>
                  </div>
                           <div class="clearfix"></div>
                            <div class="form-group" style="">
                     <div class="col-sm-5">
                        <label class="title2" >Employer</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">  
                        @if($arr_data['member_detail']['employer_type']!="")
                        @if($arr_data['member_detail']['employer_type']=='previous')Previous  @endif
                        @if($arr_data['member_detail']['employer_type']=='current')Current @endif 
                        @else NA
                        @endif
                        </h4>
                     </div>
                  </div>
                        <div class="clearfix"></div>
                        
                        @if($arr_data['member_detail']['employer_type']=='current')
                  @if(isset($arr_employer_type_detail) && sizeof($arr_employer_type_detail)>0)
                  @foreach($arr_employer_type_detail as $employer_detail)

                  <div class="form-group" style="">
                     <div class="col-sm-5">
                        <label class="title2" >Duration</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                        <?php  
                               $start_month =  $employer_detail['start_month']; 
                               $start_year  =  $employer_detail['start_year'];
                               /*$end_month   =  $employer_detail['end_month'];
                               $end_year    =  $employer_detail['end_year'];*/
                        ?>
                           @if(isset($start_month) && $start_month !="" && isset($start_year) && $start_year !="")

                           @if($start_month=='01')Jan  @endif
                           @if($start_month=='02')Feb  @endif
                           @if($start_month=='03')Mar  @endif
                           @if($start_month=='04')Apr  @endif
                           @if($start_month=='05')May  @endif
                           @if($start_month=='06')Jun  @endif
                           @if($start_month=='07')Jul  @endif
                           @if($start_month=='08')Aug  @endif
                           @if($start_month=='09')Sep  @endif
                           @if($start_month=='010')Oct @endif
                           @if($start_month=='011')Nov @endif
                           @if($start_month=='012')Dec @endif

                           @for($i=2016;$i>=1976;$i--) 
                           @if($start_year==$i)  
                           {{$i}}
                           @endif
                           @endfor

                           <lable>To</lable>
                           present
                           @endif
                        </h4>
                     </div>
                  </div>
                    <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Designation</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($employer_detail
                           ['designation']) && $employer_detail['designation'] !=""  ?ucfirst($employer_detail['designation']):'NA' }}
                        </h4>
                     </div>
                  </div>
                    <div class="clearfix"></div>
                  @endforeach
                  @endif
                  @endif

                  @if($arr_data['member_detail']['employer_type']=='previous')
                  @if(isset($arr_employer_type_detail) && sizeof($arr_employer_type_detail)>0)
                  @foreach($arr_employer_type_detail as $employer_detail)

                  <div class="form-group" style="">
                     <div class="col-sm-5">
                        <label class="title2" >Duration</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                        <?php  
                               $start_month =  $employer_detail['start_month']; 
                               $start_year  =  $employer_detail['start_year'];
                               $end_month   =  $employer_detail['end_month'];
                               $end_year    =  $employer_detail['end_year'];
                        ?>
                           @if(isset($start_month) && $start_month !="" && isset($start_year) && $start_year !="" && isset($end_month) && $end_month !="" && isset($end_year) && $end_year !="")

                           @if($start_month=='01')Jan  @endif
                           @if($start_month=='02')Feb  @endif
                           @if($start_month=='03')Mar  @endif
                           @if($start_month=='04')Apr  @endif
                           @if($start_month=='05')May  @endif
                           @if($start_month=='06')Jun  @endif
                           @if($start_month=='07')Jul  @endif
                           @if($start_month=='08')Aug  @endif
                           @if($start_month=='09')Sep  @endif
                           @if($start_month=='010')Oct @endif
                           @if($start_month=='011')Nov @endif
                           @if($start_month=='012')Dec @endif
                           @for($i=2016;$i>=1976;$i--) 
                           @if($start_year==$i)  
                           {{$i}}
                           @endif
                           @endfor

                           @if($start_month !="")
                           <lable>To</lable>
                           @endif

                           @if($end_month=='01')Jan  @endif
                           @if($end_month=='02')Feb  @endif
                           @if($end_month=='03')Mar  @endif
                           @if($end_month=='04')Apr  @endif
                           @if($end_month=='05')May  @endif
                           @if($end_month=='06')Jun  @endif
                           @if($end_month=='07')Jul  @endif
                           @if($end_month=='08')Aug  @endif
                           @if($end_month=='09')Sep  @endif
                           @if($end_month=='010')Oct @endif
                           @if($end_month=='011')Nov @endif
                           @if($end_month=='012')Dec @endif
                           @for($i=2016;$i>=1976;$i--) 
                           @if($end_year==$i)  
                           {{$i}}
                           @endif
                           @endfor
                           @else NA
                           @endif
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Designation</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($employer_detail
                           ['designation']) && $employer_detail['designation'] !=""  ?ucfirst($employer_detail['designation']):'NA' }}
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Company Name</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($employer_detail
                           ['company_name']) && $employer_detail['company_name'] !=""  ?ucfirst($employer_detail['company_name']):'NA' }}
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  @endforeach
                  @endif
                  @endif
                  

                  @if($arr_data['member_detail']['employment_country_id']!=358)
	                  <div class="form-group">
	                     <div class="col-sm-5">
	                        <label class="title2" >Outside india Work Location state</label>
	                     </div>
	                     <div class="col-sm-7">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['employment_other_state']) && $arr_data['member_detail']['employment_other_state']!=''?$arr_data['member_detail']['employment_other_state']:'NA'}}
	                        </h4>
	                     </div>
	                  </div>
                        <div class="clearfix"></div>
	                        
	                   <div class="form-group">
	                     <div class="col-sm-5">
	                        <label class="title2" >Outside india Work Location city</label>
	                     </div>
	                     <div class="col-sm-7">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['employment_other_city']) && $arr_data['member_detail']['employment_other_city']!=''?$arr_data['member_detail']['employment_other_city']:'NA'}}
	                        </h4>
	                     </div>
	                  </div> 
	                  <div class="clearfix"></div>    

                  @else      
	                  <div class="form-group">
	                     <div class="col-sm-5">
	                        <label class="title2" >Current Work Location</label>
	                     </div>
	                     <div class="col-sm-7">
	                        <h4 class="value">
	                        
	                        @if(isset($arr_data['member_detail']['current_work_location']) && $arr_data['member_detail']['current_work_location'] !="")
	                           @if(isset($arr_state) && count($arr_state)>0)
	                           @foreach($arr_state as $state)
	                           @if(isset($state['city']) && sizeof($state['city'])>0)
	                           @foreach($state['city'] as $city)
	                           @if($arr_data['member_detail']['current_work_location']==$city['city_id'])  
	                           {{ $city['city_name'] or '-' }}
	                           @endif
	                           @endforeach
	                           @endif  
	                           @endforeach
	                           @endif
	                           @else NA
	                           @endif
	                        </h4>
	                     </div>
	                  </div>
	                  <div class="clearfix"></div>
                 
                        <div class="clearfix"></div>
                          @endif
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Resume</label>
                     </div>
                     <div class="col-sm-5">
                     @if($arr_data['member_detail']['resume'] !="")
                      <h4 class="value"><a href="{{$member_resume_public_path.$arr_data['member_detail']['resume']}}" download='' ><i class="fa fa-download" aria-hidden="true"></i></a>
                     @else
                      <h4 class="value">File Not Exists</h4>
                     @endif 
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Highest Qualification</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['member_detail']['qualification'])&& $arr_data['member_detail']['qualification'] !=""  ?$arr_data['member_detail']['qualification']:'NA' }}</h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                          
                           
                           </div>
                           <div class="col-lg-6">
                               
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Specialization</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['member_detail']['specialization'])&& $arr_data['member_detail']['specialization'] !=""  ?$arr_data['member_detail']['specialization']:'NA' }}</h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Passing Month & Year</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">  
                        <?php $pass_month = $arr_data['member_detail']['passing_month'];
                              $pass_year = $arr_data['member_detail']['passing_year'];
                         ?>
                           @if(isset($pass_month) && $pass_month!="" && isset($pass_year) && $pass_year!=0)
                           {{ucfirst($pass_month).' '.$pass_year}} 
                           @else NA
                           @endif
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Marks{{ isset($arr_data['member_detail']['marks_type'])&& $arr_data['member_detail']['marks_type'] !=""  ?ucfirst('/'.$arr_data['member_detail']['marks_type']):' ' }}</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           @if(isset($arr_data['member_detail']['marks_type']) !="" && isset($arr_data['member_detail']['marks']) && $arr_data['member_detail']['marks']!=0)   
                           {{ $arr_data['member_detail']['marks']}}
                           @else NA
                           @endif 
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Pan No</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ isset($arr_data['member_detail']['pan_no'])&& $arr_data['member_detail']['pan_no'] !=""  ?$arr_data['member_detail']['pan_no']:'NA' }} 
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>

                  @if($arr_data['member_detail']['education_country_id']!=358)
	                  <div class="form-group">
	                     <div class="col-sm-5">
	                        <label class="title2" >Outside india education state</label>
	                     </div>
	                     <div class="col-sm-7">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['education_other_state']) && $arr_data['member_detail']['education_other_state']!=''?$arr_data['member_detail']['education_other_state']:'NA'}}
	                        </h4>
	                     </div>
	                  </div>
                        <div class="clearfix"></div>
	                        
	                   <div class="form-group">
	                     <div class="col-sm-5">
	                        <label class="title2" >Outside india education city</label>
	                     </div>
	                     <div class="col-sm-7">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['education_other_city']) && $arr_data['member_detail']['education_other_city']!=''?$arr_data['member_detail']['education_other_city']:'NA'}}
	                        </h4>
	                     </div>
	                  </div> 
	                  <div class="clearfix"></div>    

                  @else
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Education Address</label>
                     </div>
                     <!-- <label class="col-sm-3 col-lg-2 control-label" for="">City</label> -->
                     <div class="col-sm-7">
                        <h4 class="value">
                           @if(isset($arr_data['member_detail']['education_city']) && $arr_data['member_detail']['education_city']!=0)
                           @if(isset($arr_state) && count($arr_state)>0)
                           @foreach($arr_state as $state)
                           @if(isset($state['city']) && sizeof($state['city'])>0)
                           @foreach($state['city'] as $city)
                           @if($arr_data['member_detail']['education_city']==$city['city_id'])  
                           {{ $city['city_name'] or '-' }}
                           @endif
                           @endforeach
                           @endif  
                           @endforeach
                           @endif
                           @else NA
                           @endif
                        </h4>
                     </div>
                  </div>
                  <div class="clearfix"></div>
                  @endif
                <!--  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="main-label" >Tell Us About Your Skill Type :</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           <div class="more">
                           {{ isset($arr_data['member_detail']['about_member'])&& $arr_data['member_detail']['about_member'] !=""  ?ucfirst($arr_data['member_detail']['about_member']):'NA' }} 
                          </div> 
                        </h4>
                     </div>
                   
                  </div>-->
                          
                      <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Total Earnings</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                        {{(isset($total_revenue_ern) && $total_revenue_ern>0)?$total_revenue_ern:0}}
                        </h4>
                     </div>
                  </div>
                          
                      <div class="clearfix"></div>
                          
                       <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Status</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ (isset($arr_data['status']) && $arr_data['status'] !="")?ucfirst($arr_data['status']):'NA' }} 
                        </h4>
                     </div>
                  </div>
                  
                       <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >Register On</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ isset($arr_data['created_at']) && $arr_data['created_at'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['created_at'])):'NA' }} </h4>
                     </div>
                  </div>
                  
                       <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >No .of Uploads</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">{{ (isset($member_interview_count) && $member_interview_count !="")?$member_interview_count:'NA' }}
                        </h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >No .of sales</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ isset($no_of_sale)?$no_of_sale:0 }}
                        </h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="title2" >No .of purchase</label>
                     </div>
                     
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ isset($no_of_purchase)?$no_of_purchase:0 }}
                        </h4>
                     </div>
                  </div>
                   <div class="clearfix"></div>
                  <div class="form-group">
                     <div class="col-sm-5">
                        <label class="main-label" >Admin comment</label>
                     </div>
                     <div class="col-sm-7">
                        <h4 class="value">
                           {{ (isset($arr_data['admin_comments']) && $arr_data['admin_comments']!='' )?$arr_data['admin_comments']:'NA' }}
                        </h4>
                     </div>
                  </div>
                  
                       <div class="clearfix"></div>
                  {!! Form::close() !!}
                           </div>
                       </div>
                       
                           <div class="brd-bottom">&nbsp;</div>
                           
                           <div class="form-group">
                         <div class="text-detail">
                        <label class="title2" >Tell Us About Your Skill Type</label>
                     
                   
                        <h4 class="value">
                           <div class="more" style="    color: #000;
    font-weight: normal;
    line-height: 20px;
    text-align: justify;">
                           {{ isset($arr_data['member_detail']['about_member'])&& $arr_data['member_detail']['about_member'] !=""  ?ucfirst($arr_data['member_detail']['about_member']):'NA' }} 
                          </div> 
                        </h4>
                      </div>
                   
                  </div>
                   </div>
            
             <div class="admin-pro-info">
						<h2><i class="fa fa-user"></i> Employement</h2>
						<div>
						@if(count($arr_member_employer_type_data) > 0)
							 @foreach($arr_member_employer_type_data as $key=>$value)
							 <div id="current_employer" style="box-shadow: 0px 1px 2px 1px #ccc; padding: 10px; margin-bottom: 20px;">
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >Designation</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $value['designation'] }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >Company Name</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $value['company_name'] }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >Confidential</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $value['display_company'] }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<?php
									$countryDetails = DB::table('countries')->where('id',$value['country'])->first();
									$stateDetails = DB::table('state')->where('id',$value['state'])->first();
									$cityDetails = DB::table('city')->where('city_id',$value['city'])->first();
								?>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >Country</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $countryDetails->country_name }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >State</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $stateDetails->state_name }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >City</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $cityDetails->city_name }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >Working Since</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ date('F', mktime(0, 0, 0, $value['start_month'], 10)) }} {{ $value['start_year'] }} - @if($value['end_month'] == 'present') Present @else {{ date('F', mktime(0, 0, 0, $value['end_month'], 10)) }} {{$value['end_year']}} @endif</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-sm-5">
										<label class="title2" >Description</label>
									 </div>
									 <div class="col-sm-7">
										<h4 class="value">{{ $value['description'] }}</h4>
									</div>
								</div>
								<div class="clearfix"></div>
								
							   
							 </div>

							@endforeach
							@endif
							</div>
					</div>
               </div>
           </div>
           <!--new section end here-->
            <!--<div class="row">
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
                        <label class="main-label">Firstname :</label>
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
                        <label class="main-label" >Email :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($arr_data['email']) && $arr_data['email'] !=""  ?$arr_data['email']:'NA' }}</h4>
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
                        <label class="main-label" >Birth Date :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($arr_data['birth_date']) && $arr_data['birth_date'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['birth_date'])):'NA' }}</h4>
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
                        <label class="main-label" >Job Skills :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           @if(isset($all_skill) && $all_skill!='')
                           {{ $all_skill }}
                           @else 
                           NA
                           @endif  
                        </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Experience :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                         <?php  $exp_year =   $arr_data['member_detail']['experience_years'];
                                $exp_month =  $arr_data['member_detail']['experience_month'];
                          ?>
                        @if(isset($exp_year) && $exp_year !="" && isset($exp_month) && $exp_month !="")
                        {{ $exp_year.' Years '.$exp_month.' Month'}}  
                        @else NA
                        @endif  
                        </h4>
                     </div>
                  </div>
                 
                  <div class="form-group" style="">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Employer :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">  
                        @if($arr_data['member_detail']['employer_type']!="")
                        @if($arr_data['member_detail']['employer_type']=='previous')Previous  @endif
                        @if($arr_data['member_detail']['employer_type']=='current')Current @endif 
                        @else NA
                        @endif
                        </h4>
                     </div>
                  </div>

                  @if($arr_data['member_detail']['employer_type']=='current')
                  @if(isset($arr_employer_type_detail) && sizeof($arr_employer_type_detail)>0)
                  @foreach($arr_employer_type_detail as $employer_detail)

                  <div class="form-group" style="">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Duration :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                        <?php  
                               $start_month =  $employer_detail['start_month']; 
                               $start_year  =  $employer_detail['start_year'];
                               /*$end_month   =  $employer_detail['end_month'];
                               $end_year    =  $employer_detail['end_year'];*/
                        ?>
                           @if(isset($start_month) && $start_month !="" && isset($start_year) && $start_year !="")

                           @if($start_month=='01')Jan  @endif
                           @if($start_month=='02')Feb  @endif
                           @if($start_month=='03')Mar  @endif
                           @if($start_month=='04')Apr  @endif
                           @if($start_month=='05')May  @endif
                           @if($start_month=='06')Jun  @endif
                           @if($start_month=='07')Jul  @endif
                           @if($start_month=='08')Aug  @endif
                           @if($start_month=='09')Sep  @endif
                           @if($start_month=='010')Oct @endif
                           @if($start_month=='011')Nov @endif
                           @if($start_month=='012')Dec @endif

                           @for($i=2016;$i>=1976;$i--) 
                           @if($start_year==$i)  
                           {{$i}}
                           @endif
                           @endfor

                           <lable>To</lable>
                           present
                           @endif
                        </h4>
                     </div>
                  </div>

                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Designation :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($employer_detail
                           ['designation']) && $employer_detail['designation'] !=""  ?ucfirst($employer_detail['designation']):'NA' }}
                        </h4>
                     </div>
                  </div>

                  @endforeach
                  @endif
                  @endif

                  @if($arr_data['member_detail']['employer_type']=='previous')
                  @if(isset($arr_employer_type_detail) && sizeof($arr_employer_type_detail)>0)
                  @foreach($arr_employer_type_detail as $employer_detail)

                  <div class="form-group" style="">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Duration :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                        <?php  
                               $start_month =  $employer_detail['start_month']; 
                               $start_year  =  $employer_detail['start_year'];
                               $end_month   =  $employer_detail['end_month'];
                               $end_year    =  $employer_detail['end_year'];
                        ?>
                           @if(isset($start_month) && $start_month !="" && isset($start_year) && $start_year !="" && isset($end_month) && $end_month !="" && isset($end_year) && $end_year !="")

                           @if($start_month=='01')Jan  @endif
                           @if($start_month=='02')Feb  @endif
                           @if($start_month=='03')Mar  @endif
                           @if($start_month=='04')Apr  @endif
                           @if($start_month=='05')May  @endif
                           @if($start_month=='06')Jun  @endif
                           @if($start_month=='07')Jul  @endif
                           @if($start_month=='08')Aug  @endif
                           @if($start_month=='09')Sep  @endif
                           @if($start_month=='010')Oct @endif
                           @if($start_month=='011')Nov @endif
                           @if($start_month=='012')Dec @endif
                           @for($i=2016;$i>=1976;$i--) 
                           @if($start_year==$i)  
                           {{$i}}
                           @endif
                           @endfor

                           @if($start_month !="")
                           <lable>To</lable>
                           @endif

                           @if($end_month=='01')Jan  @endif
                           @if($end_month=='02')Feb  @endif
                           @if($end_month=='03')Mar  @endif
                           @if($end_month=='04')Apr  @endif
                           @if($end_month=='05')May  @endif
                           @if($end_month=='06')Jun  @endif
                           @if($end_month=='07')Jul  @endif
                           @if($end_month=='08')Aug  @endif
                           @if($end_month=='09')Sep  @endif
                           @if($end_month=='010')Oct @endif
                           @if($end_month=='011')Nov @endif
                           @if($end_month=='012')Dec @endif
                           @for($i=2016;$i>=1976;$i--) 
                           @if($end_year==$i)  
                           {{$i}}
                           @endif
                           @endfor
                           @else NA
                           @endif
                        </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Designation :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($employer_detail
                           ['designation']) && $employer_detail['designation'] !=""  ?ucfirst($employer_detail['designation']):'NA' }}
                        </h4>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Company Name :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($employer_detail
                           ['company_name']) && $employer_detail['company_name'] !=""  ?ucfirst($employer_detail['company_name']):'NA' }}
                        </h4>
                     </div>
                  </div>
                  @endforeach
                  @endif
                  @endif
                  

                  @if($arr_data['member_detail']['employment_country_id']!=358)
	                  <div class="form-group">
	                     <div class="col-sm-3 text-right">
	                        <label class="main-label" >Outside india Work Location state :</label>
	                     </div>
	                     <div class="col-sm-9">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['employment_other_state']) && $arr_data['member_detail']['employment_other_state']!=''?$arr_data['member_detail']['employment_other_state']:'NA'}}
	                        </h4>
	                     </div>
	                  </div>
	                        
	                   <div class="form-group">
	                     <div class="col-sm-3 text-right">
	                        <label class="main-label" >Outside india Work Location city :</label>
	                     </div>
	                     <div class="col-sm-9">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['employment_other_city']) && $arr_data['member_detail']['employment_other_city']!=''?$arr_data['member_detail']['employment_other_city']:'NA'}}
	                        </h4>
	                     </div>
	                  </div>     

                  @else      
	                  <div class="form-group">
	                     <div class="col-sm-3 text-right">
	                        <label class="main-label" >Current Work Location :</label>
	                     </div>
	                     <div class="col-sm-9">
	                        <h4 class="value">
	                        
	                        @if(isset($arr_data['member_detail']['current_work_location']) && $arr_data['member_detail']['current_work_location'] !="")
	                           @if(isset($arr_state) && count($arr_state)>0)
	                           @foreach($arr_state as $state)
	                           @if(isset($state['city']) && sizeof($state['city'])>0)
	                           @foreach($state['city'] as $city)
	                           @if($arr_data['member_detail']['current_work_location']==$city['city_id'])  
	                           {{ $city['city_name'] or '-' }}
	                           @endif
	                           @endforeach
	                           @endif  
	                           @endforeach
	                           @endif
	                           @else NA
	                           @endif
	                        </h4>
	                     </div>
	                  </div>
                  @endif
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Resume :</label>
                     </div>
                     <div class="col-sm-9">
                     @if($arr_data['member_detail']['resume'] !="")
                      <h4 class="value"><a href="{{$member_resume_public_path.$arr_data['member_detail']['resume']}}" download='' ><i class="fa fa-download" aria-hidden="true"></i></a>
                     @else
                      <h4 class="value">File Not Exists</h4>
                     @endif 
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Highest Qualification :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($arr_data['member_detail']['qualification'])&& $arr_data['member_detail']['qualification'] !=""  ?$arr_data['member_detail']['qualification']:'NA' }}</h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Specialization :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($arr_data['member_detail']['specialization'])&& $arr_data['member_detail']['specialization'] !=""  ?$arr_data['member_detail']['specialization']:'NA' }}</h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Passing Month & Year :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">  
                        <?php $pass_month = $arr_data['member_detail']['passing_month'];
                              $pass_year = $arr_data['member_detail']['passing_year'];
                         ?>
                           @if(isset($pass_month) && $pass_month!="" && isset($pass_year) && $pass_year!=0)
                           {{ucfirst($pass_month).' '.$pass_year}} 
                           @else NA
                           @endif
                        </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Marks{{ isset($arr_data['member_detail']['marks_type'])&& $arr_data['member_detail']['marks_type'] !=""  ?ucfirst('/'.$arr_data['member_detail']['marks_type']):' ' }} :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           @if(isset($arr_data['member_detail']['marks_type']) !="" && isset($arr_data['member_detail']['marks']) && $arr_data['member_detail']['marks']!=0)   
                           {{ $arr_data['member_detail']['marks']}}
                           @else NA
                           @endif 
                        </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Pan No :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           {{ isset($arr_data['member_detail']['pan_no'])&& $arr_data['member_detail']['pan_no'] !=""  ?$arr_data['member_detail']['pan_no']:'NA' }} 
                        </h4>
                     </div>
                  </div>

                  @if($arr_data['member_detail']['education_country_id']!=358)
	                  <div class="form-group">
	                     <div class="col-sm-3 text-right">
	                        <label class="main-label" >Outside india education state :</label>
	                     </div>
	                     <div class="col-sm-9">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['education_other_state']) && $arr_data['member_detail']['education_other_state']!=''?$arr_data['member_detail']['education_other_state']:'NA'}}
	                        </h4>
	                     </div>
	                  </div>
	                        
	                   <div class="form-group">
	                     <div class="col-sm-3 text-right">
	                        <label class="main-label" >Outside india education city :</label>
	                     </div>
	                     <div class="col-sm-9">
	                        <h4 class="value"> 
	                       		{{isset($arr_data['member_detail']['education_other_city']) && $arr_data['member_detail']['education_other_city']!=''?$arr_data['member_detail']['education_other_city']:'NA'}}
	                        </h4>
	                     </div>
	                  </div>     

                  @else
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Education Address :</label>
                     </div>
                     
                     <div class="col-sm-9">
                        <h4 class="value">
                           @if(isset($arr_data['member_detail']['education_city']) && $arr_data['member_detail']['education_city']!=0)
                           @if(isset($arr_state) && count($arr_state)>0)
                           @foreach($arr_state as $state)
                           @if(isset($state['city']) && sizeof($state['city'])>0)
                           @foreach($state['city'] as $city)
                           @if($arr_data['member_detail']['education_city']==$city['city_id'])  
                           {{ $city['city_name'] or '-' }}
                           @endif
                           @endforeach
                           @endif  
                           @endforeach
                           @endif
                           @else NA
                           @endif
                        </h4>
                     </div>
                  </div>
                  @endif
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Tell Us About Your Skill Type :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           <div class="more">
                           {{ isset($arr_data['member_detail']['about_member'])&& $arr_data['member_detail']['about_member'] !=""  ?ucfirst($arr_data['member_detail']['about_member']):'NA' }} 
                          </div> 
                        </h4>
                     </div>
                   
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>-->
         </div>
      </div>
   </div>
  <!-- <div class="col-md-12">
      <div class="box view-details">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>Profile Information</h3>
            <div class="box-tool">
            </div>
         </div>
         <div class="box-content">
            <div class="row">
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
                        <label class="main-label" >Profile Image</label>
                     </div>
                   
                     <div class="col-sm-9">
                        <h4 class="value" >
                        @if(isset($arr_data['profile_image']) && $arr_data['profile_image']!="")
                        <img style="width: 200px; height: 150px;" src= {{ $user_profile_public_img_path.$arr_data['profile_image']}}  alt="" />
                        @else NA
                        @endif
                        </h4>
                     </div>
                     
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Total Earnings :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                        {{(isset($total_revenue_ern) && $total_revenue_ern>0)?$total_revenue_ern:0}}
                        </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Status :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           {{ (isset($arr_data['status']) && $arr_data['status'] !="")?ucfirst($arr_data['status']):'NA' }} 
                        </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Register On :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ isset($arr_data['created_at']) && $arr_data['created_at'] !=""  ?date(' d  M, Y' ,strtotime($arr_data['created_at'])):'NA' }} </h4>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >No .of Uploads :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">{{ (isset($member_interview_count) && $member_interview_count !="")?$member_interview_count:'NA' }}
                        </h4>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >No .of sales :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           {{ isset($no_of_sale)?$no_of_sale:0 }}
                        </h4>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >No .of purchase :</label>
                     </div>
                     
                     <div class="col-sm-9">
                        <h4 class="value">
                           {{ isset($no_of_purchase)?$no_of_purchase:0 }}
                        </h4>
                     </div>
                  </div>
                  
                  <div class="form-group">
                     <div class="col-sm-3 text-right">
                        <label class="main-label" >Admin comment :</label>
                     </div>
                     <div class="col-sm-9">
                        <h4 class="value">
                           {{ (isset($arr_data['admin_comments']) && $arr_data['admin_comments']!='' )?$arr_data['admin_comments']:'NA' }}
                        </h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>-->
</div>
<!--<div class="row">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>About Interview</h3>
            <div class="box-tool">
            </div>
         </div>
         <div class="box-content">
            <div class="row">
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
                    
                     <div class="col-sm-9">
                        <h4 class="value"><div class="more"> {{ (isset($arr_data['member_detail']['about_interview'])&& $arr_data['member_detail']['about_interview'] !="")?ucfirst($arr_data['member_detail']['about_interview']):'NA' }}</div> </h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>Curriculum</h3>
            <div class="box-tool">
            </div>
         </div>
         <div class="box-content">
            <div class="row">
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
                    
                     <div class="col-sm-9">
                        <h4 class="value"><div class="more"> {{ isset($arr_data['member_detail']['curriculum'])&& $arr_data['member_detail']['curriculum'] !=""  ?ucfirst($arr_data['member_detail']['curriculum']):'NA' }}</div> </h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>Biography</h3>
            <div class="box-tool">
            </div>
         </div>
         <div class="box-content">
            <div class="row">
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
                     
                     <div class="col-sm-9">
                        <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['biography'])&& $arr_data['member_detail']['biography'] !=""  ?ucfirst($arr_data['member_detail']['biography']):'NA' }}</div> </h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>My Interview Experience</h3>
            <div class="box-tool">
            </div>
         </div>
         <div class="box-content">
            <div class="row">
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
                     
                     <div class="col-sm-9">
                        <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['my_interview_experience'])&& $arr_data['member_detail']['my_interview_experience'] !=""  ?ucfirst($arr_data['member_detail']['my_interview_experience']):'NA' }}</div> </h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>



   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>Present Calls In Job Market</h3>
            <div class="box-tool">
            </div>
         </div>
         <div class="box-content">
            <div class="row">
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
                     
                     <div class="col-sm-9">
                        <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['calls_job_market'])&& $arr_data['member_detail']['calls_job_market'] !=""  ?ucfirst($arr_data['member_detail']['calls_job_market']):'NA' }} </div></h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>-->
<!-- END Main Content -->
<script>
   $(document).ready(function() {
  var showChar = 600;
  var ellipsestext = "...";
  var moretext = "more";
  var lesstext = "less";
  $('.more').each(function() {

    var content = $(this).html();

    if(content.length > showChar) {

      var c = content.substr(0, showChar);
      var h = content.substr(showChar-1, content.length - showChar);

      var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

      $(this).html(html);
    }

  });

  $(".morelink").click(function(){
    if($(this).hasClass("less")) {
      $(this).removeClass("less");
      $(this).html(moretext);
    } else {
      $(this).addClass("less");
      $(this).html(lesstext);
    }
    $(this).parent().prev().toggle();
    $(this).prev().toggle();
    return false;
  });
});

</script>

    <script>
         $(document).ready(function() {
            $('.main-h').click(function() {
                $(this).next('.admin-sub').slideToggle('1000');
                $(this).parent('.cat-main-block').toggleClass('active');
                $(this).find('.arrow i').toggleClass('fa-angle-down fa-angle-up')
            });
        });
    
    </script>
 
    
    
@stop

