    @extends('admin.layout.master')                
    @section('main_content')
    <!-- BEGIN Page Title -->
 <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}   </h5>
              <div class="heading-elements">
            
          
          
          <a href="#" class="pull-right label bg-success-400" style="font-size: 14px;color:#fff; margin-top: 8px;"><h3 class="pull-right" style="padding: 0px;
    margin: 0px;
    font-size: 14px;">   <?php  $careersname = DB::table('career')->where('id',$arr_dataid)->get(); print_r($careersname[0]->jobtitle); ?> </h3></a>
    
    
    
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
                  <th>Date</th> 
                  <th>Name</th> 
                 <th>Mobile.No</th>
   <th>DOB</th>

<th>Gender</th>


<th>Location</th>



                  <th>Total Experience</th>

<th>Duration</th>


                   <th>Designation</th>
                  <th>Annual Salary</th>
                  
                 
               
                  
                  <th>Resume</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
          
                @if(isset($arr_data) && sizeof($arr_data)>0)
                  @foreach($arr_data as $key=> $data)

                  <tr>
                    <td> 
                      <input type="checkbox" 
                             name="checked_record[]"  
                             value="{{ base64_encode($data['id']) }}" /> 
                    </td>
                    <td>{{$key+1}}</td>
                    <td>{{ date(' d  M, Y' ,strtotime($data['created_at'])) }}</td> 
                    <td>{{ $data['first_name'] }} </td> 
               <td>{{$data['mobile_no'] or 'NA'}}</td>

 <td>{{$data['birth_date'] or 'NA'}}</td>

 <td>@if($data['gender']=="M")Male @else Female @endif</td> 

<td><?php $locationsd=explode(',',$data['current_work_location']); ?> {{ $locationsd[0] or 'NA'}}</td>


                    <td>
                    <?php $exp_year  = $data['experience_years'];
                          $exp_month = $data['experience_month'];
                      ?>
                      @if(isset($exp_year) && isset($exp_month))
                      {{ $exp_year.' Years '.$exp_month.' Month'}}  
                      @else NA
                      @endif 
                    </td>


 <td>    <?php  $start_month = $data['start_month']; 
                               $start_year  =  $data['start_year'];
                               $end_month   =  $data['end_month'];
                               $end_year    =  $data['end_year'];
                        ?>
                           @if(isset($start_month) && $start_month !="" && isset($start_year) && $start_year !="" && isset($end_month) && $end_month !="" && isset($end_year) && $end_year !="")

                           @if($start_month=='1')Jan  @endif
                           @if($start_month=='2')Feb  @endif
                           @if($start_month=='3')Mar  @endif
                           @if($start_month=='4')Apr  @endif
                           @if($start_month=='5')May  @endif
                           @if($start_month=='6')Jun  @endif
                           @if($start_month=='7')Jul  @endif
                           @if($start_month=='8')Aug  @endif
                           @if($start_month=='9')Sep  @endif
                           @if($start_month=='10')Oct @endif
                           @if($start_month=='11')Nov @endif
                           @if($start_month=='12')Dec @endif
                           {{$start_year}}

                           @if($start_month !="")
                           <lable> To </lable>
                           @endif

                           @if($end_month=='1')Jan  @endif
                           @if($end_month=='2')Feb  @endif
                           @if($end_month=='3')Mar  @endif
                           @if($end_month=='4')Apr  @endif
                           @if($end_month=='5')May  @endif
                           @if($end_month=='6')Jun  @endif
                           @if($end_month=='7')Jul  @endif
                           @if($end_month=='8')Aug  @endif
                           @if($end_month=='9')Sep  @endif
                           @if($end_month=='10')Oct @endif
                           @if($end_month=='11')Nov @endif
                           @if($end_month=='12')Dec @endif
                           @if($end_month=='13')Present @endif
                               @if($end_month!='13') {{$end_year}} @endif
                           @else NA
                           @endif 
                    </td>



                  
                    <td>{{$data['designation'] or 'NA'}}</td>
                    <td>{{$data['annual_salary'] or 'NA'}}</td>
                    
                   
                   
                   
                    <td>
                    @if($data['resume'] !="")
                     <a href="{{url('/')}}/uploads/career_resume/{{$data['resume']}}" download=''       class="myc btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" >
                         <i class="icon-download" aria-hidden="true"></i>
                         
                         </a>
                     @else
                      NA
                     @endif </td>
                    <td><div style="width:80px;">
                    <div class="forleft">
                      <span> <a href="{{ $module_url_path.'/view/'.base64_encode($data['id']) }}" class="myc admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span> <p class="myp">View</p></div>
                        
                        <div class="forleft">
                      <span><a href="{{ $module_url_path.'/delete/'.base64_encode($data['id']) }}" onclick="return confirm_delete();" class="myc admin-button-icons call_loader btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                         <i class="icon-trash" title="Delete"></i> 
                        </a> </span> <p class="myp">Del</p></div>
                        
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


