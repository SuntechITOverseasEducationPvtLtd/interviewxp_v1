@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
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
          <div class="alert alert-danger" id="no_select" style="display:none;">
          </div>
          <div class="alert alert-warning" id="warning_msg" style="display:none;">
          </div>
        </div>
        <div class="btn-toolbar pull-right clearfix">
          <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" 
               title="Refresh" 
               href="javascript:void(0)"
               onclick="javascript:location.reload();" 
               style="text-decoration:none;">
              <i class="fa fa-repeat">
              </i>
            </a> 
          </div>
        </div>
        <br/>
        <div class="table-responsive" style="border:0;overflow-x: hidden;">
          <input type="hidden" name="multi_action" value="" />
        <table class="datatable table table-striped table-bordered">
            <thead>
              <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                <th style="width:18px">Id</th>
                <th>User Id</th>
                <th>Activity</th>
                <th>Module Name</th>
                <th>Action Performed</th>
                <th>Date & Time</th>
                <th>Ip Address</th>
              </tr>
            </thead>
          </table>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
  <!-- END Main Content -->
  @include('admin.layout._operation_status')  
 
  <script type="text/javascript">
    var table_module = false;
    $(document).ready(function()
    {

      $(".chosen_multiselect").each(function()
                                    {
        $(this).chosen({
          placeholder_text_multiple:$(this).attr('data-placeholder_text_multiple'),
          no_results_text: "Oops, nothing found!",
          width: "100%"
        });
      });

      table_module = $('#table_module').DataTable({
        processing: true,
        serverSide: true,
        "paging": true,
        "autoWidth": false,
        "sortable":true,
        "order":[ 0, "desc" ],
        ajax: {
          'url':'{{ $module_url_path.'/get_records'}}',
        }
        , 
        createdRow: function( row, data, dataIndex ) 
        {
          $(row).css('background', '');
        }
        ,        
        columns: [ 
          {
            data: 'built_id', "orderable": true,  "searchable":true, name: 'id'
          }
          ,
          {
            data: 'built_user_id', "orderable": true, "searchable":true, name: 'user_id'
          }
          ,
          {
            data: 'built_activity', "orderable": true,"searchable":true, name: 'activity'
          }
          ,
          {
            data: 'built_module_title', "orderable": true, "searchable":true, name: 'module_title'
          }
          ,
          {
            data: 'built_module_action',"orderable": true, "searchable":true, name: 'module_action'
          },
          {
            data: 'built_date', "orderable": true, "searchable":true, name: 'date'
          }
          ,
          {
            data: 'built_ip_address', "orderable": true, "searchable":true, name: 'ip_address' 
          }

        ]
      });
    });

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
