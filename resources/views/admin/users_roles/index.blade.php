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
                                 'class'=>'form-horizontal call_loader', 
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

          
         
          
           <div class="btn-group">
          <a href="{{ $module_url_path.'/create' }}" class="btn btn-primary btn-add-new-records class_loader" title="Add Admin Users">Add {{ str_singular($module_title) }}</a> 
          </div>
  
      
            <div class="btn-group"> 
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip " 
                   title="Refresh" 
                   href="javascript:void(0)"
                   onclick="javascript:location.reload();" 
                   style="text-decoration:none;">
                   <i class="fa fa-repeat"></i>
                </a> 
            </div>
          </div>
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0; ">

            <input type="hidden" name="multi_action" value="" />

       <table class="datatable table table-striped table-bordered">
              <thead>
             <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                  <th>Id</th>
                  <th>Role Name</th>
                 
                     <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
          
                @if(sizeof($obj_users)>0)
                  @foreach($obj_users as $user)
                 
                <tr>
                       
                         <td >
                            {{ $user['id']}}
                        </td> 
                     
                       <td >
                            {{ $user['rolename']}}
                        </td>
                        
                        
                         <td >
                         <span class="lock-btn">
                        @if($user['status']==1)
                        <a href="{{ $module_url_path.'/deactivate/'.base64_encode($user['id']) }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc" 
                        onclick="return confirm('Are you sure to Deactivate this record?')"><i class='icon-unlocked'></i></a> <p class="myp">Lock</p>
                        @else
                        <a href="{{ $module_url_path.'/activate/'.base64_encode($user['id']) }}" 
                        class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc" onclick="return confirm('Are you sure to Activate this record?')"><i class='icon-lock'></i></a>
                        <p class="myp">Unlock</p>
                        @endif
                        </span>
                                                
                        </td>
                        
                        
                     <td class="ac-icons"> 
                     <div class="forleft">
                        <span> <a href="{{ url($module_url_path.'/view')."/".base64_encode($user['id']) }}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                         <p class="myp">View</p>
                         </div>
                         
                        &nbsp;<div class="forleft">
                        <span> <a href="{{ url($module_url_path.'/edit')."/".base64_encode($user['id']) }}" class="admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom myc">
                      <i class=" icon-pencil7" title="Edit"></i>
                        </a>  </span>
                       <p class="myp">Edit</p>
                       </div>
                        &nbsp;  <div class="forleft">
                        <span><a href="{{ url($module_url_path.'/delete')."/".base64_encode($user['id']) }}" onclick="return confirm_delete();" class="myc admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                         
                        </a> </span>
                           <p class="myp">Del</p>
                   </div>
                     </td>
                        
                        
                        
                      </tr>
                    
                  @endforeach
                @endif
                 
              </tbody>
            </table>
          </div>
        <div> </div>
         
          </form>
      </div>
  </div>
</div>

<!-- END Main Content -->
<script type="text/javascript">
    function show_details(url)
    { 
       
        window.location.href = url;
    } 

    
    function confirm_delete()
    {
       if(confirm('Are you sure ?'))
       {
        return true;
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


