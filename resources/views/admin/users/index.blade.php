@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
  <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                          <li><a data-action="close"></a></li>
                        </ul>
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
         <div class="btn-toolbar pull-right clearfix">
            <div class="btn-group" style="visibility:hidden;">
               <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records call_loader">Add New {{ str_singular($module_title) }}</a> 
            </div>
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
            <div class="btn-group"> 
               <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip call_loader" 
                  title="Refresh" 
                  href="{{ $module_url_path }}"
                  style="text-decoration:none;">
               <i class="fa fa-repeat"></i>
               </a> 
            </div>
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
                     <th>S.No</th>
                     <th>Registered Date</th>
                     <th>Name</th>
                     <th>Email ID</th>
                     <th>Gender</th>
                     <th>PH.No</th>
                     <th>Location</th>
                     <th>A/C Status</th>
                     <th>Admin Comments</th>
                     <th>Action</th>
                     <th>Deactivated</th>
                     <th>Status</th>
                     <th>A/C Activation</th>
                    
                  </tr>
               </thead>
               <tbody>
                <?php $i=1; ?>
                  @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $data)
                  <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data['id']) }}" /> 
                     </td>
                     <td>{{$i++}}</td>
                     <td>{{ date(' d  M, Y' ,strtotime($data['created_at'])) }}</td> 
                     <td> {{ $data['first_name']." ".$data['last_name'] }} </td>
                     <td> {{ $data['email'] or 'NA'}} </td>
                     <td>  @if($data['gender']=='M')Male @endif
                           @if($data['gender']=='F')Female @endif
                     </td>
                     <td> {{ $data['mobile_no'] or 'NA' }}</td>
                     <td> 
                         @if($data['user_profile']['country_id']!=358 && $data['user_profile']['country_id']!=0)
                           {{$data['user_profile']['country_name'].", ".$data['user_profile']['other_city']}}
                         @elseif($data['user_profile']['country_id']==358)
                           {{$data['user_profile']['country_name'].", ".$data['user_profile']['city']}}  
                         @elseif($data['user_profile']['country_id']==0) 
                            NA 
                         @endif   
                     </td>
                       <?php $status = $data['admin_status']; ?>
                      <td style="font-weight:bold;color:@if($status=='Approved')green @elseif($status=='Denied')red @elseif($status=='Pending')#0090ff @endif">{{$status or 'NA'}}</td>

                      <td><a href="{{ $module_url_path.'/comment/'.base64_encode($data['id']) }}">
                          <i class="fa fa-comments" aria-hidden="true"></i></a></td>

                       <td> 
                         <a href="{{ $module_url_path.'/details/'.base64_encode($data['id']) }}" class="call_loader">
                        <i class="glyphicon glyphicon-eye-open" title="Details" ></i>
                        </a>    
                        <!-- &nbsp;
                        <a href="{{ $module_url_path.'/edit/'.base64_encode($data['id']) }}" class="call_loader">
                        <i class="fa fa-edit" title="Edit" ></i>
                        </a>   -->
                        &nbsp;  
                        <a href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}"  
                           onclick="return confirm_delete();" class="call_loader">
                        <i class="fa fa-trash" title="Delete" ></i>  
                        </a>    
                     </td> 
                     <td>
                      @if($data['is_deactivate']==1)
                      Yes
                      @else
                      No
                      @endif
                     </td>   
                     <td>
                        @if($data['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data['id']) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm('Are you sure to Deactivate this record?')"><i class='fa fa-unlock'></i></a>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data['id']) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm('Are you sure to Activate this record?')"><i class='fa fa-lock'></i></a>
                        @endif
                     </td>
                      
                       <td>
        
                    <select name="approve_status" class="form-control" onchange="return approve_change(this.value,{{$data['id']}}) ">
                        <option @if($data['admin_status']=='Pending') selected="" @endif value="Pending">Pending</option>
                        <option @if($data['admin_status']=='Approved') selected="" @endif value="Approved">Approved</option>
                        <option @if($data['admin_status']=='Denied') selected="" @endif value="Denied">Denied</option>
                    </select>
                    </td>
                  </tr>
                  @endforeach
                  @endif
               </tbody>
            </table>
         </div>
         <div> </div>
         {!! Form::close() !!}
      </div>
   </div>
</div>
<!-- END Main Content -->
<script type="text/javascript">
   $(document).ready(function() {
       $('#table_module').DataTable( {
           "aoColumns": [
           { "bSortable": false },
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
<script>
function approve_change(val,id) {

      if(confirm('Are you sure to perform this action?'))
      {         
            var token         = $('input[name=_token]').val();
            var approve_id    = id;
            var approve_value = val;
            var success_link  = "{{url('/')}}/admin/users";
            //alert(approve_value);
            $.ajax({
            url: "{{url('/')}}/admin/users/approve_change",
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

