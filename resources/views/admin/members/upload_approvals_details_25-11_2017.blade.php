@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/data-tables/latest/dataTables.bootstrap.min.css">
<div class="page-title">
   <div>
   </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
   <ul class="breadcrumb">
      <li>
         <i class="fa fa-home"></i>
         <a href="{{ url($admin_panel_slug.'/dashboard') }}" class="call_loader">Dashboard</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-users"></i>
      <a href="{{ $module_url_path }}" class="call_loader">{{ $module_title or ''}}</a>
      </span> 
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-eye"></i>
      </span>
      <li class="active">{{ isset($page_title)?$page_title:"" }}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<h3> &nbsp;&nbsp;{{$arr_interview_member['skilldetails']['skill_name']}} real time interview questions & answers ({{$arr_interview_member['experience_level']}} year exp )</h3>
<br>
<div class="col-md-12">
  @include('admin.layout._operation_status')  
   <div class="box {{ $theme_color }}">
      <div class="box-title">
         <h3>
            <i class="fa fa-eye"></i>
             Interview Reference Book 
         </h3>
         <div class="box-tool">
            <a data-action="collapse" href="#"></a>
            <a data-action="close" href="#"></a>
         </div>
      </div>

      <div class="box-content">
       
         {!! Form::open([ 'url' => '',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <br/>
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action_upload_approve" value="" />
            <table class="table table-advance"  id="table_module" >
               <thead>
                  <tr>
                    
                     <th>S.No</th>
                     <th>Topic Name</th>
                     <th>Date & Time Uploaded</th>
                     <th>Status</th>
                     <th style="min-width:185px !important;">Action</th>
                     <th>Admin Comments</th>
                     
                  </tr>
               </thead>
               <?php $i=1; ?>
               <tbody>
                  @if(isset($arr_interview_member) && sizeof($arr_interview_member)>0)
                  @if(isset($arr_interview_member['reference_book_details']) && sizeof($arr_interview_member['reference_book_details'])>0)
                   @foreach($arr_interview_member['reference_book_details'] as $data)
                  <tr>
                    
                     <td>{{$i++}}</td>
                     <!-- <td>{{$arr_interview_member['skilldetails']['skill_name'].' reference book'}}</td> -->

                     <td>{{$data['topic_name'] or 'NA'}}</td>
                     <td>{{$data['created_at'] or 'NA' }}</td>
                     <?php $status = $data['approve_status']; ?> 
                     <td style="font-weight:bold;color:@if($status==1)green @elseif($status==2)red @elseif($status==0)#0090ff @endif">
                        @if($status==0)Pending
                        @elseif($status==1)Approved
                        @elseif($status==2)Rejected
                        @endif
                     </td>
                     <td class="ac-icons">
                      <!--   <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="glyphicon glyphicon-eye-open" title="View" ></i>
                        </a> -->
                        &nbsp;
                         <span><a href="{{$member_referencebook_public_path.$data['mul_reference_book']}}" download='' class="call_loader admin-button-icons">
                        <i class="fa fa-download" title="Download Reference Book" ></i><p>Download</p>
                        </a></span>
                         
                        <span><button  value="1" class="admin-button-icons check-icon"  onclick="return approve_change(this.value,{{$data['id']}},{{$data['interview_id']}},'status_interview')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button><p>Approve</p></span>
                        
                        <span><button  value="2" class="admin-button-icons reject-icon"  onclick="return approve_change(this.value,{{$data['id']}},{{$data['interview_id']}},'status_interview')" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></button><p>Reject</p></span>
                    
                        <!-- &nbsp;
                          <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="fa fa-edit" title="View" ></i>
                        </a>
                        &nbsp;
                          <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="fa fa-trash" title="View" ></i>
                        </a>
 -->
                     </td>
                    <td>
                        <a href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($data['id']).'/'.'comment_interview' }}" class="call_loader">
                            <i class="fa fa-comments" title="Admin Comment" ></i>
                        </a>  
                    </td>
                        <!--<select name="approve_status" class="form-control" onchange="return approve_change(this.value,{{$data['id']}},'status_interview') ">
                        <option @if($data['approve_status']==0) selected="" @endif value="0">Pending</option>
                        <option @if($data['approve_status']==1) selected="" @endif value="1">Approve</option>
                        <option @if($data['approve_status']==2) selected="" @endif value="2">Reject</option>
                        </select>-->
                     
                  </tr>
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

<div class="row">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>Interviews by Companies</h3>
            <div class="box-tool">
            </div>
         </div>

        <div class="box-content">
        <!--  @include('admin.layout._operation_status')   -->
         {!! Form::open([ 'url' => '',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <br/>
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_interviews_company" value="" />
            <table class="table table-advance"  id="table_module_company" >
               <thead>
                  <tr>
                     
                     <th>S.No</th>
                     <th>Company Name</th>
                     <th>Date & Time Uploaded</th>
                     <th>Status</th>
                     <th style="min-width:185px !important">Action</th>
                     <th>Admin Comments</th>
                     
                  </tr>
               </thead>
               <?php $i=1;  ?>
               <tbody>
                  @if(isset($arr_interview_data) && sizeof($arr_interview_data)>0)
                   @foreach($arr_interview_data as $data)
                  <tr>
                    
                     <td>{{$i++}}</td>
                     <td>{{$data['company_name'] or 'NA'}}</td>
                     <td>{{$data['created_at'] or 'NA' }}</td>
                     <?php $status = $data['approve_status']; ?> 
                     <td style="font-weight:bold;color:@if($status==1)green @elseif($status==2)red @elseif($status==0)#0090ff @endif">
                        @if($status==0)Pending
                        @elseif($status==1)Approved
                        @elseif($status==2)Rejected
                        @endif
                     </td>
                     <td class="ac-icons">
                      <!--   <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="glyphicon glyphicon-eye-open" title="View" ></i>
                        </a> -->
                        &nbsp;
                         <span> <a href="{{$member_company_attachment_public_path.'/'.$data['attachment']}}" download='' class="call_loader admin-button-icons">
                        <i class="fa fa-download" title="Download" ></i><p>Download</p>
                        </a></span>
                         
                        <span><button  value="1" class="admin-button-icons check-icon"  onclick="return approve_change(this.value,{{$data['id']}},{{$data['interview_id']}},'status_company')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></button><p>Approve</p></span>
                        <span><button  value="2" class="admin-button-icons reject-icon"  onclick="return approve_change(this.value,{{$data['id']}},{{$data['interview_id']}},'status_company')" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></button><p>Reject</p></span>
                        
                    
                       <!--  &nbsp;
                          <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($data['id']) }}" class="call_loader">
                        <i class="fa fa-edit" title="View" ></i>
                        </a>
                        &nbsp;
                          <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($data['id']) }}" class="call_loader">
                        <i class="fa fa-trash" title="View" ></i>
                        </a> -->

                     </td>
                    <td>
                        <a href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($data['id']).'/'.'comment_company' }}" class="call_loader">
                            <i class="fa fa-comments" title="Admin Comment" ></i>
                        </a>  
                    </td>
                    
                     
                       <!-- <select name="approve_status_company" class="form-control" onchange="return approve_change(this.value,{{$data['id']}},'status_company') ">
                        <option @if($data['approve_status']==0) selected="" @endif value="0">Pending</option>
                        <option @if($data['approve_status']==1) selected="" @endif value="1">Approve</option>
                        <option @if($data['approve_status']==2) selected="" @endif value="2">Reject</option>
                        </select>-->
                     
                  </tr>
                  @endforeach
                  @else
                    <tr><td colspan="7"><div style="color:red;text-align:center;">No Records Found</div></td></tr>
                  @endif
               </tbody>
            </table>
         </div>
         {!! Form::close() !!}
      </div>

      </div>
   </div>
</div>   

<div class="row">
   <div class="col-md-12">
      <div class="box">
         <div class="box-title">
            <h3><i class="fa fa-eye"></i>Real Time Work Experience (Tickets, Tasks, Issues)</h3>
            <div class="box-tool">
            </div>
         </div>

        <div class="box-content">
       <!--   @include('admin.layout._operation_status')   -->
         {!! Form::open([ 'url' => '',
         'method'=>'POST',
         'enctype' =>'multipart/form-data',   
         'class'=>'form-horizontal', 
         'id'=>'frm_manage' 
         ]) !!}
         {{ csrf_field() }}
         <br/>
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_interviews_company" value="" />
            <table class="table table-advance"  id="table_module_ticket" >
               <thead>
                  <tr>
                    
                     <th>S.No</th>
                     <th>RWE</th>
                     <th>Date & Time Uploaded</th>
                     <th>Status</th>
                     <th style="min-width:185px !important">Action</th>
                     <th>Admin Comments</th>
                    
                  </tr>
               </thead>
               <?php $i=1; ?>
               <tbody>
                  @if(isset($arr_real_time_work) && sizeof($arr_real_time_work)>0)
                   @foreach($arr_real_time_work as $data_rwe)
                  <tr>
                    
                     <td>{{$i++}}</td>
                     <td>{{$data_rwe['issue_title'] or 'NA'}}</td>
                     <td>{{$data_rwe['created_at']}}</td>
                     <?php $status = $data_rwe['approve_status']; ?> 
                     <td style="font-weight:bold;color:@if($status==1)green @elseif($status==2)red @elseif($status==0)#0090ff @endif">
                        @if($status==0)Pending
                        @elseif($status==1)Approved
                        @elseif($status==2)Rejected
                        @endif
                     </td>
                     <td class="ac-icons">
                    
                        &nbsp;
                         <span><a href="{{$member_realtime_attachment_public_path.$data_rwe['attachment']}}" download='' class="call_loader admin-button-icons">
                        <i class="fa fa-download" title="Download" ></i><p>Download</p>
                        </a></span>
                          
                        <span><button  value="1" class="admin-button-icons check-icon"  onclick="return approve_change(this.value,{{$data_rwe['id']}},{{$data_rwe['interview_id']}},'status_rwe')" title="Approve"><i class="fa fa-check" aria-hidden="true"></i>
                      </button><p>Approve</p></span>
                       <span><button  value="2" class="admin-button-icons reject-icon"  onclick="return approve_change(this.value,{{$data_rwe['id']}},{{$data_rwe['interview_id']}},'status_rwe')" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></button><p>Reject</p></span>
                        
                    
                     
                     </td>
                     <td>
                        <a href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($data_rwe['id']).'/'.'comment_rwe' }}" class="call_loader">
                            <i class="fa fa-comments" title="Admin Comment" ></i>
                        </a>  
                    </td>
                     
                     
                        <!--<select name="approve_status_rwe" class="form-control" onchange="return approve_change(this.value,{{$data_rwe['id']}},'status_rwe') ">
                        <option @if($data_rwe['approve_status']==0) selected="" @endif value="0">Pending</option>
                        <option @if($data_rwe['approve_status']==1) selected="" @endif value="1">Approve</option>
                        <option @if($data_rwe['approve_status']==2) selected="" @endif value="2">Reject</option>
                        </select>-->
                     
                  </tr>
                  @endforeach
                  @else
                      <tr><td colspan="7"><div style="color:red;text-align:center;">No Records Found</div></td></tr>
                  @endif
               </tbody>
            </table>
         </div>
         {!! Form::close() !!}
      </div>


      </div>
   </div>
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
   function approve_change(val,id,interview_id,status) {

         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var status        = status;
               var interview_id  = interview_id;

               var success_link  = "{{url('/')}}/admin/members/upload_approve_details/{{ base64_encode($arr_interview_member['id']) }}";
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
          }
        return false;   
   }
</script>
@stop

