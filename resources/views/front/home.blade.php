<style>
    .shome_01{padding-right: 0px !important;    margin-right: 0px!important;}
.shome_02{width: 100%!important;
    margin-left: 5px!important;}
.shome_03{position: absolute!important;
    width: 70px!important;
    margin-top: -111px!important;
    margin-left: 85px!important;}
.shome_04{padding-left: 0px!important;    margin-left: 0px!important;}
.shome_05{padding-right: 0px!important;}
.shome_06{font-size: 18px!important; color:#ffc000!important}
.shome_07{border-right:none!important;padding: 0 5px!important;}
.shome_08{margin-top: 8px!important;}
.shome_09{padding-left: 20px!important;}
.shome_010{font-size: 12px!important;padding-top: 3px !important; float: right!important;}
.shome_011{padding: 0px!important;}
.shome_012{margin: 0px !important;    padding: 0px !important;}
.shome_013{padding: 0px !important; display:none !important;}
.shome_014{font-size: 12px !important;}
.shome_015{font-size: 10px !important;}
.shome_016{text-align: center !important; color: red !important; font-size: 16px !important;}
</style>


@extends('front.layout.main')
@section('middle_content')

<div class="banner">
   <div class="pattern">
      <div class="container">
         <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9 search">
               <h2>Enhance Your Skills With The Best Real Time Interview Questions &amp; Answers</h2>
               <h4>Prepare for your dream job</h4>
               {{-- <div class="input-box">
               <form method="get" name="frm_search" action="{{url('/')}}/searchskill">
                 {{ csrf_field() }}
               <select data-placeholder="Select Skill" class="chosen-select" title="Select one" name="skill_id" id="skill_name" >
                  <option value=""></option>
                  @if(isset($arr_skill) && sizeof($arr_skill)>0)
                   
                     @foreach($arr_skill as $skill)
                     <option value="{{$skill['id']}}" @if($skill['skill_name']==$skill_name) selected="selected" @endif >{{ucfirst($skill['skill_name'])}}</option>
                     @endforeach
                  @endif
               </select>

                  <div class="error" id="err_search"></div>
                  <button  type="submit" class="search-btn" id="btn_find" name="btn_find" value="find">Find</button>
               </form>   
               </div> --}}

            </div>
         </div>
      </div>
   </div>
</div>
<div class="middle-section">
   <div class="container">
      <!-- <div class="row">
         <div class="col-sm-12">
            <h2 class="experience">Recently Experience</h2>
            <img src="images/bag.png" alt="Interviewxp" class="center-block bag" />
         </div>
      </div> -->
      
      @if(isset($arr_interview) && sizeof($arr_interview)>0)
         @foreach($arr_interview as $interview)
            <div class="box">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-3 shome_01" >
                     <div class="box-left">
                        <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                        <?php  $file_path = $member_interviewimages_path.$interview['image']; 
                        
                        
                        if(($interview['video']!="") && isset($interview['video'])) { $disblk="block"; 
                        $videoID=explode('?v=',$interview['video']);
                        
                        } else{  $disblk="none";  } ?>
                        
                        
                        
                        @if(isset($interview_images_public_path) && ($interview['image']!="") && ($interview['image']!=null) && file_exists($file_path))
                        <img src="{{$interview_images_public_path.$interview['image']}}" alt="Interviewxp" class="img-responsive shome_02"  />
    
  <a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="{{$videoID[1]}}">  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom shome_03"  style=" display:{{$disblk}};"></a>
    
    
                        @elseif(($interview['video']!="") && ($interview['video']!=null) && ($videoID[1]!=""))
                        
                        
                        <img src="https://img.youtube.com/vi/{{$videoID[1]}}/0.jpg" alt="Interviewxp" class="img-responsive" style=" width: 100%; height: 118px;
    margin-left: 5px;"/>
    
 <a data-toggle="modal" href="#videoplayintro" class="videoidtake" id="{{$videoID[1]}}">  <img src="{{url('/')}}/images/icon-play.svg" class="img-zoom shome_03"  style=" display:{{$disblk}};"></a>
    
     @else
                        <img src="{{url('/')}}/uploads/no-image.png" alt="Interviewxp" class="img-responsive shome_02" />
    
 
    
    
                        @endif
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-9 mar-left-px shome_04" >
                     <div class="row box-right">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
            						   <?php
            								$interview_skill_name = '';
            								if(isset($interview['skill_name']) && isset($interview['experience_level'])  && $interview['experience_level'] != 'NA')
            								{
            									$interview_skill_name = $interview['allskill'].' Real Time Interview Questions &amp; Answers ( '.$interview['experience_level'].' Year Exp )';
            								}
            								else if(($interview['skill_name']) && isset($interview['experience_level'])){									
            									$interview_skill_name = $interview['allskill'].' Interview Questions &amp; Answers';
            								}
            						   ?>
                           <h4>{{$interview_skill_name}}</h4>
                           </a>
                         </div>
                           <?php
                        $interviewDetails = DB::table('interview_detail as i')->join('company_master as c','c.company_id','=','i.company_id')->where('interview_id',$interview['id'])->where('approve_status',1)->select('c.company_name','i.company_location','i.approve_date','i.company_source')->get();
                             $topdollers=0;
                              ?>
                      
                           <?php
                            $obj_price_list = $PriceListModel->where('exp_level',$interview['experience_level'])->first();
                            $obj_user_info = $UserModel->where(['id'=>$interview['user_id']])->first();
                            ?>
                          



						              <div class="col-sm-11 col-md-11 col-lg-11" >
                           <ul class="shome_05">
                            <li class="shome_05">
                                 <div class="star-wrapper">
                                   <div class="starrr">  
                                  <!--@if(isset($interview['average_star']))
                                     @for($i=1;$i<=$interview['average_star'];$i++)
                                        <img src="{{url('/')}}/images/star.png"/>
                                      @endfor          
                                      @for($i=$interview['average_star'];$i<5;$i++)
                                        <img src="{{url('/')}}/images/blank_star.png"/>
                                      @endfor
                                    @endif -->
                                    
                                     <?php if(isset($interview['average_rating'][0]['review_star'])) { $interview_id=$interview['id'];  
                                  
                                     $allcoun5 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','5')->count(); 
   
   $allcoun4 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','4')->count(); 
   
   $allcoun3 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','3')->count();  
   
   $allcoun2 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','2')->count();   
   
   $allcoun1 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','1')->count(); 
                                    
                                      $allcountr = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->count();
                                   $allcountrstra=($allcountr);
                                    
                                     $totalrag=($allcoun5*5)+($allcoun4*4)+($allcoun3*3)+($allcoun2*2)+($allcoun1*1); $average_rating=($totalrag/$allcountrstra); }  else { $average_rating=0; } ?>
                                     
                                     
                                        <div class="starrr">
                            @for($ib=1;$ib<=$average_rating;$ib++)
                       <i class="fa fa-star shome_06" aria-hidden="true"></i>
                    @endfor     
                    
                    <?php $reviewvalu=explode('.',$average_rating); if(isset($reviewvalu[1]) && $reviewvalu!=0) { $average_ratingm=$average_rating+1; echo  '<i class="fa fa-star-half-o" aria-hidden="true" style="font-size: 18px; color:#ffc000"></i>'; }
                    else { $average_ratingm=$average_rating; }?>
                    
                    @for($i=$average_ratingm;$i<5;$i++)
                        <i class="fa fa-star-o shome_06" aria-hidden="true" ></i>
                    @endfor
                        </div>
                        
                        
                        
                                  
                                    </div>
                                    
                                 </div>
                              </li>
                              <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> {{isset($interview['user_purchase_details'])?count($interview['user_purchase_details']):''}} Learners</li>
                              <!-- <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i> 1000 Views</li> -->
                              <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i>{{isset($interview['view_count'])?$interview['view_count']:''}} Views</li>
                              <li class="hidden-xs">Last updated {{isset($interview['publish_date'])?date('d M Y', strtotime($interview['publish_date'])):' '}}</li>
                           </ul>
            						   <ul>
            								@if($interview['admin_approval_qa']==1)
                            <li class="shome_07">
                              <div class="check-box shome_08" >
                                <input class="css-checkbox ads_Checkbox interviewqa-price" value="{{@$obj_price_list->ref_book_price}}" attrid="{{@$interview['id']}}" id="radio_interviewqa{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
                                <label class="css-label radGroup2 shome_09" for="radio_interviewqa{{@$interview['id']}}" ></label>
                                <span class="shome_010">Interview Q&A</span>
                              </div>
                            </li>
                            @endif
            								<li class="shome_07">
            									<div class="check-box shome_08" >
            										<input class="css-checkbox ads_Checkbox interviewcoach-price" value="{{@$obj_price_list->validity}}" attrid="{{@$interview['id']}}" id="radio_textresume{{@$interview['id']}}" name="reference_book_textResume" type="checkbox" checked="checked">
            										<label class="css-label radGroup2 shome_09" for="radio_textresume{{@$interview['id']}}"></label>
            										<span class="shome_010">Interview Coaching & Resume Preparation</span>
            									</div>
            								</li>                            
            								@if(!empty($obj_user_info->company_qa_tab) && $interview['admin_approval_company']==1)
            								<li class="shome_07">
            									<div class="check-box shome_08" >
            										<input class="css-checkbox ads_Checkbox company-price" value="{{@$obj_price_list->interview_price}}" attrid="{{@$interview['id']}}" id="radio_companies{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
            										<label class="css-label radGroup2 shome_09" for="radio_companies{{@$interview['id']}}" ></label>
            										<span class="shome_010">Interviews by Companies</span>
            									</div>
            								</li>
            								@endif
            								@if(!empty($obj_user_info->real_issues_qa_tab) && $interview['admin_approval_realissues']==1)
            								<li  class="shome_07">
            									<div class="check-box shome_08" >
            										<input class="css-checkbox ads_Checkbox realtime-price" value="{{@$obj_price_list->price_for_25_ticket}}" attrid="{{@$interview['id']}}" id="radio_realtime{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
            										<label class="css-label radGroup2 shome_09" for="radio_realtime{{@$interview['id']}}" ></label>
            										<span class="shome_010">Realtime work Experience</span>
            									</div>
            								</li>
            								@endif
            								@if(!empty($obj_user_info->training_tab) && !empty($arr_training_schedule))
            								<li  class="shome_07">
            									<div class="check-box shome_08">
            										<input class="css-checkbox ads_Checkbox training-price" value="{{@$obj_price_list->training_price}}" attrid="{{@$interview['id']}}" id="radio_training{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
            										<label class="css-label radGroup2 shome_09" for="radio_training{{@$interview['id']}}" ></label>
            										<span class="shome_010">Online Training</span>
            									</div>
            								</li>
            								@endif
            						   </ul>
                        </div>
                        
                         <div class="col-sm-1 col-md-1 col-lg-1  rupies shome_011" >
                             <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                             <h2 class="money-icon shome_012" >Inr</h2>
                             <h2 class="total-amount{{@$interview['id']}} shome_012"  >
                             {{@(int)$obj_price_list->validity}}
                             </h2>
                             </a>
                            </div>
                           
                         @if(empty($interviewDetails))  
                         <?php
                        $obj_price_list = $PriceListModel->where('exp_level',$interview['experience_level'])->first();
                        $obj_user_info = $UserModel->where(['id'=>$interview['user_id']])->first();
                        ?>
                       <div class="col-sm-1 col-md-1 col-lg-1  rupies shome_013">
                         <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                         <h2 class="money-icon">Inr</h2>
                         <h2 class="total-amount{{@$interview['id']}}">
                         {{@(int)$obj_price_list->validity}}
                         </h2>
                         </a>
                        </div>
                        @endif
                        
                        
                              @if(count($interviewDetails) > 0)  
                            
                          
                           <div class="col-sm-12">
                             <div class="left">
                                <img src="{{url('/'.'images/left-arrow-button.png')}}"  class="left-button" rel="{{$interview['id']}}">
                              </div>
                             <div class="center" id="content{{$interview['id']}}">                            
                              @foreach($interviewDetails as $company)
                              <div class=internal>
                                <p class="shome_014" title="{{$company->company_name}} ({{$company->company_location}})"> {{$company->company_name}} ({{$company->company_location}})</p>
                                <p class="shome_015">Source : {{($company->company_source=='ex-student') ? 'Ex Student' : ucfirst($company->company_source)}}.&nbsp;&nbsp;{{date('M d, Y',strtotime($company->approve_date))}}</p>
                              </div>
                            
                              @endforeach                              
                               
                             </div>
                            <div class="right">
                              <img src="{{url('/'.'images/right-arrow-button.png')}}"  class="right-button" rel="{{$interview['id']}}">
                              </button>
                            </div>
                           </div>
 @endif 
 
 
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
            
      @else
         <div class="box">
            <div class="row">
                 <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="shome_016">Sorry no records found!!</div>
                  </div>
            </div>      
         </div>
      @endif

      @if(isset($arr_interview) && sizeof($arr_interview)>6)
         <div class="view-btn-wrapper"><a href="{{url('/')}}/view_all">
         <button class="view-btn">VIEW ALL</button></a>
         </div>
      @endif
      <!--  <div class="box">
               <div class="row">
                  <div class="col-sm-12 col-md-3 col-lg-3">
                     <div class="box-left"><img src="images/img1.jpg" alt="Interviewxp" class="img-responsive" /></div>
                  </div>
                  <div class="col-sm-12 col-md-9 col-lg-9 mar-left-px">
                     <div class="row box-right">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                           <h4>Php and mysql Real Time Interview Questions &amp; Answers ( 0-2 Year Exp )</h4>
                           <h5>Last update Dec 2016</h5>
                           <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                           <ul>
                               <li>
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating" value="1"/>
                                       <input class="star" type="radio" name="rating" value="2"/>
                                       <input class="star" type="radio" name="rating" value="3"/>
                                       <input class="star" type="radio" name="rating" value="4"/>
                                       <input class="star" type="radio" name="rating" value="5"/>
                                    </div>
                                    <span>Ratings</span>
                                 </div>
                              </li>
                              <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> 100 Users</li>
                              <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i> 1000 Views</li>
                           
                           </ul>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 text-center rupies">
                           <h2 class="money-icon">Inr</h2>
                           <h2>2,000</h2>
                        </div>
                     </div>
                  </div>
               </div>
        </div> -->
   </div>
</div>
<div class="section2">
   <div class="pattern-middle-banner">
      <div class="container">
         <div class="row">
            <div class="middle-banner">
           <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                  <!-- <h2>45,80000</h2> -->
                  <h2><span class="count">{{isset($arr_user_count)?$arr_user_count:'0'}}</span></h2>
                  <p>Learners</p> 
               </div>
               <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                  <!-- <h2>45,80000</h2> -->
                  <h2><span class="count">{{isset($arr_member_count)?$arr_member_count:'0'}}</span></h2>
                  <p>Interview Coaches</p> 
               </div>
               <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                  <h2><span class="count">{{isset($count_approve)?$count_approve:'0'}}</span></h2>
                  <p>No.Of Skills</p>
               </div>
               <div class="col-sm-3 col-md-3 col-lg-3 text-center">
                  <!-- <h2>45,80000</h2> -->
                  <h2><span class="count">{{isset($arr_interview_hours_count)?$arr_interview_hours_count:'0'}}</span></h2>
                  <p>Hours of Interview Coaching</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container section3">
 <!--   <h2 class="text-center">Category</h2> -->
   <img class="center-block" alt="Inetrviewxp" src="{{url('/')}}/images/bag.png" />
   <section class="category">
      <div class="ul-category">
         <h4>By Category</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
         @if(isset($arr_category) && sizeof($arr_category)>0)
         <?php $count_category = 0; ?>
         @foreach($arr_category as $category)
            <li><a href="{{url('/')}}/category/{{base64_encode($category['id'])}}" title="{{$category['category_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{(strlen(trim($category['category_name'])) > 24) ? substr(trim($category['category_name']),0,21).'...' : $category['category_name']}}</a></li>
            <?php $count_category = $count_category+1;  ?>
            @if($count_category==7)
            <?php break; ?>
            @endif
         @endforeach
         @else
         <span class="error">Category not available</span>
         @endif
             
         @if(isset($arr_category) && sizeof($arr_category)>7)
         <a href="{{url('/')}}/all_category"><div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div></a>
         @endif
            
         </ul>
         <div class="clearfix"></div>
      </div>
      <div class="ul-category">
         <h4>By Skills</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
          @if(isset($arr_skills) && sizeof($arr_skills)>0)
          <?php $count_skills = 0; ?>
         @foreach($arr_skills as $skills)
            <li><a href="{{url('/')}}/skill/{{base64_encode($skills['skill_name'])}}" title="{{$skills['skill_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{(strlen(trim($skills['skill_name'])) > 24) ? substr(trim($skills['skill_name']),0,21).'...' : $skills['skill_name']}}</a></li>
            <?php $count_skills = $count_skills+1;  ?>
            @if($count_skills==7)
            <?php break; ?>
            @endif
         @endforeach
         @else
         <span class="error">Skills not available</span>
         @endif  
             
         @if(isset($arr_skills) && sizeof($arr_skills)>7)
         <a href="{{url('/')}}/all_skills"><div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div></a>
         @endif
            <div class="clearfix"></div>
         </ul>
         
      </div>
      <div class="ul-category">
         <h4>By Company</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">

           @if(isset($arr_company) && sizeof($arr_company)>0)
          <?php $count_company = 0; ?>
         @foreach($arr_company as $company)
            <li><a href="{{url('/')}}/company/{{base64_encode($company['company_name'])}}" title="{{$company['company_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{(strlen(trim($company['company_name'])) > 24) ? substr(trim($company['company_name']),0,21).'...' : $company['company_name']}}</a></li>
            <?php $count_company = $count_company+1;  ?>
            @if($count_company==7)
            <?php break; ?>
            @endif
         @endforeach
         @else
         <span class="error">Companies not available</span>
         @endif
             
         @if(isset($arr_company) && sizeof($arr_company)>7)
         <a href="{{url('/')}}/all_company"><div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div></a>
         @endif

         </ul>
         <div class="clearfix"></div>
      </div>
      <div class="ul-category">
         <h4>By Qualification</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
          @if(isset($arr_qualification) && sizeof($arr_qualification)>0)
          <?php $count_qualification = 0; ?>
         @foreach($arr_qualification as $qualification)
            <li><a href="{{url('/')}}/qualification/{{base64_encode($qualification['id'])}}" title="{{$qualification['qualification_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{(strlen(trim($qualification['qualification_name'])) > 24) ? substr(trim($qualification['qualification_name']),0,21).'...' : $qualification['qualification_name']}}</a></li>
			<?php $count_qualification = $count_qualification+1;  ?>
            @if($count_qualification==7)
            <?php break; ?>
            @endif
         @endforeach
         @else
         <span class="error">Qualification not available</span>
         @endif
             
             @if(isset($arr_qualification) && sizeof($arr_qualification)>7)
         <a href="{{url('/')}}/all_qualification"><div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div></a>
         @endif
             
         </ul>
         <div class="clearfix"></div>
      </div>
      <div class="ul-category p-r-0">
         <h4>By Specialization</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
            @if(isset($arr_specialization) && sizeof($arr_specialization)>0)
            <?php $count_specialization = 0; ?>
         @foreach($arr_specialization as $specialization)
            <li><a href="{{url('/')}}/specialization/{{base64_encode($specialization['specialization_name'])}}" title="{{$specialization['specialization_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{(strlen(trim($specialization['specialization_name'])) > 33) ? substr(trim($specialization['specialization_name']),0,30).'...' : $specialization['specialization_name']}}</a></li>
			<?php $count_specialization = $count_specialization+1;  ?>
            @if($count_specialization==7)
            <?php break; ?>
            @endif
         @endforeach
         @else
         <span class="error">Specialization not available</span>
         @endif 
             
             @if(isset($arr_specialization) && sizeof($arr_specialization)>7)
         <a href="{{url('/')}}/all_specialization"><div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div></a>
         @endif
             
         </ul>
         <div class="clearfix"></div>
      </div>
   </section>
</div>

<script>
	$(document).on('click load', '.interviewcoach-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	
	$(document).on('click', '.interviewqa-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	$(document).on('click', '.training-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	$(document).on('click', '.company-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	$(document).on('click', '.realtime-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
</script>
<script type="text/javascript">
  $('.right-button').click(function() {
    var id = $(this).attr('rel'); 
    event.preventDefault();
    $('#content'+id).animate({
      scrollLeft: "+=300px"
    }, "slow");
 });
 
   $('.left-button').click(function() {    
    var id = $(this).attr('rel'); 
    event.preventDefault();
    $('#content'+id).animate({
      scrollLeft: "-=300px"
    }, "slow");
 });
</script>
<style type="text/css">
 /* Put your css in here */

  .left{
   float: left; 
   width: 3%; margin-left: -26px;
  }

.box-right h4 {
    
       color: #17b0a4;
    font-family: 'ubunturegular',sans-serif;
    font-size: 18px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: 10px;
    margin-bottom: 5px; 
}
  .internal{
   width: 31.75%;
   height: 85%;     padding-top: 0px;
   /*border: 1px solid #eee;*/
  /*box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.03); */
      border-right: 1px solid #13bab214;
   display: inline-block;
  }

  .center{
   float: left; 
   width: 95%;
     height: 33px;
   margin: 1px;
   overflow: hidden;
   /*will change this to hidden later to deny scolling to user*/
   white-space: nowrap;     margin-left: -2px;
  }

  .right{
   float: right; 
   width: 3%;     margin-right: 12px;
  }
  .right img, .left img {
    width: 100%;
    margin-top: 8px;
  }
  .box-right .center p {
      margin: 0px 4px;
    height: 16px;
    font-size: 12px;
  }

.money-icon, .rupies h2 {font-size: 20px; }

.cd-top {
    background: #13bab2 url(images/up-arrow.png) no-repeat scroll center 50%; } 
.box-right p {    color: #888; }
</style>

@endsection