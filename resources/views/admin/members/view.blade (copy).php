

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
<!-- <h3>   Php Real Time Interview Questions & Answers ( 0-2 Year Exp ) </h3> -->
<div class="col-md-12">
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
         @include('admin.layout._operation_status')  
         {!! Form::open([ 'url' => $module_url_path.'/multi_action_upload_approve',
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
                     <th style="width:18px">
                        <input type="checkbox" name="mult_change" id="mult_change" />
                     </th>
                     <th>Topic Name</th>
                     <th>Date & Time Uploaded</th>
                     <th>Status</th>
                     <th>Action</th>
                     <th>Admin Comments</th>
                     <th>Posting</th>
                  </tr>
               </thead>
               <tbody>
                  @if(isset($arr_interview_member) && sizeof($arr_interview_member)>0)
                  <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($arr_interview_member['id']) }}" /> 
                     </td>
                     <td>{{$arr_interview_member['skilldetails']['skill_name']}}</td>
                     <td>{{$arr_interview_member['created_at'] }}</td>
                     <?php $status = $arr_interview_member['admin_approval']; ?> 
                     <td style="font-weight:bold;color:@if($status==1)green @elseif($status==2)red @elseif($status==0)#0090ff @endif">
                        @if($status==0)Pending
                        @elseif($status==1)Approved
                        @elseif($status==2)Not Approved
                        @endif
                     </td>
                     <td>
                      <!--   <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="glyphicon glyphicon-eye-open" title="View" ></i>
                        </a> -->
                        &nbsp;
                          <a href="{{$member_referencebook_public_path.$arr_interview_member['reference_book']}}" download='' class="call_loader">
                        <i class="fa fa-download" title="View" ></i>
                        </a>
                        &nbsp;
                          <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="fa fa-edit" title="View" ></i>
                        </a>
                        &nbsp;
                          <a href="{{ $module_url_path.'/upload_approve_details/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                        <i class="fa fa-trash" title="View" ></i>
                        </a>

                     </td>
                    <td>
                        <a href="{{ $module_url_path.'/comment_upload_approvals/'.base64_encode($arr_interview_member['id']) }}" class="call_loader">
                            <i class="fa fa-comments" title="View" ></i>
                        </a>  
                    </td>
                     <td>
                        <select name="approve_status" class="form-control" onchange="return approve_change(this.value,{{$arr_interview_member['id']}}) ">
                        <option @if($arr_interview_member['admin_approval']==0) selected="" @endif value="0">Pending</option>
                        <option @if($arr_interview_member['admin_approval']==1) selected="" @endif value="1">Approved</option>
                        <option @if($arr_interview_member['admin_approval']==2) selected="" @endif value="2">Not Approved</option>
                        </select>
                     </td>
                  </tr>
                
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
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6">
                        <h3>
                           <span 
                              class="text-" 
                              ondblclick="scrollToButtom()"
                              style="cursor: default;" 
                              title="Double click to Take Action" 
                              >
                           </span>
                        </h3>
                     </div>
                     <div class="col-md-6">
                     </div>
                  </div>
                  {!! Form::open([ 
                  'method'=>'POST',
                  'enctype' =>'multipart/form-data',   
                  'class'=>'form-horizontal', 
                  'id'=>'validation-form' 
                  ]) !!} 
                  <div class="form-group">
                     <!--  <div class="col-sm-3 text-right">
                        <label class="main-label" >Disk usage</label>
                        </div> -->
                     <div class="col-sm-9">
                        <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['calls_job_market'])&& $arr_data['member_detail']['calls_job_market'] !=""  ?ucfirst($arr_data['member_detail']['calls_job_market']):'NA' }} </div></h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
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
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6">
                        <h3>
                           <span 
                              class="text-" 
                              ondblclick="scrollToButtom()"
                              style="cursor: default;" 
                              title="Double click to Take Action" 
                              >
                           </span>
                        </h3>
                     </div>
                     <div class="col-md-6">
                     </div>
                  </div>
                  {!! Form::open([ 
                  'method'=>'POST',
                  'enctype' =>'multipart/form-data',   
                  'class'=>'form-horizontal', 
                  'id'=>'validation-form' 
                  ]) !!} 
                  <div class="form-group">
                     <!--  <div class="col-sm-3 text-right">
                        <label class="main-label" >Disk usage</label>
                        </div> -->
                     <div class="col-sm-9">
                        <h4 class="value"> <div class="more">{{ isset($arr_data['member_detail']['calls_job_market'])&& $arr_data['member_detail']['calls_job_market'] !=""  ?ucfirst($arr_data['member_detail']['calls_job_market']):'NA' }} </div></h4>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>


      </div>
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
   function approve_change(val,id) {
   
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var success_link  = "{{url('/')}}/admin/members/upload_approvals";
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/upload_approve_change",
               type: "POST",
               async: false,
               data: { _token:token,approve_status:approve_value,id:approve_id},
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

