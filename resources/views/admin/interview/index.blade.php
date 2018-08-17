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
      <i class="fa fa-file-text-o"></i>
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
         {!! Form::open([ 'url' => $module_url_path.'/multi_action',
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
          <div hidden="" class="btn-group">
          <a  href="{{ url($admin_panel_slug.'/members') }}" class="btn btn-primary btn-add-new-records call_loader">Back</a> 
          </div>
         <div class="btn-toolbar pull-right clearfix">
            <div class="btn-group">
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                  title="Multiple Active/Unblock" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','activate');" 
                  style="text-decoration:none;">
               <i class="fa fa-unlock"></i>
               </a> 
            </div>
            <div class="btn-group">
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                  title="Multiple Deactive/Block" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','deactivate');"  
                  style="text-decoration:none;">
               <i class="fa fa-lock"></i>
               </a> 
            </div>
              <div class="btn-group">
                
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
                   title="Multiple Delete" 
                   href="javascript:void(0);" 
                   onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');"  
                   style="text-decoration:none;">
                   <i class="fa fa-trash-o"></i>
                </a>
              </div>  

             @if(isset($arr_interview) && sizeof($arr_interview)>0)  
            <div class="btn-group"> 
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip call_loader" 
                  title="Refresh" 
                  href="{{ $module_url_path.'/member_interviews/'.base64_encode($arr_interview[0]['member_id']) }}"
                  style="text-decoration:none;">
               <i class="fa fa-repeat"></i>
               </a> 
            </div>
            @endif
            <br>
         </div> 
         <br/>
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action" value="" />
            <table class="table table-advance"  id="table_module" >
               <thead>
                  <tr>
                     <th style="width:18px">
                        <input type="checkbox" name="mult_change" id="mult_change" />
                     </th>
                     <th>Interview</th>
                     <th>Member Name</th>
                     <th>Experience Level</th>
                     <th>Company Name</th>
                     <th>Reference Book</th>
                     <th>Verification</th>
                     <th>status</th>
                     <th>Comment</th>
                     <th>Action</th> 
                  </tr>
               </thead>
               <tbody>
                  @if(isset($arr_interview) && sizeof($arr_interview)>0)
                  @foreach($arr_interview as $interview)
                  <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($interview['id']) }}" /> 
                     </td>
                     <td > {{ $interview['skill_name'] or 'NA' }} Real Time Interview Questions & Answers  </td>
                     <td > {{ $interview['member_personal_details']['first_name'] or 'NA'}} {{ $interview['member_personal_details']['last_name'] or 'NA'}}  </td>
                     <td>{{ $interview['experience_level'] or 'NA' }}</td>
                     <td>{{ $interview['company_name'] or 'NA' }}</td>
                     <td>@if($interview['reference_book']!='')<a href="{{$referencebook_public_path.$interview['reference_book']}}" download='' ><i class="fa fa-download" aria-hidden="true"></i></a>
                     @else
                     NA
                     @endif
                     </td>
                     <td>
                     <!-- @if($interview['admin_pending']==1)
                     Verified
                     @else
                       <a href="{{$module_url_path}}/approve/{{base64_encode($interview['id'])}}" >Approve</a>
                       <hr>
                       <a href="{{$module_url_path}}/reject/{{base64_encode($interview['id'])}}" >Reject</a>
                     @endif   -->
                      <select name="approve_status" class="form-control" onchange="return approve_change(this.value,{{$interview['id']}}) ">
                        <option @if($interview['approve_status']=='0') selected="" @endif value="0">Pending</option>
                        <option @if($interview['approve_status']=='1') selected="" @endif value="1">Approve</option>
                        <option @if($interview['approve_status']=='2') selected="" @endif value="2">Reject</option>
                       </select>
                     </td>
                     <td>
                        <!-- @if($interview['admin_pending']==0)
                          Pending
                        @else
                          @if($interview['admin_verification']==0)
                            Rejected
                          @else
                            Approved
                          @endif
                        @endif    --> 
                      @if($interview['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($interview['id']) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm('Are you sure to Deactivate this record?')"><i class='fa fa-unlock'></i></a>
                      @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($interview['id']) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm('Are you sure to Activate this record?')"><i class='fa fa-lock'></i></a>
                      @endif
                     
                     </td>
                     <td>
                     <a href="{{$module_url_path}}/comment/{{base64_encode($interview['id'])}}" ><i class="fa fa-comments" aria-hidden="true"></i></a>
                       
                     </td>
                     <td>
                       <a href="{{ $module_url_path.'/details/'.base64_encode($interview['id']) }}" class="call_loader">
                        <i class="glyphicon glyphicon-eye-open" title="Details" ></i>
                        </a>  
                     
                        &nbsp;  
                      <a href="{{ $module_url_path.'/delete/'.base64_encode($interview['id'])}}"  
                        onclick="return confirm_delete();" class="call_loader">
                          <i class="fa fa-trash" title="Delete" ></i>  
                      </a>    
                     </td>
                     {{-- <td>
                        @if($data['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data['price_id']) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm('Are you sure to Deactivate this record?')"><i class='fa fa-unlock'></i></a>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data['price_id']) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm('Are you sure to Activate this record?')"><i class='fa fa-lock'></i></a>
                        @endif
                     </td>
                     <td> 
                        <a href="{{ $module_url_path.'/edit/'.base64_encode($data['price_id']) }}" class="call_loader">
                        <i class="fa fa-edit" title="Edit" ></i>
                        </a>     
                     </td> --}}
                  </tr>
                  @endforeach
                  @endif
               </tbody>
            </table>
            <input type="hidden" name="member_id" value="{{$member_id}}">
         </div>
         <div> </div>
         {!! Form::close() !!}
      </div>
   </div>
</div>
<!-- END Main Content -->
<script>
function approve_change(val,id) {

      if(confirm('Are you sure to perform this action?'))
      {         
            var member_id     = $('input[name=member_id]').val();   
            var token         = $('input[name=_token]').val();
            var approve_id    = id;
            var approve_value = val;
            var success_link  = "{{url('/')}}/admin/interviews/member_interviews/"+member_id;
            //alert(approve_value);
            $.ajax({
            url: "{{url('/')}}/admin/interviews/approve_change",
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
           { "bSortable": false },
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
     var input_multi_action = jQuery('input[name="multi_action"]');
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
             jQuery('input[name="multi_action"]').val(action);
   
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
@stop

