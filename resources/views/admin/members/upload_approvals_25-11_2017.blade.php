@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<style type="text/css">
  .pen_status{
     background-color: red;
    border-radius: 50%;
    color: #ffffff;
    display: inline-block;
    font-size: 12px;
    height: 22px;
    margin-top: 1px;
    padding-top: 2px;
    text-align: center;
    width: 22px;
}
</style>
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
      <i class="fa fa-list"></i>
      </span>
      <li class="active">{{ isset($page_title)?$page_title:"" }}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box {{ $theme_color }}">
      <div class="box-title">
         <h3>
            <i class="fa fa-list"></i>
            {{ isset($page_title)?$page_title:"" }}
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
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action_upload_approve" value="" />
            <table class="table table-advance"  id="table_module" >
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
                     <td>{{ $data['experience_level'].' years' }}</td>
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
            </table>
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
   function approve_change(val,id) 
   {
         if(confirm('Are you sure to perform this action?'))
         {         
               var token         = $('input[name=_token]').val();
               var approve_id    = id;
               var approve_value = val;
               var success_link  = "{{url('/')}}/admin/members/upload_approvals";
               //alert(approve_value);
               $.ajax({
               url: "{{url('/')}}/admin/members/upload_approve_admin_change",
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

