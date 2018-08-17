
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
                        </style>



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
            <div class="btn-group" style="    float: right;
    margin-right: 29px;">
               <a href="{{ $module_url_path.'/create'}}" class="btn btn-primary btn-add-new-records call_loader">Add New {{ str_singular($module_title) }}</a> 
            </div>
            <div class="btn-group">
               <a class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                  title="Multiple Active/Unblock" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','activate');" 
                  style="text-decoration:none;">
              <i class="icon-unlocked"></i>
               </a> 
            </div>
            <div class="btn-group">
               <a class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                  title="Multiple Deactive/Block" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','deactivate');"  
                  style="text-decoration:none;">
             <i class="icon-lock"></i>
               </a> 
            </div>
             <div class="btn-group"> 
               <a class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                  title="Refresh" 
                  href="{{ $module_url_path }}"
                  style="text-decoration:none;">
               <i class=" icon-database-refresh"></i>
               </a> 
            </div>
            <div class="btn-group">
               <a class="admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                  title="Multiple Delete" 
                  href="javascript:void(0);" 
                  onclick="javascript : return check_multi_action('checked_record[]','frm_manage','delete');"  
                  style="text-decoration:none;">
               <i class="icon-trash"></i>
               </a>
            </div>
           
            <br>
         </div>
         <br/>
         <div class="clearfix"></div>
         <div class="table-responsive" style="border:0">
            <input type="hidden" name="multi_action" value="" />
    <table class="datatable table table-striped table-bordered">
               <thead>
             <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                     <th style="width:18px">
                        <input type="checkbox" name="mult_change" id="mult_change" />
                     </th>
                     <th>S.No</th>
                     <th>Name</th>
                     <th>Details</th>
                     <th>Gender</th>
                     <th>Purchages</th>
                     <th>Email ID</th>
                     <th>PH.No</th>
                     <th>A/C Status</th>
                     <!--<th>Deactivated</th>-->
                   <!--   <th>Admin Comments</th> -->
                     <th style="min-width:210px !important;">Action</th>
                     <th>Admin Comments</th>
                     <!--<th>Status</th>-->
                    <!--  <th>A/C Activation</th> -->
                    
                  </tr>
               </thead>
               <tbody>
                <?php $i=1; $srno=0; ?>
                  @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $data)
                  <?php $srno++;
                    $countryDetails = DB::table('countries')->where('id',$data['user_profile']['country_id'])->first();
                    $stateDetails = DB::table('state')->where('id',$data['user_profile']['state'])->first();
                    $cityDetails = DB::table('city')->where('city_id',$data['user_profile']['current_work_location'])->first();
                    $purchageDetails = DB::table('transaction')->where(['user_id'=>$data['id'], 'payment_status'=>'paid'])->count();
                  ?>
                  <tr>
                     <td> 
                        









                       <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data['id']) }}" /> 
                     </td>
                      <td > {{ $srno }} </td> 
                     <td>
                       <div class="col-sm-12" style="padding: 0px;width: 320px !important;">
 <div class="rounded-box" style="float: left;">
                              <img src="{{url('/')}}/uploads/profile_images/{{ isset($data['profile_image']) ? $data['profile_image'] : 'default.jpg' }}" alt="Photo" class="proimgset">  </div>

  <p class="td-p-line" style="font-size:14px; float: left;"><b>
   



  {{ ucfirst($data['first_name'])." ".ucfirst($data['last_name']) }}</b><br>


<span data-popup="tooltip" title="" data-original-title="DOB" style="    font-size: 12px;
    color: #2196f3;" ><i class=" icon-calendar2" style="    font-size: 12px;"></i> {{date('d M Y',strtotime($data['birth_date']))}}</span>
                              <br>
<i class=" icon-location4" data-popup="tooltip" title="" data-original-title="Location" style="    font-size: 12px;"></i> {{isset($cityDetails->city_name) ? $cityDetails->city_name : ''}}{{isset($stateDetails->state_name) ? ', '.$stateDetails->state_name : ''}}{{isset($countryDetails->country_name) ? ', '.$countryDetails->country_name : ''}}
                            </p>


</div>
                     </td>

                   
                     <td> 
                     
                        <div class="col-sm-12" style="padding: 0px;width: 250px !important;">
                   
                            <p data-popup="tooltip" title="" data-original-title="Education" class="td-p-line" style="    color: #26a69a;"> <i class="icon-graduation" style="    font-size: 12px;"></i> {{$data['user_profile']['qualification']}}{{ isset($data['user_profile']['specialization']) ? ' - '.$data['user_profile']['specialization'] : ''}}</p>
                         
                          
                            
                             <p class="td-p-line" data-popup="tooltip" title="" data-original-title="Activated On" style="font-size: 12px;     color: #43a047;"><i class="icon-user-check" style="    font-size: 12px;"> </i> {{ ($data['activated_at'] != '0000-00-00 00:00:00') ? date("j M, Y, g:i A T",strtotime($data['activated_at'])) : '--------'}}</p> 
                             <p class="td-p-line" data-popup="tooltip" title="" data-original-title="Registered On" style="font-size: 12px;"><i class=" icon-diff-added" style="    font-size: 12px;"></i> {{ ($data['created_at'] != '0000-00-00 00:00:00') ? date("j M, Y, g:i A T",strtotime($data['created_at'])) : '--------'}}</p>
                          </div>
                       
                     </td>
                     <td>  @if($data['gender']=='M')Male @endif
                           @if($data['gender']=='F')Female @endif
                     </td>
                     <td> {{ $purchageDetails }} </td>
                     <td> {{ $data['email'] or 'NA'}} </td>
                     <td> {{ $data['mobile_no'] or 'NA' }}</td>
                       @if($data['is_deactivate']==1)
                       <td><span class="label bg-danger-400">Deactivated</span></td>
                       @else
                       <?php $status = $data['admin_status']; ?>
                       @if($data['is_active']==1)
                       <td ><span class="label bg-success-400">Active</span></td>
                       @else
                       <td ><span class="label bg-grey-400">Block</span></td>

                       @endif
                       @endif

                     <!--  <td><a href="{{ $module_url_path.'/comment/'.base64_encode($data['id']) }}">
                          <i class="fa fa-comments" aria-hidden="true"></i></a></td> -->
                          <!-- <td>
                      @if($data['is_deactivate']==1)
                      Yes
                      @else
                      No
                      @endif
                     </td> -->
                       <td class="ac-icons"> <div class="forleft">
                        <span> <a href="{{ $module_url_path.'/details/'.base64_encode($data['id']) }}" class="myc admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View" ></i>
                        </a>  </span> <p class="myp">View</p></div>
                         
                        &nbsp;<div class="forleft">
                        <span> <a href="{{ $module_url_path.'/edit/'.base64_encode($data['id']) }}" class="myc admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-pencil7" title="Edit"></i>
                        </a>  </span> <p class="myp">Edit</p></div>
                       
                        &nbsp;  <div class="forleft">
                        <span><a href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}"  
                           onclick="return confirm_delete();" class="myc admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span><p class="myp">Del</p> </div>
                           <div class="forleft">
                     <span class="lock-btn">
                        @if($data['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data['id']) }}" class="myc btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                        onclick="return confirm('Are you sure to Deactivate this record?')"><i class='icon-unlocked'></i></a> <p class="myp">Lock</p>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data['id']) }}" class="myc btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                        onclick="return confirm('Are you sure to Activate this record?')"><i class='icon-lock'></i></a> <p class="myp">Unlock</p>
                        @endif
                        </span></div>
                     </td>
                      <?php 
                            $admin_comments_color = $data['admin_comments'] ? 'color: green;' : 'color: #337ab7;';
                         ?>
                     <td>
                         <a href="#" class="myc btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" >

                          <i class="icon-comments" style="{{$admin_comments_color}};cursor: pointer;" title="{{$data['admin_comments']}}" ></i> </a></td>
                      
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

