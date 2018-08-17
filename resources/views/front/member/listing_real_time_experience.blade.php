@extends('front.layout.main')
@section('middle_content')
<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
   @include('front.member.member_sidebar')
      <div class="col-sm-8 col-md-9 col-lg-10">
         <div class="heading-content">
            <h2 class="my-profile pages">My Real Time Experience</h2>
            <h4 class="manage">Manage Real Time Experience Added</h4>
         </div>
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9">
               <div class="middle part">
                  <div class="outer-box">
                     <div class="sub-heading-content">
                        <h4>My Real Time Experience (Tickets, Tasks &amp; Issues)</h4>
                        <h5>100 Tickest, Tasks &amp; Issues Added</h5>
                     </div>
                     <div class="table-search-pati section1-tab">
                        <div class="table-responsive">
                           <table class="table">
                              <tbody>
                                 <tr class="top-strip-table">
                                    <td>
                                       <div class="check-box-UserAlert">
                                          <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                                          <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                                       </div>
                                    </td>
                                    <td>S.No.</td>
                                    <td>Issues Added by Member</td>
                                    <td>Status</td>
                                    <td style="width: 18%;">Actions</td>
                                 </tr>

                                 @if(isset($arr_data) && sizeof($arr_data)>0)
                                 @foreach($arr_data as $key => $real_experience)
                                 <tr class="strips">
                                    <td>
                                       <div class="check-box-UserAlert">
                                          <input checked="checked" class="css-checkbox" id="radio1" name="radiog_dark" type="checkbox">
                                          <label class="css-label radGroup2" for="radio1">&nbsp;</label>
                                       </div>
                                    </td>
                                    <td>{{$key+1}}</td>
                                    <td>{{isset($real_experience['issue_title'])?$real_experience['issue_title']:'NA'}}</td>
                                    <td>Approved</td>
                                    <td class="icon-content">
                                       <div class="text-left">
                                          <a href="#" class="eye-i"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                          <a href="#" class="download"><i class="fa fa-download" aria-hidden="true"></i></a>
                                          <a href="#" class="edit-i"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                          <a href="#" class="delete-i"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                                 @endif
                                 
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-3">
               <div class="side-img">
                  <!--contact details box-->
                  <div class="contact-details pull-right">
                     <div class="inner-details">
                        <h4>Customer Support</h4>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/landline.png"></div>
                           <div class="contact-details2">
                              <h5>Landline:</h5>
                              <h6>040-646487</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/mobile.png"></div>
                           <div class="contact-details2">
                              <h5>Mobile no.:</h5>
                              <h6>9000000009</h6>
                           </div>
                        </div>
                        <div class="inner-details2">
                           <div class="contact-icon"><img src="{{url('/')}}/images/email.png"></div>
                           <div class="contact-details2">
                              <h5>Email:</h5>
                              <h6 class="email">support@interviewxp.com</h6>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--end-->
                  <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp"/> </div>
                  <div class="sample-img"> <img src="{{url('/')}}/images/sample-img.jpg" alt="Interviewxp"/> </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection

