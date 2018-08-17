@extends('admin.layout.master')
@section('main_content')

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
                                 'class'=>'form-horizontal', 
                                 'id'=>'frm_manage' 
                                ]) !!}     

          

            <div class="col-md-10">
            

            <div id="ajax_op_status">
                
            </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>
          <div class="btn-toolbar pull-right clearfix">

           
         
          
  
          <div class="btn-group">
          <a href="{{ $module_url_path.'/create' }}" class="btn btn-primary btn-add-new-records class_loader" title="Add Admin Users">Add {{ str_singular($module_title) }}</a> 
          </div>
  
         

            <div class="btn-group"> 
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip call_loader" 
               title="Refresh" 
               href="{{ $module_url_path }}"
               style="text-decoration:none;">
               <i class="fa fa-repeat"></i>
            </a> 
            </div>

          </div>
          <br/>

          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0; margin-top:15px;">

            <input type="hidden" name="multi_action" value="" />

           <table class="datatable table table-striped table-bordered">
              <thead>
                <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                  <th style="width:18px"> S.No</th>
                  <th>Category Name</th>
                  <th>Subject</th>
                  <th>Status</th>
                  <th>Action</th>
                 
                </tr>
              </thead>
              <tbody>
<?php $si=0; ?>
               @foreach($arr_email_template as $page)
        <?php $si++; 
        $mailcategory=$page['mailcategory'];  $templatec = DB::table('tbl_mail_category') ->where(['id'=>$mailcategory])->get(); ?>
         
         
            <tr>
              <td> 
               {{$si}}
              </td>
                <td>    {{$templatec[0]->name}}  </td> 
                <td> {{ $page['subject'] }} </td>  
       

                  <td>
                      @if($page['is_active']==1)
               <a href="{{ $module_url_path.'/deactivate/'.base64_encode($page['id']) }}" class="myc btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" onclick="return confirm('Are you sure?')">
                   <i class='icon-unlocked'></i></a> <p class="myp">Lock</p>
                      @else
                      <a href="{{ $module_url_path.'/activate/'.base64_encode($page['id']) }}" 
                      class="myc btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" onclick="return confirm('Are you sure?')"><i class=' icon-lock'></i></a>
                      <p class="myp">Unlock</p>
                      @endif
                     
                  </td> 
                <td> 
<div class="forleft">
                  <a href="{{ $module_url_path.'/edit/'.base64_encode($page['id']) }}"   title="Edit" class="myc call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" ><i class=" icon-pencil7"></i>
                  </a>    
<p class="myp">Edit</p>
</div>

<div class="forleft">
                         
                          <a href="{{ $module_url_path.'/delete/'.base64_encode($page['id']) }}" onclick="return confirm('Do you really want to delete this record?')" title="Delete" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc"><i class="icon-trash"></i></a>
                          <p class="myp">Del</p></div>
                          
                        <div class="forleft">  
                          
                          <a href="{{ $module_url_path.'/details/'.base64_encode($page['id']) }}" class="myc call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                            <i class="icon-zoomin3" title="View"></i>
                        </a>
                        <p class="myp">View</p>
                        </div>
                        
                          
              </td> 
              </tr>
                                 
                  @endforeach
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
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
            ]

        });
    });
    
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


