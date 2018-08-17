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
<div class="middle-section min-height">
   <div class="container">
      <!-- <div class="row">
         <div class="col-sm-12">
            <h2 class="experience">Recently Experience</h2>
            <img src="images/bag.png" alt="Interviewxp" class="center-block bag" />
         </div>
      </div> -->
      
@if(isset($arr_interview) && sizeof($arr_interview)>0)
         @foreach($arr_interview['data'] as $interview)
        
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
                           <p>{{isset($interview['meta_description'])?str_limit(ucfirst($interview['meta_description']),$limit = 290, $end='...'):' '}}</p>
                           </a>
                           <ul style="padding-right: 0px;">
                              <li style="padding-right: 0px;">
                                 <div class="star-wrapper">
                                   <div class="starrr"> 
                                   
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
       <div class="prod-pagination">
            {{$arr_pagination->render()}}
      </div> 
     <!--  @if(isset($arr_interview) && sizeof($arr_interview)>6)
         <div class="view-btn-wrapper"><a href="{{url('/')}}/view_all">
         <button class="view-btn">VIEW ALL</button></a>
         </div>
      @endif -->
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








@endsection

