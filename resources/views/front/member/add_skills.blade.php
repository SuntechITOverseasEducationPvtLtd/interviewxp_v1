<style>
    .sskill_01{width: 18%;}
.sskill_02{width: 90%;}
</style>

@extends('front.layout.main')
@section('middle_content')
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>
    
         <div class="container-fluid fix-left-bar">
            <div class="row">
             @include('front.member.member_sidebar')
              
              <div class="col-sm-9 col-md-9 col-lg-10">
                   <h2 class="my-profile">Add New Skills</h2>
                   <div class="row">
                     
                       <div class="col-sm-4">
                            <div class="top-blocks">
                                <div class="content-block"><h2>INR 50000</h2><h5>TOTAL REVENUE EARNED</h5></div>
                                <div class="img-top-blocks"><img src="{{url('/')}}/images/rupies-img.png" alt="Interviewxp"/></div>
                                
                                <div class="line-img hidden-xs hidden-sm hidden-md"><img src="{{url('/')}}/images/green-line.png" alt="Interviewxp"/></div>
                            </div>
                            
                       </div>
                       
                       <div class="col-sm-4">
                            <div class="top-blocks">
                                <div class="content-block"><h2>INR 50000</h2><h5>CURRENTLY CONFIRMED</h5><h3 class="payout">(Payout Every Month 10th)</h3></div>
                                <div class="img-top-blocks"><img src="{{url('/')}}/images/money-img.png" alt="Interviewxp"/></div>
                                
                                <div class="red-line line-img hidden-xs hidden-sm hidden-md"><img src="{{url('/')}}/images/red-line.png" alt="Interviewxp"/></div>
                            </div>
                          
                       </div>
                       
                       <div class="col-sm-4">
                           <div class="top-blocks">
                                <div class="content-block"><h2>INR 50000</h2><h5>NOT CONFIRMED YET</h5></div>
                                <div class="img-top-blocks"><img src="{{url('/')}}/images/blocks-img.png" alt="Interviewxp"/></div>
                                
                                <div class="line-img hidden-xs hidden-sm hidden-md"><img src="{{url('/')}}/images/blue-line.png" alt="Interviewxp"/></div>
                            </div>
                            
                       </div>
                    
                 
                   </div>
                   
                   <div class="row">
                      <div class="m-top">
                       <div class="col-md-9">
                          
                          <!-- tabing section -->
                          
                          @include('front.layout._operation_status')
                          <h4 class="add-skills-heading">Add New Skills</h4>
                               
                           <div class="outer-border">
                               <form class="" id="frm_add_skill" method="POST" enctype="multipart/form-data" action="{{url('/')}}/member/store_skill">
                                {{ csrf_field() }}
                             <div class="row">
                                 <div class="col-sm-8 col-md-8 col-lg-9">
                                     <input type="text" class="add-skiils-input" name="add_skill" placeholder="Enter Your New Skills" />
                                     <div class="error">{{ $errors->first('add_skill') }}</div>
                                 </div>
                                 <div class="col-sm-4 col-md-4 col-lg-3">
                                     <div class="btn-skill"><button class="add-skill-btn" type="submit"> Add Skill to Profile</button></div>
                                </div>
                                 <input type="hidden" value="{{$enc_id or ''}}" name="enc_id">
                             </div>
                              </form>
                           </div>
                           
                                  <div class="table-search-pati section1-tab add-skiils-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                           
                                                <tr class="top-strip-table">
                                                   
                                                    <td>Skills Added</td>
                                                    <td class="sskill_01">Actions</td>
                                                   
                                                </tr>
                                                 @if(isset($arr_data) && count($arr_data)>0)
                                                 @foreach($arr_data as $skill)
                                                <tr class="strips">
                                                    
                                                    <td>{{$skill['skill_name']}}</td>
                                                     <input type="hidden" name="{{$skill['skill_name']}}" value="{{$skill['skill_id']}}">
                                                    <td><a href="{{url('/member/skill_delete/'.base64_encode($skill['skill_id']))}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                                  
                                                </tr>
                                                @endforeach
                                                @else 
                                                <tr><td>You Haven't Added Any Skill yet. </td></tr>
                                                @endif
                                                                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                          
                          <!-- end -->
                           
                       </div>
                       
                       <div class="col-md-3">
                          
                           <div class="top-blocks-right">
                               <div class="user-block-right">
                                <div class="content-block-right"><h3>MEMBER ID</h3><h4>IXM 000056</h4></div>
                                <div class="img-top-blocks-right"><img src="{{url('/')}}/images/user.png" alt="Interviewxp"/></div>
                               </div>
                            </div>
                         
                           <div class="right-block">
                               <h5>Profile Performance</h5>
                               <table>
                                   <tbody>
                                       <tr>
                                           <td class="sskill_02">
                                                
                                                  <div class="row">
                                                   
                                                   <div class="col-sm-12 col-md-9 col-lg-10">
                                                      <div class="radio-btns table-radio-btn">
                                                         <div class="radio-btn">
                                                            <input id="Radio1" name="selector" type="radio">
                                                            <label for="Radio1">Number of views</label>
                                                            <div class="check"></div>
                                                         </div>
                                                       </div>
                                                   </div>
                                                 
                                                   
                                                   <div class="clearfix"></div>
                                                  </div> 
                                               
                                               
                                           </td>
                                           <td class="table-number">100</td>
                                       </tr>
                                       
                                        <tr>
                                           <td class="sskill_02">
                                                 
                                                  <div class="row">
                                                   
                                                   <div class="col-sm-12 col-md-9 col-lg-10">
                                                      <div class="radio-btns table-radio-btn">
                                                         <div class="radio-btn">
                                                            <input id="Radio2" name="selector" type="radio">
                                                            <label for="Radio2">Number of purchase</label>
                                                            <div class="check"></div>
                                                         </div>
                                                       </div>
                                                   </div>
                                                 
                                                   
                                                   <div class="clearfix"></div>
                                                  </div> 
                                           </td>
                                           <td class="table-number">20</td>
                                       </tr>
                                   </tbody>
                               </table>
                               
                       
                           </div>
                           
                                   <!--contact details box-->
                 
                  <div class="contact-details pull-right dashbord">
                     <div class="inner-details">
                        <h4>Customer Support</h4>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
                           <div class="contact-details2">
                              <h5>Landline:</h5>
                              <h6>040-464687</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
                           <div class="contact-details2">
                              <h5>Mobile no.:</h5>
                              <!-- <h6>9000000009</h6> -->
                              <h6>{{$arr_user_details[0]['mobile_no']}}</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
                           <div class="contact-details2">
                              <h5>Email:</h5>
                             <!--  <h6 class="email">support@interviewxp.com</h6> -->
                             <h6 class="email">{{$arr_user_email[0]['general_email']}}</h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <!--end-->
                           
                           
                       </div>
                  </div>     
                   </div>
                   
                   
              
       </div>
                
    </div>
 </div>
 @endsection
      

