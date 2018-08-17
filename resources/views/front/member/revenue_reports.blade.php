@extends('front.layout.main')
@section('middle_content')      
      <div class="banner-member">
         <div class="pattern-member">
         </div>
      </div>
      <div class="container-fluid fix-left-bar max-height">
         <div class="row">
            @include('front.member.member_sidebar')
            <div class="col-sm-8 col-md-9 col-lg-10 middle-content">
               <h2 class="my-profile pages">{{$module_title}}</h2>
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <div class="middle part green-table">
                        <div class="outer-box revenue">
                           <div class="icon-wrapper"> 
                              <a style="visibility:hidden" href="#" class="delete-i-top"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              <!--<a href="{{url('/member/revenue_reports')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>-->
                           </div>
                           <div class="table-search-pati section1-tab">
                              <div class="table-responsive">
                                 <table class="table">
                                    <tbody>
                                       <tr class="top-strip-table">
                                          <!--<td class="checkbox-td">
                                             <div style="visibility:hidden" class="check-box-UserAlert">
                                                <input class="css-checkbox" id="radio0" name="radiog_dark" type="checkbox">
                                                <label class="css-label radGroup2" for="radio0">&nbsp;</label>
                                             </div>
                                          </td>-->
                                          <td>S.No.</td>
                                          <td>Description</td>
                                          <td>Exp.Level</td>
                                          <td>Sold date</td>
                                          <td>Earnings</td>
                                          <td>Tax(10%)</td>
                                          <td>After Tax</td>
                                          <td>Status</td>
                                          <td>Payment Mode</td>
                                         
                                          <td>Actions</td>
                                          <td>Admin Comment</td>
                                       </tr>
                                       @if(isset($arr_transaction['data']) && sizeof($arr_transaction['data'])>0)
                                       <?php $i = 1; ?>
                                       @foreach($arr_transaction['data'] as $data)
                                       <tr class="">
                                          <!--<td class="checkbox-td">
                                             <div style="visibility:hidden" class="check-box-UserAlert">
                                                <input class="css-checkbox" id="radio1" name="radiog_dark" type="checkbox">
                                                <label class="css-label radGroup2" for="radio1">&nbsp;</label>
                                             </div>
                                          </td>-->
                                          <td>{{$i++}}</td>
                                          <td style="min-width: 200px;">{{$data['skill_name'] or 'NA'}}</td>
                                          <td class="inlin-date">{{$data['experience_level'] or 'NA'}} Years</td>
                                          <td class="inlin-date">{{date('d M Y', strtotime($data['created_at']))}}</td>
                                          <td>Rs.{{$data['member_amount']  or 'NA'}}</td>
                                          <td>Rs.{{$data['member_tax_amount'] or 'NA'}}</td>
                                          <td>Rs.{{$data['after_tax_amount'] or 'NA'}}</td>
                                          <td>
                                             @if($data['member_payment_status']=="Dont Pay" || $data['member_payment_status']=="Pay")
                                                Pending
                                             @elseif($data['member_payment_status']=="Paid")
                                                Paid   
                                             @endif
                                          </td>
                                          <td>
                                           @if($data['member_payment_status']=="Dont Pay" || $data['member_payment_status']=="Pay")
                                                ----
                                             @elseif($data['member_payment_status']=="Paid")
                                                By Online   
                                             @endif


                                          </td>

                                         
                                          <td>
                                             <div class="icons-r">
                                                <a href="{{url('/')}}/member/view_revenue_report/{{ base64_encode($data['id']) }}" class="eye-i"><i class="fa fa-eye" aria-hidden="true"></i></a>        

                                             </div>
                                          </td>
                                          <td style="width: 200px;">@if($data['member_comment']!=""){{$data['member_comment']}}@else NA @endif</td>
                                       </tr>
                                       @endforeach
                                     @else
                                          <tr><td colspan="10"><div style="color:red;text-align:center;">No Records found... </div></td></tr>
                                    @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <!-- pagination -->
                              <div class="prod-pagination">
                                   {{$arr_pagination->render()}}
                              </div>
                           <!-- end -->              
                        </div>
                          @if(isset($arr_advertise) && sizeof($arr_advertise)>0) 
                         @if($arr_advertise[1]['is_active']==1)
                        @if($arr_advertise[1]['id']==4)
                          <div class="sample-img2"> <img src="{{$advertise_public_img_path.$arr_advertise[1]['advertise_image']}}" alt="Interviewxp" class="img-responsive" /> </div>
                       @endif
                     @else
                     <div class="sample-img2"> <img src="{{url('/')}}/images/sample-img3.jpg" alt="Interviewxp" class="img-responsive" /> </div>
                     @endif
                     @else
                     <div class="sample-img2"> <img src="{{url('/')}}/images/sample-img3.jpg" alt="Interviewxp" class="img-responsive" /> </div>
                     @endif

                       <!--  <div class="sample-img2">
                        <img src="{{url('/')}}/images/sample-img3.jpg" class="img-responsive" alt="Interviewxp"/>
                        </div> -->

                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
      </div>
@endsection       

