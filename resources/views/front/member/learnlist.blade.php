@extends('front.layout.main')
@section('middle_content')

<div class="banner-change-pw">
   <div class="pattern-change-pw">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="heading-changepw">{{$module_title}}</div>
            </div>
         </div>
      </div>
   </div>
</div>

   
   <?php function mydate($date)
{

$date_Epl=explode('-',$date);
$datearrey=array('NONE','Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec');
$dateday=$date_Epl[1];
$dateday = ltrim($dateday, '0');
echo $date_Epl[2]." ".$datearrey[$dateday];

}

?>
   
   
   
   
   
   
     <div class="container" style="width:100%; background: #fafafa6b; min-height: 500px;">
      <!-- <div class="row">
         <div class="col-sm-12">
            <h2 class="experience">Recently Experience</h2>
            <img src="images/bag.png" alt="Interviewxp" class="center-block bag" />
         </div>
      </div> -->
      <div class="row top-strip-table" style="    padding-top: 10px;
    margin-top: 20px;
    height: 40px;
    text-align: center;
    /* font-weight: bold; */
    color: #555;
    font-size: 14px;
    /* padding: 7px 20px; */
    white-space: normal;
    letter-spacing: 0.4px;
    font-family: 'ubuntumedium',sans-serif;">
          <div class="col-lg-1" ><div style="float:left;">SN</div> <div style="float:right;">Date</div></div>
       
       <div class="col-lg-10">
            <div style="float:left;">Description</div> 
       
       </div>
       
         <div class="col-lg-1">
             <div style="float:right;">Action</div>
       
       </div>
        </div>
      
      <?php $sins=0; ?>
      @if(isset($arr_interview) && sizeof($arr_interview)>0)
         @foreach($arr_interview as $interview)
         <?php $sins++; ?>
         <div class="row" style="    padding-top: 5px;">
             
                   <div class="col-lg-1" style="padding-top: 59px;" ><div style="float:left;"><?=$sins;?></div> <div style="float:right;     color: #15a49d;"><?php $dates=explode(" ",$interview['created_at']); 
                   echo mydate($dates[0]);?> </div></div>
                   
      
       <div class="col-lg-10">
            <div class="box">
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-3" style="    padding-right: 0px;    margin-right: 0px;">
                     <div class="box-left">
                        <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                        <?php  $file_path = $member_interviewimages_path.$interview['image'];  ?>
                        @if(isset($interview_images_public_path) && ($interview['image']!="") && ($interview['image']!=null) && file_exists($file_path))
                        <img src="{{$interview_images_public_path.$interview['image']}}" alt="Interviewxp" class="img-responsive"  width ="200" height="100"/>
                        @else
                        <img src="{{url('/')}}/uploads/no-image.png" alt="Interviewxp" class="img-responsive" style="width: 100%;
    margin-left: 5px;"/>
                        @endif
                        </a>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-9 mar-left-px" style="    padding-left: 0px;    margin-left: 0px;">
                     <div class="row box-right">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
            						   <?php
            								$interview_skill_name = '';
            								if(isset($interview['skill_name']) && isset($interview['experience_level'])  && $interview['experience_level'] != 'NA')
            								{
            									$interview_skill_name = $interview['allskill'].' Real Time Interview Questions &amp; Answers ( '.$interview['experience_level'].' Year Exp )';
            								}
            								else if(($interview['skill_name']) && isset($interview['experience_level'])){									
            									$interview_skill_name = $interview['allskill'].' Interview Questions &amp; Answers';
            								}
            						   ?>
                           <h4>{{$interview_skill_name}}</h4>
                           </a>
                         </div>
                           <?php
                              $interviewDetails = DB::table('interview_detail as i')->join('company_master as c','c.company_id','=','i.company_id')->where('interview_id',$interview['id'])->where('approve_status',1)->select('c.company_name','i.company_location','i.approve_date')->get();             
                             
                             $topdollers=0;
                              ?>
                      
                           <?php
                            $obj_price_list = $PriceListModel->where('exp_level',$interview['experience_level'])->first();
                            $obj_user_info = $UserModel->where(['id'=>$interview['user_id']])->first();
                            ?>
                          



						              <div class="col-sm-11 col-md-11 col-lg-11" >
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
                                    
                                     <?php if(isset($interview['average_rating'][0]['review_star'])) { $interview_id=$interview['id'];  
                                  
                                     $allcoun5 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','5')->count(); 
   
   $allcoun4 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','4')->count(); 
   
   $allcoun3 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','3')->count();  
   
   $allcoun2 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','2')->count();   
   
   $allcoun1 = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->where('review_star','1')->count(); 
                                    
                                      $allcountr = DB::table('review_rating')->where('interview_id',$interview_id)->where('approve_status','user')->count();
                                   $allcountrstra=($allcountr);
                                    
                                     $totalrag=($allcoun5*5)+($allcoun4*4)+($allcoun3*3)+($allcoun2*2)+($allcoun1*1); $average_rating=($totalrag/$allcountrstra); }  else { $average_rating=0; } ?>
                                     
                                     
                                        <div class="starrr">
                            @for($ib=1;$ib<=$average_rating;$ib++)
                       <i class="fa fa-star" aria-hidden="true" style="font-size: 18px; color:#ffc000"></i>
                    @endfor     
                    
                    <?php $reviewvalu=explode('.',$average_rating); if(isset($reviewvalu[1]) && $reviewvalu!=0) { $average_ratingm=$average_rating+1; echo  '<i class="fa fa-star-half-o" aria-hidden="true" style="font-size: 18px; color:#ffc000"></i>'; }
                    else { $average_ratingm=$average_rating; }?>
                    
                    @for($i=$average_ratingm;$i<5;$i++)
                        <i class="fa fa-star-o" aria-hidden="true" style="font-size: 18px; color:#ffc000"></i>
                    @endfor
                        </div>
                        
                        
                        
                                  
                                    </div>
                                    
                                 </div>
                              </li>
                              <li class="hidden-xs"><i class="fa fa-user" aria-hidden="true"></i> {{isset($interview['user_purchase_details'])?count($interview['user_purchase_details']):''}} Learners</li>
                              <!-- <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i> 1000 Views</li> -->
                              <li class="hidden-xs"><i class="fa fa-eye" aria-hidden="true"></i>{{isset($interview['view_count'])?$interview['view_count']:''}} Views</li>
                              <li class="hidden-xs">Last updated {{isset($interview['publish_date'])?date('d M Y', strtotime($interview['publish_date'])):' '}}</li>
                           </ul>
            						   <ul>
            								@if($interview['admin_approval_qa']==1)
                            <li style="border-right:none;padding: 0 5px;">
                              <div class="check-box" style="margin-top: 8px;">
                                <input class="css-checkbox ads_Checkbox interviewqa-price" value="{{@$obj_price_list->ref_book_price}}" attrid="{{@$interview['id']}}" id="radio_interviewqa{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
                                <label class="css-label radGroup2" for="radio_interviewqa{{@$interview['id']}}" style="padding-left: 20px;"></label>
                                <span style="font-size: 12px;padding-top: 3px !important;float: right;">Interview Q&A</span>
                              </div>
                            </li>
                            @endif
            								<li style="border-right:none;padding: 0 5px;">
            									<div class="check-box" style="margin-top: 8px;">
            										<input class="css-checkbox ads_Checkbox interviewcoach-price" value="{{@$obj_price_list->validity}}" attrid="{{@$interview['id']}}" id="radio_textresume{{@$interview['id']}}" name="reference_book_textResume" type="checkbox" checked="checked">
            										<label class="css-label radGroup2" for="radio_textresume{{@$interview['id']}}" style="padding-left: 20px;"></label>
            										<span style="font-size: 12px;padding-top: 3px !important;float: right;">Interview Coaching & Resume Preparation</span>
            									</div>
            								</li>                            
            								@if(!empty($obj_user_info->company_qa_tab) && $interview['admin_approval_company']==1)
            								<li style="border-right:none;padding: 0 5px;">
            									<div class="check-box" style="margin-top: 8px;">
            										<input class="css-checkbox ads_Checkbox company-price" value="{{@$obj_price_list->interview_price}}" attrid="{{@$interview['id']}}" id="radio_companies{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
            										<label class="css-label radGroup2" for="radio_companies{{@$interview['id']}}" style="padding-left: 20px;"></label>
            										<span style="font-size: 12px;padding-top: 3px !important;float: right;">Interviews by Companies</span>
            									</div>
            								</li>
            								@endif
            								@if(!empty($obj_user_info->real_issues_qa_tab) && $interview['admin_approval_realissues']==1)
            								<li style="border-right:none;padding: 0 5px;">
            									<div class="check-box" style="margin-top: 8px;">
            										<input class="css-checkbox ads_Checkbox realtime-price" value="{{@$obj_price_list->price_for_25_ticket}}" attrid="{{@$interview['id']}}" id="radio_realtime{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
            										<label class="css-label radGroup2" for="radio_realtime{{@$interview['id']}}" style="padding-left: 20px;"></label>
            										<span style="font-size: 12px;padding-top: 3px !important;float: right;">Realtime work Experience</span>
            									</div>
            								</li>
            								@endif
            								@if(!empty($obj_user_info->training_tab) && !empty($arr_training_schedule))
            								<li style="border-right:none; padding: 0 5px;">
            									<div class="check-box" style="margin-top: 8px;">
            										<input class="css-checkbox ads_Checkbox training-price" value="{{@$obj_price_list->training_price}}" attrid="{{@$interview['id']}}" id="radio_training{{@$interview['id']}}" name="reference_book_textResume" type="checkbox">
            										<label class="css-label radGroup2" for="radio_training{{@$interview['id']}}" style="padding-left: 20px;"></label>
            										<span style="font-size: 12px;padding-top: 3px !important;float: right;">Online Training</span>
            									</div>
            								</li>
            								@endif
            						   </ul>
                        </div>
                        
                         <div class="col-sm-1 col-md-1 col-lg-1  rupies" style="padding: 0px;">
                             <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                             <h2 class="money-icon" style="margin: 0px;    padding: 0px;">Inr</h2>
                             <h2 class="total-amount{{@$interview['id']}}"  style="margin: 0px;    padding: 0px;">
                             {{@(int)$obj_price_list->validity}}
                             </h2>
                             </a>
                            </div>
                           
                         @if(empty($interviewDetails))  
                         <?php
                        $obj_price_list = $PriceListModel->where('exp_level',$interview['experience_level'])->first();
                        $obj_user_info = $UserModel->where(['id'=>$interview['user_id']])->first();
                        ?>
                       <div class="col-sm-1 col-md-1 col-lg-1  rupies" style="padding: 0px; display:none">
                         <a href="{{url('/')}}/interview_details/{{base64_encode($interview['id'])}}">
                         <h2 class="money-icon">Inr</h2>
                         <h2 class="total-amount{{@$interview['id']}}">
                         {{@(int)$obj_price_list->validity}}
                         </h2>
                         </a>
                        </div>
                        @endif
                       
                        
                              @if(count($interviewDetails) > 0)  
                            
                          
                           <div class="col-sm-12">
                             <div class="left">
                                <img src="{{url('/'.'images/left-arrow-button.png')}}"  class="left-button" rel="{{$interview['id']}}">
                              </div>
                             <div class="center" id="content{{$interview['id']}}">                            
                              @foreach($interviewDetails as $company)
                              <div class=internal>
                                <p style="font-size: 12px; " title="{{$company->company_name}} ({{$company->company_location}})"> {{$company->company_name}} ({{$company->company_location}})</p>
                                <p style="    font-size: 10px;">{{date('M d, Y',strtotime($company->approve_date))}}</p>
                              </div>
                            
                              @endforeach                              
                               
                             </div>
                            <div class="right">
                              <img src="{{url('/'.'images/right-arrow-button.png')}}"  class="right-button" rel="{{$interview['id']}}">
                              </button>
                            </div>
                           </div>
 @endif 
 
 
                     </div>
                  </div>
               </div>
            </div>
            
            
            
            
            </div>
            
            <div class="col-lg-1">
             <div style="float: right;
    font-size: 24px;
    color: #fc575c;
    padding-top: 53px;
    cursor: pointer;"><a href="{{url('/').'/member/deletelearnlist/'.base64_encode($interview['ids']) }}" onclick="return confirm_delete();">
        <i class="fa fa-trash" aria-hidden="true" style="color: #fc575c;"></i></a></div>
       
       </div>
             
</div>
         @endforeach
            
      @else
         <div class="box">
            <div class="row">
                 <div class="col-sm-12 col-md-12 col-lg-12">
                     <div  style="text-align: center; color: red; font-size: 16px;">No Learn List added Yet!</div>
                  </div>
            </div>      
         </div>
      @endif

     
     
     
     
     
    
     
    
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
   </div>
</div>
</section>
</div>

<script>
	$(document).on('click load', '.interviewcoach-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	
	$(document).on('click', '.interviewqa-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	$(document).on('click', '.training-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	$(document).on('click', '.company-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
	$(document).on('click', '.realtime-price', function(e){

			var interviewqaAmount = $(this).val();
			var attrid = $(this).attr('attrid');
			var CurrTotal = $.trim($('.total-amount'+attrid).html());
			
			if ($(this).is(':checked'))
			{
			  var total = parseInt(CurrTotal) + parseInt(interviewqaAmount);
			}
			else{
			  var total = parseInt(CurrTotal) - parseInt(interviewqaAmount);	
			}
			
			$('.total-amount'+attrid).html(total)
	});
</script>
<script type="text/javascript">
  $('.right-button').click(function() {
    var id = $(this).attr('rel'); 
    event.preventDefault();
    $('#content'+id).animate({
      scrollLeft: "+=300px"
    }, "slow");
 });
 
   $('.left-button').click(function() {    
    var id = $(this).attr('rel'); 
    event.preventDefault();
    $('#content'+id).animate({
      scrollLeft: "-=300px"
    }, "slow");
 });
</script>
<style type="text/css">
 /* Put your css in here */

  .left{
   float: left; 
   width: 3%; margin-left: -26px;
  }

.box-right h4 {
    
       color: #17b0a4;
    font-family: 'ubunturegular',sans-serif;
    font-size: 18px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: 10px;
    margin-bottom: 5px; 
}
  .internal{
   width: 31.75%;
   height: 85%;     padding-top: 0px;
   /*border: 1px solid #eee;*/
  /*box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.03); */
      border-right: 1px solid #13bab214;
   display: inline-block;
  }

  .center{
   float: left; 
   width: 95%;
  /* height: 60px;*/
   margin: 1px;
   overflow: hidden;
   /*will change this to hidden later to deny scolling to user*/
   white-space: nowrap;     margin-left: -2px;
  }

  .right{
   float: right; 
   width: 3%;     margin-right: 12px;
  }
  .right img, .left img {
    width: 100%;
    margin-top: 8px;
  }
  .box-right .center p {
      margin: 0px 4px;
    height: 16px;
    font-size: 12px;
  }

.money-icon, .rupies h2 {font-size: 20px; }

.cd-top {
    background: #13bab2 url(images/up-arrow.png) no-repeat scroll center 50%; } 
.box-right p {    color: #888; }

</style>

</div>

<script>  function confirm_delete()
    { 
       if(confirm('Are you sure to delete this record?'))
       {
         return true;
       }
       return false;
    }
    </script>

@endsection

