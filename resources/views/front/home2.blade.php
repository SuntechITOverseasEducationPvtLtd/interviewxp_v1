@extends('front.layout.main')
@section('middle_content')

<div class="banner">
   <div class="pattern">
      <div class="container">
         <div class="row">
            <div class="col-sm-9 col-md-9 col-lg-9 search">
               <h2>Enhance Your Skills With The Best Real Time Interview Question &amp; Answer</h2>
               <h4>Prepare for your dream job</h4>
               <div class="input-box">
               <form method="get" name="frm_search" action="{{url('/')}}/searchskill">
                 {{ csrf_field() }}
                  <!-- <input placeholder="Type Your Skill..." type="text" name="skill_name" id="skill_name" /> -->

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
               </div>

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
                        <!-- <img src="images/img1.jpg" alt="Interviewxp" class="img-responsive" />-->
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
                           <h5>Last update {{isset($interview['updated_at'])?date('d M Y', strtotime($interview['updated_at'])):' '}}</h5>
                           <p>{{isset($interview['meta_description'])?str_limit(ucfirst($interview['meta_description']),$limit = 290, $end='...'):' '}}</p>
                           </a>
                           <ul>
                              <li>
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       {{-- <input class="star required" type="radio" name="rating" value="1"/>
                                       <input class="star" type="radio" name="rating" value="2"/>
                                       <input class="star" type="radio" name="rating" value="3"/>
                                       <input class="star" type="radio" name="rating" value="4"/>
                                       <input class="star" type="radio" name="rating" value="5"/>  --}}
                                    </div>
                                    <span>Ratings</span>
                                 </div>
                              </li>
                              <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> 100 Users</li>
                              <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i> 1000 Views</li>
                           </ul>
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2 text-center rupies">
                           <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                           <h2 class="money-icon">Inr</h2>
                           <h2>2,000</h2>
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
      <div class="view-btn-wrapper"><button class="view-btn">VIEW ALL</button></div>
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
                  <h2>45,80000</h2>
                  <p>Registered User</p>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                  <h2>11,80000</h2>
                  <p>Total Posted Interview Questions &amp; Answer</p>
               </div>
               <div class="col-sm-4 col-md-4 col-lg-4 text-center">
                  <h2>45,80000</h2>
                  <p>Registered User Members</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="container section3">
   <h2 class="text-center">Category</h2>
   <img class="center-block" alt="Inetrviewxp" src="{{url('/')}}/images/bag.png" />
   <section class="category">
      <div class="ul-category">
         <h4>By Category</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Accounting / Auditing / Tax</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Administration / Secreatry</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Animation / Gaming</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Automobile / Auto</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Auditing / Tax / Front Office</a></li>
            <div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div>
         </ul>
      </div>
      <div class="ul-category">
         <h4>By Skills</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> IT / Tax / Front Office</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Marketing Manager</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Software / Gaming</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> ASP.Net / Auto</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Sales Manger</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
            <div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div>
         </ul>
      </div>
      <div class="ul-category">
         <h4>By Company</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Accounting / Auditing / Tax</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Administration / Secreatry</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Animation / Gaming</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Automobile / Auto</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Auditing / Tax / Front Office</a></li>
            <div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div>
         </ul>
      </div>
      <div class="ul-category">
         <h4>By Qualification</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> IT / Tax / Front Office</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Marketing Manager</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Software / Gaming</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> ASP.Net / Auto</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Sales Manger</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
            <div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div>
         </ul>
      </div>
      <div class="ul-category">
         <h4>By Specialization</h4>
         <div class="heading-border">&nbsp;</div>
         <ul class="menu_name">
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> IT / Tax / Front Office</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Marketing Manager</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Software / Gaming</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> ASP.Net / Auto</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Sales Manger</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
            <li><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
            <div class="text-center"><button type="button" class="category-btn">VIEW ALL</button></div>
         </ul>
      </div>
   </section>
</div>
<script type="text/javascript">
   $('#btn_find').click(function(){
      var skill_name=$('#skill_name').val();
      if(skill_name=='' || skill_name==null)
      {
         $('#skill_name').val('');
         $('#err_search').html('Please select skill field for searching.');
         $('#skill_name').keyup(function () {  $('#err_search').html(''); });
         $("#skill_name").focus();
         return false;
      }
   });
</script>

<link href="{{url('/')}}/css/front/chosen.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/chosen.jquery.js"></script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/search-dropdown.js"></script>
   <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>


@endsection

