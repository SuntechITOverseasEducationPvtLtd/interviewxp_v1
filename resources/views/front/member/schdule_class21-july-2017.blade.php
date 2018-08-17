@extends('front.layout.main')
@section('middle_content')
<div id="member-header" class="after-login"></div>
	<div class="banner-member">
	   <div class="pattern-member">
	   </div>
	</div>
	 
	<div class="container-fluid fix-left-bar">
      <div class="row">
        @include('front.member.member_sidebar')
         <div class="col-sm-8 col-md-9 col-lg-10">

            <h2 class="schedule">Schedule Class</h2>                    
                <div class="alert_message"></div>
                <div class="outer-box history-page">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                           <tr class="t-head">
                              <td>S.No</td>
                              <td>Title</td>
                              <td>Experience Level</td>
                           </tr>
                        </thead>
                        @if(isset($arrMemberDetails) && sizeof($arrMemberDetails)>0)
                        @foreach($arrMemberDetails as $key => $value)
                        <thead class="box  hideRow hideRow{{$key+1}}">
                            <?php
                              $skill_id = $value['skill_id'];
                            ?>
                            <tr class="top hideAll" id="{{$key+1}}">
                              <td>{{$key+1}}</td>
                              <td>
                                 {{isset($value['skill_name'])?$value['skill_name']:'NA'}} Real Time Interview Questions &amp; Answers   
                              </td>
                              <td>{{isset($value['experience_level'])?$value['experience_level']:'NA'}}</td>
                              <td><img src="{{url('/')}}/images/plus_faq.png" /></td>
                           </tr>
                           <tr class="bottom" style="display:none;">
                               <td colspan="4">
                                  <div class="sub-tab">
                                    <div class="ref-book" style="width: 100%;">
                                     <h4>
                                      <span class="addSchedule" style="background-color: #17b0a4;color:#fff;border: 1px solid #17b0a4;padding:5px;" rel="{{ isset($skill_id)?$skill_id:'' }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i><span style="color:#fff">Add Schedule</span>
                                       </span>                        
                                     </h4>
                                    </div>
                                    <div id="schedule_form_{{ isset($skill_id)?$skill_id:'' }}" class="schedule_form" style="display: none">@include('front.member.create_schedule',['skill_id'=> isset($skill_id)?$skill_id:'', 'key'=>$value['id']])</div>          
                                   </div>
                                  
                               </td>
                           </tr>
                        </thead>
                         @endforeach
                         @else
                         <tr class="strips">
                         <td style="color:red;">
                         No Records found...
                         </td>
                         </tr>
                         @endif    
  
                    </table>
                </div>
            </div>
             </div>
        </div>
       
          
    </div>
    </div>
 </div>    
 <?php /* <div id="schedule_form" style="display: block;">
  @include('front.member.create_schedule')
</div>  */ ?> 
 <script type="text/javascript">
   
      $('.top').on('click', function() {
     
         $parent_box = $(this).closest('.box');
         //$parent_box.find('.bottom').slideUp();
         //  $(".details-info").hide();
         $parent_box.find('.bottom').slideToggle(1000, 'swing');
         //$parent_box.find('.bottom').fadeIn(1000, 'swing');
         // $(".details-info").show();
     });
    
   $(".hideAll").on("click", function(){
    var id=$(this).attr("id");
    $(".hideRow").hide();
    $(".hideRow"+id).show();
  });

$(document).on('click', '.addSchedule', function() {
  var rel = $(this).attr('rel');
  //$('.schedule_form').html('');
  //$('#schedule_form_'+rel).append($('#schedule_form').html());
  //$('#schedule_form_'+rel).show();
  $('.schedule_form').show();
    
  $('#date').val('');
  $('#start_time').val('');
  $('#end_time').val('');
  $('#skills').val(rel);
  $('.error').html('');
                        
});

$('.edit_schedule').on('click', function(event) {
   var url = $(this).attr('url');
   var rel = $(this).attr('rel');
   $('.error').html('');
   //$('.schedule_form').html('');
   //$('#schedule_form_'+rel).append($('#schedule_form').html());
   //$('#schedule_form_'+rel).show();
   $('.schedule_form').show();
    $.ajax({
          url: url,
          type: 'GET',
          dataType: "JSON",
          processData: false,
          contentType: false,
          async: false,
          success: function (data) {             
                
              if(data.status == true)
              {
                  $('#id').val(data.id);
                  $('#date_'+data.id).val(data.date);
                  $('#start_time_'+data.id).val(data.start_time);
                  $('#end_time_'+data.id).val(data.end_time);
                  var action = "{{url('/')}}/member/update_schedule";
                  $('#frm_schedule').attr('action', action);
              }
              $(window).scrollTop(0);      
          }        
                
         
      });
      event.preventDefault();
});

$(document).on('click','#closeSchedule', function(event) {
  $('.schedule_form').hide();
  event.preventDefault();
});

$(document).on('submit', 'form', function (event) {
      $form = $(this);
      var data = new FormData(this);
      $('.error').html('');

      $.ajax({
          url: $form.attr('action'),
          type: $form.attr('method'),
          dataType: "JSON",
          data: data,
          processData: false,
          contentType: false,
          async: false,
          success: function (data) {               
             
              if(data.error){
                $('.alert_message').html('<div class="alert alert-danger col-ssm-12" >' + data.message + '<button type="button" class="close" style="margin-top: 0px !important;padding: 0px !important;" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
                $('.err_date').html('<div class="col-sm-12" >' + data.error.date + '</div>');
                $('.err_start_time').html('<div class="col-sm-12">' + data.error.start_time + '</div>');
                $('.err_end_time').html('<div class="col-sm-12">' + data.error.end_time + '</div>');
                             // location.reload('/');
                }
              else{
                $('.alert_message').html('<div class="alert alert-success col-ssm-12" >' + data.message + '<button type="button" class="close" style="margin-top: 0px !important;padding: 0px !important;" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
                  if(data.status == true)
                  {
                      $('.schedule_form').hide();
                  }
                
                }

                return true;
          },
          error: function () {

          }
      });
      event.preventDefault();
}); 

</script>
@endsection