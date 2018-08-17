@extends('front.layout.main')
@section('middle_content')     
<style>
.revenue .table-search-pati.section1-tab tr td {
    padding: 8px 9px;
    text-align: left;
}
.table-search-pati table tr td {    font-size: 14px;}
</style>
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
                           <div class="icon-wrapper" style="display:none"> 
                              <a style="visibility:hidden" href="#" class="delete-i-top"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              <!--<a href="{{url('/member/revenue_reports')}}" class="refresh-i"><i class="fa fa-refresh" aria-hidden="true"></i></a>-->
                           </div>
                           <div class="table-search-pati section1-tab history-page">
                              <div class="table-responsive" style="border:0">

                                <input type="hidden" name="multi_action" value="" />

                                      <table class="datatable table table-striped table-bordered table table-advance" >
                                  <thead>
                                    <tr class="t-head">
                                        
                                         <td>S.No <i class="fa fa-fw fa-sort"></i></td>
                                     <!--  <th>Transaction Id</th> -->
                                         <td>Month & Year <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Learners <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Sales <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Refunds <i class="fa fa-fw fa-sort"></i></td>
                                         <td>My Earnings <i class="fa fa-fw fa-sort"></i></td>
                                         <td>TDS <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Payout After TDS <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Expected Payout Date <i class="fa fa-fw fa-sort"></i></td>
										 <td>Ratings <i class="fa fa-fw fa-sort"></i></td>
										 <td>Reviews <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Payment Status <i class="fa fa-fw fa-sort"></i></td>
                                         <td>Payment Reference No <i class="fa fa-fw fa-sort"></i></td>
                                         
                                    </tr>
                                  </thead>
                                   <tbody>
                                    @if(isset($entries) && sizeof($entries)>0)
                                      <?php $i=0; $sinos=0; ?>
                                      @foreach($entries  as $key => $data)
                                      <?php $i=$i+1; $sinos=$sinos+1;  if($i%2==0) { $classg="asgreen";} else {  $classg="aswhite"; } ?>
                                      <tr class="{{$classg}}">
                                       
                                         <td> 
                                             {{$sinos}}
                                         </td>
                                         <!-- <td > IE0000{{ $data['id'] or 'NA' }} </td> -->

                                         <td> <a href="{{url('/member/revenue/'.base64_encode($data[0]).'/'.base64_encode($data[1]))}}" title="{{$data[2]}}">{{ date('F, Y',strtotime($data[0]))}} </a></td>
										 <td>{{$data['learners']}}</td>
										 <td>{{number_format($data['sales'],2)}}</td>
										 <td>{{number_format($data['refunds'],2)}}</td>
                                         <td> 
                                             {{number_format($data['member_amount'],2)}}
                                         </td>
                                         <td> 
                                             {{number_format($data['member_tax_amount'],2)}}
                                         </td>
                                         <td> 
                                             {{number_format($data['after_tax_amount'],2)}}
                                         </td>
                                        <td> 
                                             {{$data['payout_date']}}
                                         </td>
										  <td style="width: 150px;float:left"><?php 
										 $emptyStars = url('/')."/images/blank_star.png";           
                                         $stars = url('/')."/images/star.png";
										 if(isset($data['ratings'])) { 
										 $reviewvalu=explode('.',$data['ratings']);
										 $half_rating = true;
										 for($i=1; $i<=5; $i++) {										 
										 if($i <= round($data['ratings'])) { echo ' <i class="fa fa-star" aria-hidden="true" style="font-size: 16px; color:#ffc000"></i>'; } elseif(isset($reviewvalu[1]) && $reviewvalu!=0 && $half_rating == true) { echo ' <i class="fa fa-star-half-o" aria-hidden="true" style="font-size: 16px; color:#ffc000"></i>'; $half_rating =false; } else { echo ' <i class="fa fa-star-o" aria-hidden="true" style="font-size: 16px; color:#ffc000"></i>'; } }  } else { for($i=1; $i<=5; $i++) { echo ''; } } ?>&nbsp;({{number_format($data['ratings'],1)}})</td>
										 <td>{{$data['reviews']}}</td>
										<td> 
                                            @if($data['member_payment_status']=="Dont Pay" || $data['member_payment_status']=="Pay")
                                                Pending
                                             @elseif($data['member_payment_status']=="Paid")
                                                Paid   
                                             @endif
                                         </td>
										 <td><a href="{{url('/uploads/member_payments/').'/'.$data['member_payment_ref_image']}}" download>{{$data['member_payment_ref_id']}}</a></td>
                                         
                                         
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
                 
               </div>
            </div>
         </div>
      </div>
      </div>
      
      	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
	<script src="http://cloudforcehub.com/interviewxp/js/datatables.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable').dataTable({
				"sPaginationType": "bs_full"
			});	
			$('.datatable').each(function(){
				var datatable = $(this);
				// SEARCH - Add the placeholder for Search and Turn this into in-line form control
				var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
				search_input.attr('placeholder', 'Search');
				search_input.addClass('form-control input-sm');
				// LENGTH - Inline-Form control
				var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
				length_sel.addClass('form-control input-sm');
			});
		});
		</script>
@endsection       

