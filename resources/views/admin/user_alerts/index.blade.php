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

          <div class="btn-group" style="visibility:hidden">
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
              <div class="btn-group" style="margin-right: 18px;"> 
                <a class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom call_loader" 
                   title="Refresh" 
                   href="{{ $module_url_path }}"
                   style="text-decoration:none;">
                   <i class=" icon-database-refresh"></i>
                </a> 
              </div>
              <br>
          </div>
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0; overflow: auto; width: 100%">
            <input type="hidden" name="multi_action" value="" />
           <table class="datatable table table-striped table-bordered">
              <thead>
                <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                  <th style="width:18px">
                     <input type="checkbox" name="mult_change" id="mult_change" />
                  </th>
                  <th>S.No</th> 
                  <th>A/C Type</th>
                  <th>Name</th>
                  <th>Email ID</th>
                  <th>Gender</th>
                  <th>PH.No</th>
                  <th>Exp Level</th>
                  <th>Skill</th>
                  <th>Status</th>
                  <th>Registerd On</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php $i=1; ?>
                @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $data)

                  <?php if($data['user_type']=='User') { $updatesin='info';}  else{ $updatesin='success'; } ?>
                  <tr>
                    <td> 
                      <input type="checkbox" 
                             name="checked_record[]"  
                             value="{{ base64_encode($data['alert_id']) }}" /> 
                    </td>
                    <td>{{$i++}}</td> 
                    <td><span class="label label-{{ $updatesin }}">{{ $data['user_type'] or 'NA' }}</span></td>
                    <td>{{ $data['user_details']['first_name'].' '.$data['user_details']['last_name'] }}</td>
                    <td>{{ $data['user_details']['email'] or 'NA' }}</td>
                    <td>@if($data['user_details']['gender']=="M")Male @else Female @endif</td> 
                    <td>{{ $data['user_details']['mobile_no'] or 'NA' }}</td>
                    <td>{{ $data['exp_level'].'   years' }}</td>
                    <td>{{ $data['skills'][0]['skill_name'] or 'NA' }}</td>
                    <td>
                      @if($data['is_active']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($data['alert_id']) }}" class="myc btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                        onclick="return confirm('Are you sure to Deactivate this record?')"><i class='icon-unlocked'></i></a>     <p class="myp">Lock</p>
                      @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($data['alert_id']) }}" class="myc btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" 
                        onclick="return confirm('Are you sure to Activate this record?')"><i class=' icon-lock'></i></a>     <p class="myp">Unlock</p>
                      @endif

                    </td>
                    <td>{{ date('d M,Y',strtotime($data['created_at'])) }}</td>
                   
                    <td> 
                        <a href="{{ url($admin_panel_slug.'/alerts/details/'.base64_encode($data['alert_id'])) }}" class="myc call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                            <i class="icon-zoomin3" title="View" ></i>
                        </a>
                        <p class="myp">View</p>
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
            { "bSortable": true }
            
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


