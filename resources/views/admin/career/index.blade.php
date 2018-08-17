    @extends('admin.layout.master')                
    @section('main_content')
    <!-- BEGIN Page Title -->
 <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
 <h5 class="panel-title" style="width: 50%;"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i><a href="{{ url($admin_panel_slug.'/career/all')}}">Manage Job Application</a></h5>
              <div class="heading-elements" style="width: 50%;">
               
               
               <div class="col-md-2" style="float:right">
               <p style="
    float: left;
    line-height: 56px;
    font-weight: bold;
"> Draft </p> <a href="{{ url($admin_panel_slug.'/career/1')}}" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Total Draft" style="
    margin-top: 10px;
    float: left;
    margin-left: 5px; font-weight: bold; width: 32px;
"><?php $draftc = DB::table('career')->where('status','1')->count();  ?> {{ $draftc }}</a>
                
                </div>
                
                
                
                      
               <div class="col-md-2" style="float:right">
               <p style="
    float: left;
    line-height: 56px;
    font-weight: bold;
"> Live </p> <a href="{{ url($admin_panel_slug.'/career/3')}}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Total Live" style="
    margin-top: 10px;
    float: left;
    margin-left: 5px; font-weight: bold; width: 32px;
"><?php $draftc = DB::table('career')->where('status','3')->count();  ?> {{ $draftc }}</a>
                
                </div>
                
                
                
                
                      
               <div class="col-md-2" style="float:right">
               <p style="
    float: left;
    line-height: 56px;
    font-weight: bold;
"> Off </p> <a href="{{ url($admin_panel_slug.'/career/2')}}" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Total Off" style="
    margin-top: 10px;
    float: left;
    margin-left: 5px; font-weight: bold; width: 32px;
"><?php $draftc = DB::table('career')->where('status','2')->count();  ?> {{ $draftc }}</a>
                
                </div>
                
                
                
                
                
                
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

           <table class="datatable table table-striped table-bordered">
              <thead>
                 <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                
                  <th>S.No</th>
                  <th>Posted Date</th> 
                  <th>Profile</th> 
                  <th>Application</th>
                  <th>Status</th>
                  <th>Action</th>
                 
                </tr>
              </thead>
              <tbody>
          
                @if(isset($arr_data) && sizeof($arr_data)>0)
                
                  @foreach($arr_data as $key=> $data)

                  <tr>
                  
                    <td>{{$key+1}}</td>
                    <td><div style="width:120px;">{{ date(' d  M, Y' ,strtotime($data['created_at'])) }}</div></td> 
                    <td>{{ $data['jobtitle'] }} </td> 
                    <td> 
                    
                    <a href="{{ $module_url_path.'/application/'.base64_encode($data['id']) }}" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style="
 font-weight: bold;
    width: 25px;
    float: left;
    height: 25px;
    padding: 1px 0px;
    margin-right: 6px;
}
" data-popup="tooltip"  data-original-title="View Applications"> <?php $jobids=$data['id']; $careermaster = DB::table('career_master')->where('postid',$jobids)->count();  ?> {{ $careermaster }}</a>



<a href="{{ $module_url_path.'/application/'.base64_encode($data['id']) }}" data-popup="tooltip"  data-original-title="View Applications" >  Application</a></td>
                    <td>
                        <?php if($data['status']==1) { ?>
                        <span class="label bg-grey-400" style="width:70px; text-align:center">Draft</span>
                        <?php } elseif($data['status']==2) { ?>
                        <span class="label bg-danger" style="width:70px; text-align:center">Off</span>
                        <?php } else { ?>
                        <span class="label label-success" style="width:70px; text-align:center">Live</span>
                        <?php } ?>
                        
                    </td>
                    <td><div style="width:160px;">
                    <div class="forleft">
                      <span> <a href="{{ $module_url_path.'/live/'.base64_encode($data['id']) }}" class="myc admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class="icon-checkmark4"  data-popup="tooltip"  data-original-title="Live"></i>
                        </a>  </span> <p class="myp">Live</p>
                        </div>
                        
                       <div class="forleft"> 
                      <span><a href="{{ $module_url_path.'/off/'.base64_encode($data['id']) }}" onclick="return confirm_off();" class="myc admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-blocked" title="Off" data-popup="tooltip"  data-original-title="Off"></i> 
                        </a> </span> <p class="myp">Off</p>
                        </div>
                        
                        <div class="forleft">
                        <span> <a data-popup="tooltip"  data-original-title="Edit" href="{{ $module_url_path.'/edit/'.base64_encode($data['id']) }}" class="myc admin-button-icons call_loader btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                      <i class=" icon-pencil7" title="Edit"></i>
                        </a>  </span> <p class="myp">Edit</p>
                        </div>
                        
                        <div class="forleft">
                        <span><a data-popup="tooltip"  data-original-title="Delete" href="{{ $module_url_path.'/deletepost/'.base64_encode($data['id']) }}" onclick="return confirm_delete();" class="myc admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" ></i> 
                        </a> </span> <p class="myp">Del</p>
                        </div>
                        
                        
                        
                     </div>
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
    
    
     function confirm_off()
    { 
       if(confirm('Are you sure to Off this Post?'))
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


