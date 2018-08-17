@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
 <style type="text/css">
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
                        </style>



<div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
               <div class="btn-group"> 
             
            </div>
                      </div>
            </div>
      <div class="box-content">
         @include('admin.layout._operation_status')  
         {!! Form::open([ 'url' => $module_url_path.'/multi_action_upload_approve',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <div class="col-md-10">
            <div id="ajax_op_status">
            </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
         </div>
         <div class="btn-toolbar pull-right clearfix">
            <div class="btn-group" style="visibility:hidden">
               <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records call_loader">Add New {{ str_singular($module_title) }}</a> 
            </div>
            <!-- <div class="btn-group">
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                  title="Multiple Active/Unblock" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','activate');" 
                  style="text-decoration:none;">
               <i class="fa fa-unlock"></i>
               </a> 
            </div> -->
           <!--  <div class="btn-group">
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                  title="Multiple Deactive/Block" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','deactivate');"  
                  style="text-decoration:none;">
               <i class="fa fa-lock"></i>
               </a> 
            </div> -->
            <div class="btn-group"> 
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip call_loader" 
                  title="Refresh" 
                  href="{{ $module_url_path.'/upload_approvals'}}"
                  style="text-decoration:none;">
               <i class="fa fa-repeat"></i>
               </a> 
            </div>
            <br>
         </div>
         <br/>
         <div class="clearfix"></div>
         <style type="text/css">
           .circle {
                padding: 2px 6px 2px 6px;
                border: 1px solid #525252;
                margin-left: 2px;
                vertical-align: middle;
                border-radius: 50%;
                position: relative;
                cursor: pointer;
                font-size: 13px;
                text-align: center;
                width: 100%;
           }           
           .circle span{
              font-size: 10px;
              font-weight: 700;            
           }
           .circle.pending{
            border-color: #0090ff;
           }
           .circle.pending span{
            color: #0090ff;
           }
           .circle.rejected{
            border-color: red;
           }
           .circle.rejected span{
            color: red;
           }
           .circle.approve{
            border-color: #009900;
           }
           .circle.approve span{
            color: #009900;
           }
           hr {
                margin-top: 3px;
                margin-bottom: 3px;
                border: 0;
                border-top: none;
            }
         </style>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action_upload_approve" value="" />
         <table class="datatable table table-striped table-bordered">
               <thead>
                  <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;" role="row">
                     <!--<th style="width:18px">
                        <input type="checkbox" name="mult_change" id="mult_change" />
                     </th>-->
                     <th>S.No</th>
                     <th>A/C Activated</th>
                     <th>Email</th>
                     <th>Gender</th>
                     <th>PH.No</th>
                     <th>Skill</th>
                     <th>Exp Level</th>                     
                     <th colspan="3" style="min-width:450px !important;">Type & Upload Status</th>
                     <!--<th>Visitors Views</th>
                     <th>Upload Status</th>
                     <!--<th>Status</th>-->
                     <th>Action</th>
                     <!--  <th>Admin Comments</th> -->
                    
                  </tr>
               </thead>
               <tbody>
                  @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $i=>$data)
                    <tr>  
                      <!--<td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data->interview_id) }}" /> 
                     </td>-->
                     <td>{{$data->id}}</td>
                     <td>{{ isset($data->publish_date) ? date('j M, Y, g:i A T',strtotime($data->publish_date)) : '' }}</td>
                      <?php 
                        $email = (strlen($data->email) > 20) ? substr($data->email,0,17).'...' : $data->email; 
                      ?>
                     <td><span title="{{$data->email}}">{{ $email }}</span></td>
                     <td>{{ $data->gender }}</td>
                     <td>{{ $data->mobile_no }}</td>
                     <td>{{ $data->skill_name }}</td>
                     <td>{{ $data->experience_level }}</td>
                     <td>
                        <?php 
                        $qa = array_count_values(explode(',',$data->qa_status)); 
                        $statusQa = '';
                        if(!empty($data->is_qa_submitted_review))
                        {
                          $type = '&#34;interview_qa&#34;';
                          $statusQa = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_change(this.value,'.$data->interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
                        }
                        else if($data->admin_approval_qa != 1)
                        {
                          $statusQa = '(Pending)';
                        }
                        else if($data->admin_approval_qa == 1)
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
                        $pendingQA = 0;
                        $approveQA = 0;
                        $rejectedQA = 0;
                        if(isset($qa[0])) $pendingQA =  $qa[0];
                        if(isset($qa[1])) $approveQA =  $qa[1];
                        if(isset($qa[2])) $rejectedQA =  $qa[2];
                        ?>
                        <span style="font-weight: bold;">Q&A{!!$statusQa!!}</span><hr>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle pending" title="Pending"><span>{{ $pendingQA }}</span></span><br>Pending</span>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle approve" title="Approved"><span>{{ $approveQA }}</span></span><br>Approved</span>
                        <span style="float: left;width: 33%;font-size: 9px;padding-left: 5px;"><span class="circle rejected" title="Rejected"><span>{{ $rejectedQA }}</span></span><br>Rejected</span>
                      </td>                     
                     <td>
                        <?php 
                          $company = array_count_values(explode(',',$data->company_status));
                          $statusCompany = '';
                          if(!empty($data->is_company_submitted_review))
                          {
                            $type = '&#34;company&#34;';
                            $statusCompany = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_change(this.value,'.$data->interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
                          }
                          else if($data->admin_approval_company != 1)
                          {
                            $statusCompany = '(Pending)';
                          }
                          else if($data->admin_approval_company == 1)
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
                          $pendingCompany = 0;
                          $approveCompany = 0;
                          $rejectedCompany = 0;
                          if(isset($company[0])) $pendingCompany =  $company[0];
                          if(isset($company[1])) $approveCompany =  $company[1];
                          if(isset($company[2])) $rejectedCompany =  $company[2];
                        ?>
                        <span style="font-weight: bold;">Companies{!!$statusCompany!!}</span><hr>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle pending" title="Pending"><span>{{ $pendingCompany }}</span></span><br>Pending</span>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle approve" title="Approved"><span>{{ $approveCompany }}</span></span><br>Approved</span>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle rejected" title="Rejected"><span>{{ $rejectedCompany }}</span></span><br>Rejected</span>
                      </td>                     
                     <td>
                        <?php 
                          $workexp = array_count_values(explode(',',$data->realissues_status));
                          $statusRealExp = '';
                          if(!empty($data->is_realissues_submitted_review))
                          {
                            $type = '&#34;work_exp&#34;';
                            $statusRealExp = '(<span class="check-icon" style="font-size: 14px;">Requested<button value="1" class="admin-button-icons check-icon" onclick="return approve_change(this.value,'.$data->interview_id.','.$type.')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button></span>)';
                          }
                          else if($data->admin_approval_realissues != 1)
                          {
                            $statusRealExp = '(Pending)';
                          }
                          else if($data->admin_approval_realissues == 1)
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
                          $pendingWXP = 0;
                          $approveWXP = 0;
                          $rejectedWXP = 0;
                          if(isset($workexp[0])) $pendingWXP =  $workexp[0];
                          if(isset($workexp[1])) $approveWXP =  $workexp[1];
                          if(isset($workexp[2])) $rejectedWXP =  $workexp[2];
                        ?>
                        <span style="font-weight: bold;">Work Exp{!!$statusRealExp!!}</span><hr>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle pending" title="Pending"><span>{{ $pendingWXP }}</span></span><br>Pending</span>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle approve" title="Approved"><span>{{ $approveWXP }}</span></span><br>Approved</span>
                        <span style="float: left;width: 33%;font-size: 9px;"><span class="circle rejected" title="Rejected"><span>{{ $rejectedWXP }}</span></span><br>Rejected</span>
                      </td> 
                     <td class="ac-icons"> 
                       
                        
                       
                        
                        
                        <span> <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($data->interview_id) }}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                        
                        
                        
                        <!--<span><button  value="1" class="admin-button-icons check-icon"  onclick="return approve_change(this.value,{{$data->interview_id}})" title="Publish"><i class="fa fa-check" aria-hidden="true"></i> </button>
                        <p>Publish</p></span>
                     <span><button  value="2" class="admin-button-icons reject-icon"  onclick="return approve_change(this.value,{{$data->interview_id}})" title="Reject"><i class="fa fa-times" aria-hidden="true"></i> </button>
                     <p>Reject</p></span>-->   
                    
                     </td>                    
                  @endforeach
                  @endif
               </tbody>
             </table>  
            <?php /*<table class="table table-advance"  id="table_module" >
               <thead>
                  <tr>
                     <th style="width:18px">
                        <input type="checkbox" name="mult_change" id="mult_change" />
                     </th>
                     <th>S.No</th>
                     <th>Email ID</th>
                     <th>Gender</th>
                     <th>PH.No</th>
                     <th>Exp Level</th>
                     <th>Skill</th>
                     <th>Registered On</th>
                     <th>Visitors Views</th>
                     <th>Upload Status</th>
                     <!--<th>Status</th>-->
                     <th style="min-width:135px !important;">Action</th>
                     <!--  <th>Admin Comments</th> -->
                    
                  </tr>
               </thead>
               <tbody>
                  <?php $type='edit'; $i=1;?>
                  @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $data)
                  <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data['id']) }}" /> 
                     </td>
                     <td>{{$i++}}</td>
                     <td>{{ $data['member_personal_details']['email'] or 'NA' }}</td>
                     <td>@if($data['member_personal_details']['gender']=="M")Male @else Female @endif</td>
                     <td>{{ $data['member_personal_details']['mobile_no'] or 'NA' }}</td>
                     <td>{{ ($data['experience_level'] != 'NA') ? $data['experience_level'].' years' : 'NA' }}</td>
                     <td>{{ $data['skilldetails']['skill_name'] or 'NA' }}</td>
                     <td>{{ date(' d  M, Y' ,strtotime($data['created_at'])) }}</td>
                     <td>{{$data['view_count']}}</td>
                     
                     <td style="font-weight:bold;color:@if($data['admin_approval']==1)green @elseif($data['admin_approval']==2)red @elseif($data['admin_approval']==0)#0090ff @endif">
                        @if($data['admin_approval']==0)Pending <span class="pen_status">{{$data['count']}}</span>
                        @elseif($data['admin_approval']==1)Published <span class="pen_status">{{$data['count']}}</span>
                        @elseif($data['admin_approval']==2)Rejected <span class="pen_status">{{$data['count']}}</span>
                        @endif
                     </td>
                    
                     <!--  <td>
                        <a href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($data['id']) }}" class="call_loader">
                            <i class="fa fa-comments" title="View" ></i>
                        </a>  
                        </td> -->
                     <!--<td>
                        @if($data['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate_upload_approve/'.base64_encode($data['id']) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm('Are you sure to Deactivate this record?')"><i class='fa fa-unlock'></i></a>
                        @else
                        <a href="{{ $module_url_path.'/activate_upload_approve/'.base64_encode($data['id']) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm('Are you sure to Activate this record?')"><i class='fa fa-lock'></i></a>
                        @endif
                     </td>-->
                     <td class="ac-icons"> 
                       <span><a class="admin-button-icons" href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($data['id']) }}" class="call_loader">
                        <i class="glyphicon glyphicon-eye-open" title="View" ></i><p>View</p>
                          
                        </a></span>
                        <span><button  value="1" class="admin-button-icons check-icon"  onclick="return approve_change(this.value,{{$data['id']}})" title="Publish"><i class="fa fa-check" aria-hidden="true"></i> </button>
                        <p>Publish</p></span>
                     <span><button  value="2" class="admin-button-icons reject-icon"  onclick="return approve_change(this.value,{{$data['id']}})" title="Reject"><i class="fa fa-times" aria-hidden="true"></i> </button>
                     <p>Reject</p></span>   
                    
                     </td>
                     
                    
                    <!--    <select name="approve_status" class="form-control" onchange="return approve_change(this.value,{{$data['id']}}) ">
                        <option @if($data['admin_approval']==0) selected="" @endif value="0">Pending</option>
                        <option @if($data['admin_approval']==1) selected="" @endif value="1">Publish</option>
                        <option @if($data['admin_approval']==2) selected="" @endif value="2">Reject</option>
                        </select>-->
                    
                  </tr>
                  @endforeach
                  @endif
               </tbody>
            </table> */ ?>
         </div>
         {!! Form::close() !!}
      </div>
   </div>
</div>
<!-- END Main Content -->
<script type="text/javascript">
   $(document).ready(function() {
       $('#table_module').DataTable( {
           "aoColumns": [
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": false }
           ]
   
       });
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
   function approve_change(val,id,type) 
   {
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var approve_type = type;
               var success_link  = "{{url('/')}}/admin/members/upload_approvals";
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
</script>

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
@stop

