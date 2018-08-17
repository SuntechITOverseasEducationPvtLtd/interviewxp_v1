@extends('front.layout.main') 
@section('middle_content')
<div id="after-login-header" class="after-login"></div>
<div class="banner-change-pw">
   <div class="pattern-change-pw">
   </div>
</div>
<!-- middle section -->
<div class="middle-area min-height">
   <div class="container">
      <div class="row">
         <form name="frm_pro_payment" id="frm_pro_payment" method="POST" action="{{url('/')}}/payment/pay_now">
         {{ csrf_field() }}
         <div class="col-sm-7 col-md-8 col-lg-9">
            <div class="purchase">
               <div class="row">
               @include('front.layout._operation_status')
                  <div class="col-xs-12 col-sm-4">
                     <h4>Order Summary</h4>
                  </div>
                  <div class="col-xs-12 col-sm-8">
                     <div class="btn-section">
                        <a href="{{url('/')}}/interview_details/{{base64_encode($interview_id)}}">
                           <h4><i class="fa fa-arrow-left" aria-hidden="true"> Back</i></h4>
                        </a>
                        <a href="{{ URL::previous() }}" class="submit-btn ctn">Modify Order</a>
                     </div>
                  </div>
               </div>
            </div>
			<?php
				$interview_skill_name = '';
				if(isset($skill_name) && isset($experience_level)  && $experience_level != 'NA')
				{
					$interview_skill_name = $skill_name.' Real Time Interview Questions &amp; Answers ( '.$experience_level.' Year Exp )';
				}
				else if(($skill_name) && isset($experience_level)){									
					$interview_skill_name = $skill_name.' Interview Questions &amp; Answers';
				}
		   ?>
            <h4 class="order">{{$interview_skill_name}}</h4>
			
            <div class="table-search-pati section1-tab order-table" style="margin-left:3%">
               <div class="table-responsive">
                  <table class="table">
                     <tbody>
						@if(isset($validityResume) && $validityResume!=0)
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* Interview Coach</p></span>
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($validityResume,2)}}
                           </td>
                        </tr>
                        @endif
                        @if(isset($reference_book_bought) && $reference_book_bought!=0)
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* Interview Q & A</p></span>
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($reference_book_bought,2)}}
                           </td>
                        </tr>
                        @endif
                        @if(isset($reference_training_bought) && $reference_training_bought!=0)
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* Online Class</p></span>
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($reference_training_bought,2)}}
                           </td>
                        </tr>
                        @endif
						
						      @if(isset($coach_reference_book) && $combo_coach_interview_qa_price!=0)
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* COMBO 
                                 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inerview Coaching
                                 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Interview Q & A </p></span>
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($combo_coach_interview_qa_price,2)}}
                           </td>
                        </tr>
                        @endif
						      @if(isset($coach_company) && $combo_coach_company_price!=0)
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* COMBO
                                 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inerview Coaching
                              @foreach($company_ids as $companyList)
                              <?php
                                 $NameCompany = DB::table('company_master')->where('company_id', '=', $companyList)->first();
                                 $CompanyLocation = DB::table('interview_detail')->where('company_id', '=', $companyList)->first();
                                 $NameC=$NameCompany->company_name;
                                 $Location=$CompanyLocation->company_location;
                              ?>
                                 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$NameC}} ({{$Location}})
                              @endforeach 
                              </p>
                              </span>
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($combo_coach_company_price,2)}}
                           </td>
                        </tr>
						  @elseif($selected_companies_price != '')
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* {{$company_count}} Companies
                                 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inerview Coaching
                              @foreach($company_ids as $companyList)
                              <?php
                                 $NameCompany = DB::table('company_master')->where('company_id', '=', $companyList)->first();
                                 $CompanyLocation = DB::table('interview_detail')->where('company_id', '=', $companyList)->first();
                                 $NameC=$NameCompany->company_name;
                                 $Location=$CompanyLocation->company_location;
                              ?>
                                 <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$NameC}} ({{$Location}})
                              @endforeach 
                              </p>
                              </span>
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($interview_amount,2)}}
                           </td>
                        </tr>
                        @elseif($company_count!=0)
      						@foreach($company_ids as $companyList)
         					<?php
         					$NameCompany = DB::table('company_master')->where('company_id', '=', $companyList)->first();
         					$CompanyLocation = DB::table('interview_detail')->where('company_id', '=', $companyList)->first();
         					$price_list = DB::table('price_list')->where('exp_level', '=', $experience_level)->first();
         					$NameC=$NameCompany->company_name;
         					$Location=$CompanyLocation->company_location;
         					$price=$price_list->interview_price;
         					?>
                                 <tr class="">
                                    <td><span style="width: 65%;float: right;">
                                    <p style="text-align: left;"> *  {{$NameC}} ({{$Location}})</p></span></td>
                                    <td class="delet">&nbsp;</td>
                                    <td>Rs {{ number_format($price,2)}}</td>
                                 </tr>
      						@endforeach
                        @endif
                        @if(isset($coach_realissues) && $combo_coach_realissues_price!=0)
                        <tr class="">
                           <td>
                              <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* COMBO 
                              <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inerview Coaching
                              <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Work Experience(50)</p></span> 
                           </td>
                           <td class="delet">&nbsp;</td>
                           <td>
                              Rs {{ number_format($combo_coach_realissues_price,2)}}
                           </td>
                        </tr>
                        @elseif(isset($arr_ticket_name) && sizeof($arr_ticket_name)>0)
                        @foreach($arr_ticket_name as $ticket)
                        <tr>
                           <td class=""> <span style="width: 65%;float: right;">
                              <p style="text-align: left;">* Real Time issues - {{isset($ticket['ticket_name'])?$ticket['ticket_name']:''}}</p></span></td>
                           <td class="delet">&nbsp;</td>
                           <td class="">Rs {{isset($ticket['ticket_price'])? number_format($ticket['ticket_price'],2):''}}</td>
                        </tr>
                        @endforeach
                        @endif
                        <tr class="strips2">
                           <td class="bold " colspan="2">Sub Total</td>
                           <td style="width: 140px;">Rs {{isset($sub_total)? number_format($sub_total,2):''}}</td>
                        </tr>
                        @if(!empty($is_enable_gst) && $user_state == $company_state)
                        <tr>
                           <td class="bold" colspan="2">CGST ({{$cgst}}%)</td>
                           <td  style="width: 140px;">Rs {{isset($tax_amount_cgst)? number_format($tax_amount_cgst,2):''}}</td>
                        </tr>
                        <tr>
                           <td class="bold" colspan="2">SGST ({{$sgst}}%)</td>
                           <td  style="width: 140px;">Rs {{isset($tax_amount_sgst)? number_format($tax_amount_sgst,2):''}}</td>
                        </tr>
                        @elseif(!empty($is_enable_gst))
                        <tr>
                           <td class="bold" colspan="2">IGST ({{$igst}}%)</td>
                           <td  style="width: 140px;">Rs {{isset($tax_amount_igst)? number_format($tax_amount_igst,2):''}}</td>
                        </tr>                        
                        @endif
                        <tr class="strips2">
                           <td class="bold" colspan="2">Total Price</td>
                           <td class="total" style="width: 140px;">Rs {{isset($grand_total)? number_format($grand_total,2):''}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <input type="hidden" name="enc_data" value="{{$encrypt_data}}">

            <div class="btn-wrapper"> <button type="submit" class="submit-btn ctn" id="btn_pro_payment">Proceed to Pay</button>  </div>
         </div>
         </form>
         <div class="col-sm-5 col-md-4 col-lg-3">
            <!--contact details box-->
            <div class="contact-details pull-right m-bottom">
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
            <div class="clr"></div>
            <div class="text-OrderSummery">
               <p>Prepare for your dream Job. Enhance your skills with best interview Q &amp; A</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end -->
@endsection

