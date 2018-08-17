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
                  <div class="col-sm-12 col-md-12 col-lg-3">
                     <div class="box-left">
                        <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                        <?php  $file_path = $member_interviewimages_path.$interview['image'];  ?>
                        @if(isset($interview_images_public_path) && ($interview['image']!="") && ($interview['image']!=null) && file_exists($file_path))
                        <img src="{{$interview_images_public_path.$interview['image']}}" alt="Interviewxp" class="img-responsive"  width ="200" height="100"/>
                        @else
                        <img src="{{url('/')}}/uploads/no-image.png" alt="Interviewxp" class="img-responsive"/>
                        @endif
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-9 mar-left-px">
                     <div class="row box-right">
                        <div class="col-sm-10 col-md-10 col-lg-10">
                           <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                           <h4>{{isset($interview['skill_name'])?ucfirst($interview['skill_name']):' '}} Real Time Interview Questions &amp; Answers ( {{isset($interview['experience_level'])?$interview['experience_level']:' '}} Year Exp )</h4>
                           <h5>Last update {{isset($interview['publish_date'])?date('d M Y', strtotime($interview['publish_date'])):' '}}</h5>
                           </a>
						   <?php 
							$userInfoskill = DB::table('interview_coach')->where('User_Id', $interview['user_id'])->first();
							if(isset($userInfoskill)){
								$name = ucwords(strtolower(mb_strimwidth($userInfoskill->Summary, 0, 280)));
								echo "<p>".$name."</p><br/>";
							}
							?>
                           <ul style="padding-right: 0px;">
                              <li style="padding-right: 0px;">
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
                                    @if(isset($interview['average_rating'][0]['review_star']))
                                     @for($i=1;$i<=$interview['average_rating'][0]['review_star'];$i++)
                                        <img src="{{url('/')}}/images/star.png"/>
                                      @endfor          
                                      @for($i=$interview['average_rating'][0]['review_star'];$i<5;$i++)
                                        <img src="{{url('/')}}/images/blank_star.png"/>
                                      @endfor
                                    @endif 
                                    @if(empty($interview['average_rating']))
                                    @for($i=0;$i<5;$i++)
                                        <img src="{{url('/')}}/images/blank_star.png"/>
                                      @endfor
                                    @endif
                                    </div>
                                    <span>Ratings</span>
                                 </div>
                              </li>
                              <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> {{isset($interview['user_purchase_details'])?count($interview['user_purchase_details']):''}} Users</li>
                              <!-- <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i> 1000 Views</li> -->
                              <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i>{{isset($interview['view_count'])?$interview['view_count']:''}} Views</li>
                           </ul>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 text-center rupies">
                           <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                           <h2 class="money-icon">Inr</h2>
                           <h2>
                           @if(isset($arr_price) && sizeof($arr_price)>0)
                           @foreach($arr_price as $price)
                           @if(isset($interview['experience_level']) && $price['exp_level']==$interview['experience_level']) {{$price['ref_book_price']}}
                           @endif
                           @endforeach
                           @endif
                           </h2>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
            
      @else
         <div class="box">
            <div class="row">
                 <div class="col-sm-12 col-md-12 col-lg-12">
                     <div  style="text-align: center; color: red; font-size: 16px;">Sorry no records found!!</div>
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
               <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                  <!-- <h2>45,80000</h2> -->
                  <h2><span class="count">{{isset($arr_user_count)?$arr_user_count:'0'}}</span></h2>
                  <p>Registered User</p> 
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                  <h2><span class="count">{{isset($count_approve)?$count_approve:'0'}}</span></h2>
                  <p>Total No.Of Uploads</p>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                  <!-- <h2>45,80000</h2> -->
                  <h2><span class="count">{{isset($arr_member_count)?$arr_member_count:'0'}}</span></h2>
                  <p>Registered Members</p>
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
            <li><a href="{{url('/')}}/category/{{base64_encode($category['id'])}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{$category['category_name']}}</a></li>
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
            <li><a href="{{url('/')}}/skill/{{base64_encode($skills['id'])}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{$skills['skill_name']}}</a></li>
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
            <li><a href="javascript:void(0)"><i class="fa fa-circle-o" aria-hidden="true"></i>{{$company['company_name']}}</a></li>
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
            <li><a href="{{url('/')}}/qualification/{{base64_encode($qualification['id'])}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{$qualification['qualification_name']}}</a></li>
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
            <li><a href="{{url('/')}}/specialization/{{base64_encode($specialization['id'])}}"><i class="fa fa-circle-o" aria-hidden="true"></i>{{$specialization['specialization_name']}}</a></li>
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


@endsection