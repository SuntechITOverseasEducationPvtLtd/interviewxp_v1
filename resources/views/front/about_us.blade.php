@extends('front.layout.main')
@section('middle_content')


<div class="banner-member">
     <div class="pattern-member about-banner pattern-search">
     </div>
</div>
<div class="middle-area">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="about-us-img"><img src="{{url('/')}}/images/about-us.jpg" class="img-responsive" alt="Interviewxp" /></div>
               </div>
               <div class="col-lg-6">
                  <div class="about-us">
                     <h2><span>About</span> Us</h2>
                     @if(isset($arr_data) && sizeof($arr_data)>0)
                     <?php echo html_entity_decode($arr_data['page_desc'], ENT_QUOTES, 'UTF-8');?>
                      @else
                         <p>Record Not Found</p>
                      @endif
                  </div>
               </div>
            </div>
            {{-- <p class="para">Interviewxp is a platform for people who need to know how to excel in their career path. It is a fastest growing skill based portal. Aspiring jobseekers will be benefited as they will know the insights of a job skill. We aim to create a place where people will find latest interview questions and answers in all categories. We aim to empower jobseekers to expand their knowledge. You will soon be able to find real time work experience of many people from all job categories.</p> --}}
         </div>
      </div>
      <div class="about-middle-area">
         <div class="about-us-pattern">
            <div class="container">
               <div class="row">
                  <div class="col-sm-4">
                     <div class="about-wrapper">
                        <div class="job-search-img"><img src="{{url('/')}}/images/interview.png" alt="Interviewxp"/></div>
                        <h4>Hundreds of Interview Q &amp; A</h4>
                        <p>Know what exactly an interviewer looking for and work for those points, so that they will have you on board.</p>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="about-wrapper">
                        <div class="job-search-img"><img src="{{url('/')}}/images/job-search.png" alt="Interviewxp"/></div>
                        <h4>Skill based search</h4>
                        <p>Find the most typical questions by skill. Find the skills you need to ace your interview.</p>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="about-wrapper">
                        <div class="job-search-img"><img src="{{url('/')}}/images/career.png" alt="Interviewxp"/></div>
                        <h4>Real time work experience</h4>
                        <p>Know Day to day activities at work, minor and major issues at work, business standards, work flow process.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      {{-- <div class="container">
         <div class="row">
            <h2 class="about-bottom-h">What People Say</h2>
            <div id="demos" data-nav="Demos <span class='amp'>&amp;</span> Usage">
               <div class="automatic-slider">
                  <ul>
                     <li>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating" value="1"/>
                                       <input class="star" type="radio" name="rating" value="2"/>
                                       <input class="star" type="radio" name="rating" value="3"/>
                                       <input class="star" type="radio" name="rating" value="4"/>
                                       <input class="star" type="radio" name="rating" value="5"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating2" value="6"/>
                                       <input class="star" type="radio" name="rating2" value="7"/>
                                       <input class="star" type="radio" name="rating2" value="8"/>
                                       <input class="star" type="radio" name="rating2" value="9"/>
                                       <input class="star" type="radio" name="rating2" value="10"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating3" value="11"/>
                                       <input class="star" type="radio" name="rating3" value="12"/>
                                       <input class="star" type="radio" name="rating3" value="13"/>
                                       <input class="star" type="radio" name="rating3" value="14"/>
                                       <input class="star" type="radio" name="rating3" value="15"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating4" value="16"/>
                                       <input class="star" type="radio" name="rating4" value="17"/>
                                       <input class="star" type="radio" name="rating4" value="18"/>
                                       <input class="star" type="radio" name="rating4" value="19"/>
                                       <input class="star" type="radio" name="rating4" value="20"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating5" value="21"/>
                                       <input class="star" type="radio" name="rating5" value="22"/>
                                       <input class="star" type="radio" name="rating5" value="23"/>
                                       <input class="star" type="radio" name="rating5" value="24"/>
                                       <input class="star" type="radio" name="rating5" value="25"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating6" value="26"/>
                                       <input class="star" type="radio" name="rating6" value="27"/>
                                       <input class="star" type="radio" name="rating6" value="28"/>
                                       <input class="star" type="radio" name="rating6" value="29"/>
                                       <input class="star" type="radio" name="rating6" value="30"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                     <li>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating7" value="31"/>
                                       <input class="star" type="radio" name="rating7" value="32"/>
                                       <input class="star" type="radio" name="rating7" value="33"/>
                                       <input class="star" type="radio" name="rating7" value="34"/>
                                       <input class="star" type="radio" name="rating7" value="35"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="about-bottom-section">
                              <div class="about-b"><img src="{{url('/')}}/images/about-us-p1.jpg" alt="Interviewxp"/></div>
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="name">
                                 <h3>Gina J. Hall</h3>
                                 <h4>Media Adviser</h4>
                              </div>
                              <div class="about-star">
                                 <div class="star-wrapper">
                                    <div class="starrr">
                                       <input class="star required" type="radio" name="rating8" value="36"/>
                                       <input class="star" type="radio" name="rating8" value="37"/>
                                       <input class="star" type="radio" name="rating8" value="38"/>
                                       <input class="star" type="radio" name="rating8" value="39"/>
                                       <input class="star" type="radio" name="rating8" value="40"/>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div> --}}
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/unslider-min.js"></script>
<script>
   $('.automatic-slider').unslider({
       autoplay: true
   });
</script>
@endsection

