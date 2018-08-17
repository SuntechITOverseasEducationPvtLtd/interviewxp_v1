@extends('front.layout.main')
@section('middle_content')
      <div id="after-login-header" class="after-login"></div>
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="middle-section min-height">
                  <div class="user-dashbord">
                     <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="middle part">
                              <div class="row">
                                 <div class="col-xs-8">
                                    <h2 class="my-profile">{{$module_title}}</h2>
                                 </div>
                                 <div class="col-xs-4">
                                    <div class="icon-w"> 
                                       <a href="{{url('/member/revenue_reports')}}" class="green-back">Back</i></a>
                                    </div>
                                 </div>
                              </div>
                              <div class="outer-box r-details">
                                  
                                    <div class="row">
                                       <div class="col-sm-6">
                                            <h5>{{ucfirst($arr_transaction['skill_name'])}} Real Time Interview Questions & Answers ( {{$arr_transaction['experience_level']}} Year Exp )</h5>
                                          <div class="form-group">
                                             <label class="h-text">Experience Level :</label>
                                             <label>{{$arr_transaction['experience_level'] or 'NA'}} Years</label>
                                          </div>
                                          <div class="form-group">
                                             <label class="h-text">Sold date  : </label>
                                             <label>{{date('d M Y', strtotime($arr_transaction['created_at']))}}</label>
                                          </div>
                                          <div class="form-group">
                                              <label class="h-text">Earnings  : </label>
                                             <label>Rs.{{$arr_transaction['member_amount']  or 'NA'}}</label>
                                          </div>
                                          <div class="form-group">
                                              <label class="h-text">Tax(10%)  : </label>
                                             <label>Rs.{{$member_tax_amount or 'NA'}}</label>
                                          </div>
                                            
                                          <div class="form-group">
                                              <label class="h-text">Amount After Tax  : </label>
                                             <label>Rs.{{$after_tax_amount or 'NA'}}</label>
                                          </div>
                                          <div class="form-group">
                                              <label class="h-text">Status : </label>
                                             <label> 
                                             @if($arr_transaction['member_payment_status']=="Dont Pay" || $arr_transaction['member_payment_status']=="Pay")
                                                Pending
                                             @elseif($arr_transaction['member_payment_status']=="Paid")
                                                Paid   
                                             @endif</label>
                                          </div>
                                           <div class="form-group">
                                              <label class="h-text">Payment Mode  : </label>
                                             <label>By Online</label>
                                          </div>
                                            <div class="form-group">
                                              <label class="h-text">Description  : </label>
                                             <label>
                                            
                                              @if(isset($arr_transaction['purchase_history'][0]['reference_book'])=='Yes')

                                               <p>{{$multi_ref_book." ".ucfirst($arr_transaction['skill_name'])}} Interview Book</p>
                                              @endif

                                              @if($interview_count_arr!=0)
                                              <p>{{$interview_count_arr}} Company's Q & A</p>
                                              @endif
                                              
                                              @if($arr_transaction['purchase_history'][0]['ticket_name']!='')
                                                <p>{{$arr_transaction['purchase_history'][0]['ticket_name']}} Rwe Tickets</p>
                                              @endif

                                             </label>
                                          </div>
                                          
                                       </div>
                                    </div>
                                         
                              </div>
                              <!-- <div class="sample-img2"><img src="images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/></div> -->
                           </div>
                        </div>
                      
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>

    <script type="text/javascript">
         $('.main-content > .arrow').click(function(){
           $(this).parent().next('.sub-content').slideToggle();
           $(this).find('.arrow i').toggleClass('fa-chevron-down fa-chevron-up')
         });
      </script>           
      <!--footer section-->
@endsection
