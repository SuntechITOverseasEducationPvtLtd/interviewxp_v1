
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
            <div hidden="" class="btn-group" style="visibility:hidden">
               <a  href="javascript:void(0)" class="btn btn-primary btn-add-new-records call_loader">Add New </a> 
            </div>

            {{-- <div class="btn-group">
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
            </div> --}}
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
          <table class="datatable table table-striped table-bordered">
               <thead>
                      <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                     <th style="width:18px">
                        <input type="checkbox" name="mult_change" id="mult_change" />
                     </th>
                     <th>Experience Level</th>
                     <th>Coach Price</th>
                     <th>Interview Q & A Price</th>
                     <th>Combo (Coach+Q & A)</th>
                     <th>Company Price</th>
					 <th>5 Companies Price</th>
					 <th>10 Companies Price</th>
					 <th>20 Companies Price</th>
                     <th>Combo (Coach+5 Companies)</th>
                     <th>Training Price</th>
                     <th>25 Ticket Price</th>
                     <th>50 Ticket Price</th>
                     <th>75 Ticket Price</th>
                     <th>Combo (Coach+Work Exp)</th>
                     {{-- <th>Status</th> --}}
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $data)
                  <tr>
                     <td> 
                        <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data['price_id']) }}" /> 
                     </td>
                     <td > {{ $data['exp_level'] or 'NA' }} </td>
                     <td > {{ $data['validity'] or 'NA'}} </td>
                     <td>Rs. {{$data['ref_book_price'] or 'NA' }}</td>
                     <td>Rs. {{$data['combo_coach_interview_qa'] or 'NA' }}</td>
                     <td>Rs. {{ $data['interview_price'] or 'NA' }}</td>
                     <td>Rs. {{ $data['price_for_5_companies'] or 'NA' }}</td>
                     <td>Rs. {{ $data['price_for_10_companies'] or 'NA' }}</td>
                     <td>Rs. {{ $data['price_for_20_companies'] or 'NA' }}</td>
                     <td>Rs. {{ $data['combo_coach_company'] or 'NA' }}</td>
                     <td>Rs. {{ $data['training_price'] or 'NA' }}</td>
                     <td>Rs. {{ $data['price_for_25_ticket'] or 'NA' }}</td>
                     <td>Rs. {{ $data['price_for_50_ticket'] or 'NA' }}</td>
                     <td>Rs. {{ $data['price_for_75_ticket'] or 'NA' }}</td>
                     <td>Rs. {{ $data['combo_coach_realissues'] or 'NA' }}</td>
                     {{-- <td>
                        @if($data['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data['price_id']) }}" class="btn btn-sm btn-success show-tooltip" onclick="return confirm('Are you sure to Deactivate this record?')"><i class='fa fa-unlock'></i></a>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data['price_id']) }}" class="btn btn-sm btn-danger show-tooltip" onclick="return confirm('Are you sure to Activate this record?')"><i class='fa fa-lock'></i></a>
                        @endif
                     </td> --}}
                     <td> 
                      
                        <span> <a href="{{ $module_url_path.'/edit/'.base64_encode($data['price_id']) }}" class="myc admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-pencil7" title="Edit"></i>
                        </a>  </span> <p class="myp">Edit</p>
                        
                        
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
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           { "bSortable": true },
           /*{ "bSortable": true },*/
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

