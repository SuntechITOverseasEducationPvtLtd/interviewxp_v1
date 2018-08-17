<style>
    .scurriculam_01{margin-top: 0px !important;padding: 0px !important;}
.scurriculam_02{display:none !important;}
.scurriculam_03{width: 100% !important;}
.scurriculam_04{background-color: #17b0a4 !important; color:#fff !important; border: 1px solid #17b0a4!important; padding:5px !important;}
.scurriculam_05{color:#fff !important;}
.scurriculam_06{color: #333 !important;}
.scurriculam_07{color:red !important;}
.scurriculam_08{margin-top: 0px !important;padding: 0px !important;}
</style>

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
         <div class="col-sm-8 col-md-9 col-lg-10 middle-content">

            <h2 class="curriculam">Curriculam</h2>                    
                <div class="alert_message">
                  @if (Session::has('success'))
                      <div class="alert alert-success">
                          <button type="button" class="close scurriculam_01" data-dismiss="alert" aria-hidden="true">&times;</button>

                          {{ Session::get('success') }}
                      </div>
                  @endif
                </div>
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
                            <tr class="top hideAll" id="{{$key+1}}">
                              <?php
                                $skill_id = $value['skill_id'];
                              ?>
                              <td>{{$key+1}}</td>
                              <td>
                                 {{isset($value['skill_name'])?$value['skill_name']:'NA'}} Real Time Interview Questions &amp; Answers   
                              </td>
                              <td>{{isset($value['experience_level'])?$value['experience_level']:'NA'}}</td>
                              <td><img src="{{url('/')}}/images/plus_faq.png" /></td>
                           </tr>
                           <tr class="bottom scurriculam_02" >
                               <td colspan="4">
                                <div class="middle-box"> 
                                  <div class="sub-tab">
                                    <div class="ref-book scurriculam_03">
                                     <h4>
                                      <span class="addCurriculam scurriculam_04" rel="{{ isset($skill_id)?$skill_id:'' }}">
                                        <i class="fa fa-plus" aria-hidden="true"></i><span class="scurriculam_05">Add Curriculam</span>
                                       </span>                        
                                     </h4>
                                    </div>
                                    <div id="curriculam_form_{{ isset($skill_id)?$skill_id:'' }}" class="curriculam_form"></div>          
                                   </div>
                                  <div class="table-responsive">
                                      <?php
                                        $curriculams = DB::select( DB::raw("SELECT * FROM training_curriculam WHERE skill_id = '".$value['skill_id']."' AND member_id = '".$value['member_id']."'") );
                                       
                                        ?>  
                                     <table class="table table-bordered table-items">  @if(isset($curriculams) && sizeof($curriculams)>0)    
                                       <thead>
                                           <tr class="t-head">
                                              <th>Title</th>
                                              <th></th>
                                           </tr>
                                        </thead>  
                                       @endif  

                                         <tbody>
                                                                              
                                          @if(isset($curriculams) && sizeof($curriculams)>0)
                                          @foreach($curriculams as $key => $value)       
                                           <tr>
                                              <td id="title_{{ $value->id }}">{{isset($value->title)?$value->title:'NA'}}</td>
                                              <td align="right">
                                              <a href="{{url('/')}}/member/delete_curriculam/{{ base64_encode($value->id) }}" onclick="return confirm('Are you sure want to delete the curriculam?')"><i class="fa fa-minus-circle scurriculam_06" aria-hidden="true" title="Delete Curriculam"></i></a>
                                              
                                              <i class="fa fa-eye curriculam-view" aria-hidden="true" data-toggle="modal" data-target="#CurriculamModal" rel="{{base64_encode($value->id)}}"></i> 
                                              <span class="edit_curriculam" url="{{url('/')}}/member/get_curriculam/{{ base64_encode($value->id) }}" rel="{{ isset($skill_id)?$skill_id:'' }}"><i class="fa fa-pencil" aria-hidden="true"></i></span></td>
                                           </tr>
                                           @endforeach
                                           @else
                                           <tr class="strips">
                                           <td class="scurriculam_07"  colspan="2">
                                           No Records found...
                                           </td>
                                           </tr>
                                           @endif
                                        </tbody>                                   
                                     </table>
                                      <!--end-->
                                  </div>
                                </div>
                               </td>
                           </tr>
                        </thead>
                         @endforeach
                         @else
                         <tr class="strips">
                         <td class="scurriculam_07">
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
 <div class="modal fade" id="CurriculamModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Title</h4>
      </div>
      <div class="modal-body">
        Description
      </div>      
    </div>
  </div>
</div> 
<div id="curriculam_form " class="scurriculam_02">
  @include('front.member.create_curriculam')
</div>  
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

$('.addCurriculam').on('click', function() {
  var rel = $(this).attr('rel');
  $('.curriculam_form').html('');
  $('#curriculam_form_'+rel).append($('#curriculam_form').html());
  $('#curriculam_form_'+rel).show();
    
  $('#title').val('');
  $('#description').val('');
  $('#skills').val(rel);
                        
});

$('.edit_curriculam').on('click', function(event) {
   var url = $(this).attr('url');
   var rel = $(this).attr('rel');
   $('.curriculam_form').html('');
   $('#curriculam_form_'+rel).append($('#curriculam_form').html());
   $('#curriculam_form_'+rel).show();
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
                  $('#title').val(data.title);
                  $('#description').val(data.description);
                  var action = "{{url('/')}}/member/update_curriculam";
                  $('#frm_curriculam').attr('action', action);
              }
              $(window).scrollTop(0);      
          }        
                
         
      });
      event.preventDefault();
});

$(document).on('click','#closeCurriculam', function(event) {
  $('.curriculam_form').hide();
  event.preventDefault();
});

$(document).on('submit', 'form', function (event) {
      $form = $(this);
      var data = new FormData(this);

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
                $('.alert_message').html('<div class="alert alert-danger col-ssm-12" >' + data.message + '<button type="button" class="close scurriculam_08" data-dismiss="alert" aria-hidden="true">&times;</button></div>');
                $('.err_title').html('<div class="col-sm-12" >' + data.error.title + '</div>');
                $('.err_description').html('<div class="col-sm-12">' + data.error.description + '</div>');
                             // location.reload('/');
                }
              else{
                $('.alert_message').html('<div class="alert alert-success col-ssm-12" >' + data.message + '<button type="button" class="close scurriculam_08"  data-dismiss="alert" aria-hidden="true">&times;</button></div>');
                  if(data.status == true)
                  {
                      var url = "{{url('/')}}";
                      if(data.type == 'update')
                      {
                           $('#title_'+data.id).html(data.title);
                      }
                      else
                      {
                        $('.table-items tbody').append('<tr><td>'+data.title+'</td><td align="right"><i class="fa fa-eye curriculam-view" aria-hidden="true" data-toggle="modal" data-target="#CurriculamModal" rel="MTE="></i><span class="edit_curriculam" url="'+url+'/member/get_curriculam/'+data.id+'"><i class="fa fa-pencil" aria-hidden="true"></i></span></td></tr>');
                      }                      

                      $('.curriculam_form').html('');

                  }
                
                }

                return true;
          },
          error: function () {

          }
      });
      event.preventDefault();
});

$('.curriculam-view').on('click', function() {

  var id=$(this).attr("rel");
  $.ajax({
            url: "{{url('/')}}/member/get_curriculam/"+id,
            type: 'GET',
            dataType: "JSON",
            processData: false,
            contentType: false,
            async: false,
            success: function (data) {                    
                $("#myModalLabel").html(data.title);
                $(".modal-body").html(data.description);
            },
            error: function () {

            }
        });

});

</script>
@endsection