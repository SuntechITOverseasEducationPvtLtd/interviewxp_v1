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
                <tr>
                  <th style="width:18px">
                     <input type="checkbox" name="mult_change" id="mult_change" />
                  </th>
                  <th>S.No</th>
                  <th>Date</th>
                  <th>A/c Type</th>
                  <th>Name</th>
                  <!-- <th>Member Name</th> -->
                  <th>Email</th>
                  <th>PH.No</th>
                  <th>Gender</th>
                   <th>Description</th> 
                   <th>Exp Level</th>
                  <th>Review</th>
                  <th>Status</th>
                  <th>Message</th>
                  <th style="min-width:140px !important;">Action</th>
                </tr>
              </thead>
              <tbody>
             
                @if(isset($arr_review_rating) && sizeof($arr_review_rating)>0)
                  @foreach($arr_review_rating as $key => $data)

                  <tr>
                    <td> 
                      <input type="checkbox" 
                             name="checked_record[]"  
                             value="{{ base64_encode($data['id']) }}" /> 
                    </td>
                    <td>{{$key+1}}</td>
                    <td>{{ date(' d  M, Y' ,strtotime($data['created_at'])) }}</td> 
                    <td>{{$data['user_role']}}</td>

                   
                    <td> {{ $data['user_details']['first_name'] }} </td> 
                   <!--  <td> {{ $data['interview_details']['user_details']['first_name'] }} </td> -->
                   <td>{{$data['user_details']['email'] or 'NA'}}</td>
                    <td>{{$data['user_details']['mobile_no'] or 'NA'}}</td>
                    
                    <td >@if($data['user_details']['gender']=="M")Male @else Female @endif</td>  
                    <td>{{ $data['interview_details']['skill_name'] }} Real Time Interview Questions & Answers </td>
                    <td>{{$data['interview_details']['experience_level'] or 'NA'}}</td>

                    <td>
                    @for($i=1;$i<=$data['review_star'];$i++)
                          <img src="{{url('/')}}/images/star.png"/>
                    @endfor          
                    @for($i=$data['review_star'];$i<5;$i++)
                          <img src="{{url('/')}}/images/blank_star.png"/>
                    @endfor      
                    </td>

                    <!-- <td>
                      <input type="radio" 
                             name="approve_status[]"
                             id="approve_status-{{$key}}"  
                             value="user" />
                       User
                      <input type="radio" 
                             name="approve_status[]"
                             id="approve_status-{{$key}}"  
                             value="member" />
                       Member
                      <input type="radio" 
                             name="approve_status[]"
                             id="approve_status-{{$key}}"  
                             value="both" />
                      Both               
                    </td> -->
                    
                    <td>
                     @if($data['approve_status']=='pending')
                      Pending
                     @elseif($data['approve_status']=='member')
                      M Displayed
                     @elseif($data['approve_status']=='both' || $data['approve_status']=='user')
                      O Displayed
                     @endif

                    </td>
                    <td>
                        <a href="{{ $module_url_path.'/review_message/'.base64_encode($data['id'])}}" class="call_loader admin-button-icons">
                          <i class="glyphicon glyphicon-eye-open" title="Review Message" ></i>  <p>View</p> 
                      </a>
                    </td>
                    <td class="ac-icons"> 
                     <span> <button   value="user" class="admin-button-icons check-icon"  onclick="return approve_change(this.value,{{$data['id']}})" title="Online"><i class="fa fa-check" aria-hidden="true"></i></button>
                     <p>Online</p></span>
                     
                    <span><button  value="member" class="admin-button-icons member-icn"  onclick="return approve_change(this.value,{{$data['id']}})" title="Member"><i class="fa fa-user" aria-hidden="true"></i></button>
                    <p>Member</p></span>
                    
                    <span><a href="{{ $module_url_path.'/delete/'.base64_encode($data['id'])}}"  
                        onclick="return confirm_delete();" class="call_loader admin-button-icons delete-icn">
                          <i class="fa fa-trash" title="Delete" ></i> <p>Delete</p>
                      </a> </span>
                         
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
<script>
function approve_change(val,id) {

      if(confirm('Are you sure to perform this action?'))
      {         
            var token         = $('input[name=_token]').val();
            var approve_id    = id;
            var approve_value = val;
            var success_link  = "{{url('/')}}/admin/review_rating";
            //alert(approve_value);
            $.ajax({
            url: "{{url('/')}}/admin/review_rating/approve_change",
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


