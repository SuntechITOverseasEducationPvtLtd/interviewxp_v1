    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="http://cloudforcehub.com/interviewxp/themeassets/assets/css/colors.css" rel="stylesheet" type="text/css">
     <style type="text/css">.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    vertical-align: middle;
    font-size: 13px;
}
                          .rounded-box {
                                  border-radius: 0%;
                                  height: 67px;
                                  overflow: hidden;
                                  width: 80px;
                                  float: left;
                          }
                          .rounded-box img {
                              border-radius: 50%;
                              float: left;
                              height: 73%;
                              width: 73%;
                          }
                           .proimgset {
                                height: 60px !important;
    width: 60px !important;
                          }
                           .table td {   padding: 2px 7px !important; }
                           p {
    margin: 0 0 3px; }
    h4.value {line-height: 14px;
    font-size: 13px;
    color: #13c0b2;
    font-weight: bold;}
    
    label {
    margin-bottom: 7px;
    font-weight: 400;
    line-height: 30px;
}

.nav-tabs li.active {
    background: #f5f5f5 !important;
    height: 200px !important;
    padding: 5px !important;
}

.nav-tabs > li {
    display: inline-block;
    font-size: 13px ;
    background: #f5f5f566 !important;
    margin: 0px 5px !important;
    height: 200px !important;
    padding: 5px !important;
}



                        </style>

                
                  
                   <?php
    $refId = base64_encode($interview_id);
    $urlrefId = isset($_GET['ref']) ? $_GET['ref'] : '';
    $tab = isset($_GET['t']) ? $_GET['t'] : '';
    if($urlrefId ==  $refId)
    {
      $styleRef = '';
      $styleBottomRef = '';
    }
    else if(!empty($urlrefId))
    {
      $styleRef = 'display:none';
      $styleBottomRef = 'display:none';
    }
    else{
      $styleRef = '';
      $styleBottomRef = 'display:none';
    }
    
    ?>
  <?php
    $qa_columns = array_column($arr_interview_member['ref_book_details'],'approve_status');
    $qaRes = [];
    if($qa_columns)
    {
      foreach ($qa_columns as $key => $value) {
        $newArray= explode(',',$value);
        $qaRes = array_merge($qaRes, $newArray);
      }     
    }
    $qa = array_count_values($qaRes);  
    $company = array_count_values(array_column($arr_interview_data,'approve_status'));
    $workexp = array_count_values(array_column($arr_real_time_work,'approve_status'));
    $pendingQA = 0;
    $approveQA = 0;
    $rejectedQA = 0;
    if(isset($qa[0])) $pendingQA =  $qa[0];
    if(isset($qa[1])) $approveQA =  $qa[1];
    if(isset($qa[2])) $rejectedQA =  $qa[2];
    if(isset($qa[3])) $pendingQA =  $pendingQA + $qa[3];

    $pendingCompany = 0;
    $approveCompany = 0;
    $rejectedCompany = 0;
    if(isset($company[0])) $pendingCompany =  $company[0];
    if(isset($company[1])) $approveCompany =  $company[1];
    if(isset($company[2])) $rejectedCompany =  $company[2];
    if(isset($company[3])) $pendingCompany =  $pendingCompany + $company[3];

    $pendingWXP = 0;
    $approveWXP = 0;
    $rejectedWXP = 0;
    if(isset($workexp[0])) $pendingWXP =  $workexp[0];
    if(isset($workexp[1])) $approveWXP =  $workexp[1];
    if(isset($workexp[2])) $rejectedWXP =  $workexp[2];
    if(isset($workexp[3])) $pendingWXP =  $pendingWXP + $workexp[3];

    $statusQa = '';
    if(!empty($arr_interview_member['is_qa_submitted_review']))
    {
      $type = '&#34;interview_qa&#34;';
      $statusQa = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_by_admin(this.value,'.$interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
    }
    else if($arr_interview_member['admin_approval_qa'] != 1)
    {
      $statusQa = '(Pending)';
    }
    else if($arr_interview_member['admin_approval_qa'] == 1)
    {
      $statusQa = '(<span style="color:#009900">Live</span>)';
    }
    else if(isset($qa[2]))
    {
      $statusQa = '(<span style="color:red">Rejected</span>)';
    }
    else
    {
      $statusQa = '(<span style="color:black">Draft</span>)';
    }

    $statusCompany = '';
    if(!empty($arr_interview_member['is_company_submitted_review']))
    {
      $type = '&#34;company&#34;';
      $statusCompany = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_by_admin(this.value,'.$interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
    }
    else if($arr_interview_member['admin_approval_company'] != 1)
    {
      $statusCompany = '(Pending)';
    }
    else if($arr_interview_member['admin_approval_company'] == 1)
    {
      $statusCompany = '(<span style="color:#009900">Live</span>)';
    }
    else if(isset($company[2]))
    {
      $statusCompany = '(Rejected)';
    }
    else
    {
      $statusCompany = '(<span style="color:black">Draft</span>)';
    }

    $statusRealExp = '';
    if(!empty($arr_interview_member['is_realissues_submitted_review']))
    {
      $type = '&#34;work_exp&#34;';
      $statusRealExp = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_by_admin(this.value,'.$interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
    }
    else if($arr_interview_member['admin_approval_realissues'] == 0)
    {
      $statusRealExp = '(Pending)';
    }
    else if($arr_interview_member['admin_approval_realissues'] == 1)
    {
      $statusRealExp = '(<span style="color:#009900">Live</span>)';
    }
    else if(isset($workexp[2]))
    {
      $statusRealExp = '(Rejected)';
    }
    else
    {
      $statusRealExp = '(<span style="color:black">Draft</span>)';
    }

 
                  
              
                 
                 
                 ?>
                 
                 
                   <!-- Modal -->
<div class="modal fade" id="admin_comments_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                     Upload Approvals Comment
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                
               {{ Form::open(array('url'=>'','method'=>'post', 'id'=>'form_admin_comment')) }}
                  <div class="form-group">
                    {{ csrf_field() }}
                    {!! Form::hidden('inputId', null,['class'=>'form-control','id'=>'inputId']) !!}
                    {!! Form::hidden('inputValue', null,['class'=>'form-control','id'=>'inputValue']) !!}
                    {!! Form::hidden('inputInterviewId', null,['class'=>'form-control','id'=>'inputInterviewId']) !!}
                    {!! Form::hidden('inputStatus', null,['class'=>'form-control','id'=>'inputStatus']) !!}
                    {!! Form::textarea('inputComment', null, array('required','class'=>'form-control','placeholder'=>'Enter Comment', 'cols'=>2,'rows'=>2)) !!}
                    </div>
                  <div class="form-group">
                    {!! Form::submit('submit', array('class'=>'btn btn-primary', 'id'=>'btn_admin_comment')) !!}
                  </div>
                {{ Form::close() }}            
            </div>
         
        </div>
    </div>
</div>
                 
                       <div class="box {{ $theme_color }}">
      <!--<div class="box-title">
         <h3>
            <i class="fa fa-eye"></i>
             Interview Reference Book 
         </h3>
         <div class="box-tool">
            <a data-action="collapse" href="#"></a>
            <a data-action="close" href="#"></a>
         </div>
      </div>-->

      <div class="box-content">
       
         {!! Form::open([ 'url' => '',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action_upload_approve" value="" />
            <table class="datatable table table-striped table-bordered" style="min-width: 1200px;    overflow: auto;" >
               <thead>
                   <tr style="background-color: #26A69A !important; height:45px;      color: #fff;  border-color: #26A69A !important;">
                    
                     
	<td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;    "><div style="width:60px; float:left">S.No </div></td>
	<td style="font-family: 'ubuntumedium',sans-serif;font-size: 13px;">
	<div style="width:300px; float:left; text-align:left">Topic Name  <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
	<div style="width:100px; float:left; text-align:left">File Size <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div>
	<div style="width:100px; float:left; text-align:left">Date & Time <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
	<div style="width:100px; float:left; text-align:left">Status <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div> 
	<div style="width:306px; float:left; text-align:left">Action <img src="{{ url('/') }}/images/asendp.jpg" style="    margin-top: -6px;"></div>
	
	<div style="width:140px; float:left; text-align:left">Admin Comment </div>
	</td>
																	
																
																 
																   
																   
                     
                     
                  </tr>
               </thead>
               <?php $i=1; ?>
               <tbody>
                  @if(isset($arr_interview_member) && sizeof($arr_interview_member)>0)
                  @if(isset($arr_interview_member['ref_book_details']) && sizeof($arr_interview_member['ref_book_details'])>0)
                   @foreach($arr_interview_member['ref_book_details'] as $data)
                  <tr>
                    
                     <td style="background-color: #f6f6f6;">{{$i++}}</td>
                     <!-- <td>{{$arr_interview_member['skilldetails']['skill_name'].' reference book'}}</td> -->

                     <td style="background-color: #f6f6f6;"><p style="  padding: 7px 0px;
    color: #26a69a;">{{$data['topic_name'] or 'NA'}} </p>
                     <?php $status = $data['approve_status']; 
                     
                  $results1 = DB::select( DB::raw("SELECT * FROM multi_reference_book WHERE interview_id = '".$data['interview_id']."' AND topic_name = '".$data['topic_name']."' ORDER BY `multi_reference_book`.`id` DESC") );      
                   foreach ($results1 as $key1=>$user1) {
                    
                     if($user1->file_extension =='Pdf'){
                       $icon='<i class="fa fa-file-pdf-o"></i>';
                     }else if($user1->file_extension =='Video'){
                       $icon='<i class="fa fa-play"></i>';
                     }else{
                       $icon="";
                     }
                     $viewicon=url('/')."/images/viewicon.png";
                      // dd($data);
                     if($user1->approve_status==1){
                       $status="<span class='label bg-success heading-text'>Approved</span>";
                     }
                     else if($user1->approve_status==2)
                     {
                       $status="Rejected";
                     }
                     else if($user1->approve_status==3)
                     {
                       $status="Requested";
                     }                       
                     else{
                      $status="Pending";
                     }
                     
                   if($key1==0) { $margintop='margin-top: 9px;'; } else { $margintop=''; }  
                  ?>
                
                    	 <div style="float: left;   width: 100%; 
					 border-bottom: 1px solid #e4e7ec; background: #fff;   {{$margintop}}">
                    	     
                   	<div style="width:305px; float:left"><?php echo $icon ?> &nbsp;&nbsp; Part {{$key1+1}} &nbsp;&nbsp; {{$user1->pageCount}} </div>
                   <div style="width:100px; float:left">{{$user1->fileSize}} M.B</div>
                  <div style="width:100px; float:left">{{date('j M, Y, g:i A T',strtotime($user1->created_at))}}
                      @if($user1->freePreview =='Yes')<i class="fa fa-eye" aria-hidden="true" title="Free Preview" style="margin-left:10px;color: #17b0a4 !important;"></i>@endif
                   </div>
                   <div style="width:100px; float:left; background-color: #fff;font-weight:bold;color:@if($user1->approve_status==1)green @elseif($user1->approve_status==2)red @elseif($user1->approve_status==0)#0090ff @endif"><?php echo $status;?></div>
                   <div style="width:306px; float:left; background-color: #fff; ">
                      
                       
                       
                        <span> <a href="{{$member_referencebook_public_path.$user1->mul_reference_book}}" class="admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-download4" title="Download"></i>
                        </a>  </span>
                        
                        
                        
                        <span> <a href="{{$member_referencebook_public_path.$user1->mul_reference_book}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                         <button style="margin-top:-19px" value="1" class="btn btn-success btn-rounded" onclick="return approve_change(this.value,{{$user1->id}},{{$user1->interview_id}},'status_interview')" title="Approve"><i class="icon-checkmark4" aria-hidden="true" title="Approve"></i> Approve</button>
                         
                         
                   
                   <button style="margin-top:-19px" value="2" class="btn btn-warning btn-rounded btn-sm" onclick="return approve_change(this.value,{{$user1->id}},{{$user1->interview_id}},'status_interview')" title="Reject"><i class="icon-cross2" aria-hidden="true" title="Reject"></i> Reject</button>
                   
                   
                      
                        <span><a href="{{url('/admin/members/delete_reference_book/'.base64_encode($user1->id).'/'.base64_encode($interview_id))}}" onclick="return confirm_delete();" class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span>
                        
                        
                        
                    
                  </div>
                   <div style="width:100px; float:left">
                          <?php 
                            $admin_comments = $user1->admin_comments ? $user1->admin_comments : 'Admin Comment';
                            $admin_comments_color = $user1->admin_comments ? 'color: green;' : 'color: #337ab7;';
                         ?>
                      
                        <a  href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($user1->id).'/'.'comment_interview' }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">

                          <i class="icon-comments" style="color: green;;cursor: pointer;" title="{{$admin_comments}}"></i> </a>
                          
                          
                          </div>
                          </div>
                          
                          
                          
                          
                          
                          
                    </td>
                  </tr>
                  <?php } ?>
                  @endforeach
                  @else
                     <tr><td colspan="7"><div style="color:red;text-align:center;">No Records Found</div></td></tr>
                  @endif
                  @endif
               </tbody>
            </table>
         </div>
         {!! Form::close() !!}
      </div>

      </div>
      
      
      <!-- END Main Content -->
<script type="text/javascript">
   $(document).ready(function() {
    /*   $('#table_module').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           ]
   
       });

        $('#table_module_company').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },

           ]
   
       });

        $('#table_module_ticket').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },

           ]
   
       });*/
   });
   
   function show_details(url)
   { 
      
       window.location.href = url;
   } 
   
   function confirm_delete()
   { 
      if(confirm('Are you sure to delete this record?'))
      {
        return true;
      }
      return false;
   }
   
   function check_multi_action(checked_record,frm_id,action)
   {
     var checked_record = document.getElementsByName(checked_record);
     var len = checked_record.length;
     var flag=1;
     var input_multi_action = jQuery('input[name="multi_action_upload_approve"]');
     var frm_ref = jQuery("#"+frm_id);
     
     if(len<=0)
     {
       alert("No records to perform this action");
       return false;
     }
     
     if(confirm('Do you really want to perform this action'))
     {
       for(var i=0;i<len;i++)
       {
         if(checked_record[i].checked==true)
         {  
             flag=0;
             /* Set Action in hidden input*/
             jQuery('input[name="multi_action_upload_approve"]').val(action);
   
             /*Submit the referenced form */
             jQuery(frm_ref)[0].submit();  
           }
         }
   
       if(flag==1)
       {
         alert('Please select record(s)');
         return false;
       }  
         
     } 
     
   }
</script>
<script>

   function updateComapny(id,company_id,interview_id) {
      $('#update_company').modal('show');
          var company_location = $('#company_location_'+id).val();
          var company_name = $('#company_name_'+id).val();
          $('#company_primary_id').val(id);
          $('#company_id').val(company_id);
          $('#company_name').val(company_name);
          $('#company_location').val(company_location);
          $('#interview_id').val(interview_id);
          var url = "{{url('/')}}/admin/members/update_company";
          $('#form_update_company').attr('action',url);
   }
   function approve_change(val,id,interview_id,status) {

          $('#admin_comments_modal').modal('show');
          $('#inputId').val(id);
          $('#inputValue').val(val);
          $('#inputInterviewId').val(interview_id);
          $('#inputStatus').val(status);
          var url = "{{url('/')}}/admin/members/upload_approve_change";
          $('#form_admin_comment').attr('action',url);

         /*if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var status        = status;
               var interview_id  = interview_id;
               
               if(status == 'status_rwe')
               {
                  $tab = 'realissues';
               }
               else if(status == 'status_company')
               {
                  $tab = 'company';
               }
               else
               {
                  $tab = 'interview-qa';
               }
               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}?t="+$tab;
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/upload_approve_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id,status:status,interview_id:interview_id},
               dataType: "json"
             }).done(function(result){
                
                 if(result.status=="SUCCESS")
                 {
                    location.href = success_link;
                 }
                 if(result.status=="ERROR")
                 {
                   location.href = success_link;
                 }
             });
          }*/
        return false;   
   }
   function approve_by_admin(val,id,type) 
   {
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var approve_type = type;
               //var success_link  = "{{url('/')}}/admin/members/upload_approve_details";
               if(type == 'work_exp')
               {
                  $tab = 'realissues';
               }
               else if(type == 'company')
               {
                  $tab = 'company';
               }
               else
               {
                  $tab = '';
               }
               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}?t="+$tab;
               
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/upload_approve_admin_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id,type:approve_type},
               dataType: "json"
             }).done(function(result){
                
                 if(result.status=="SUCCESS")
                 {
                    location.href = success_link;
                 }
                 if(result.status=="ERROR")
                 {
                   location.href = success_link;
                 }
             });
          }
        return false;   
   }
   function multi_approve_change(val,id,type,topic) 
   {
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var approve_type = type;
               var approve_topic = topic;
               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}";
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/part_approve_admin_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id,type:approve_type,topic:approve_topic},
               dataType: "json"
             }).done(function(result){
                
                 if(result.status=="SUCCESS")
                 {
                    location.href = success_link;
                 }
                 if(result.status=="ERROR")
                 {
                   location.href = success_link;
                 }
             });
          }
        return false;   
   }
</script>

      
      
      	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.min.js"></script>
		<script src="https://www.jquery-az.com/boots/js/datatables/datatables.js"></script>
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
		
		
		
		