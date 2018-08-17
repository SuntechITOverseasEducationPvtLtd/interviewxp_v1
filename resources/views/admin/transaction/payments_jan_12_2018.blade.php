@extends('admin.layout.master')
    @section('main_content')
    <!-- BEGIN Page Title -->
     <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/data-tables/latest/dataTables.bootstrap.min.css">
    <div class="page-title">
        <div>

        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{ url($admin_panel_slug.'/dashboard') }}" class="call_loader">Dashboard</a>
            </li>
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                <i class="fa fa-credit-card"></i>
                <a href="{{ $module_url_path }}/payments" class="call_loader">{{ $module_title or ''}}</a>
            </span> 
            <span class="divider">
                <i class="fa fa-angle-right"></i>
                  <i class="fa fa-list"></i>
            </span>
            <li class="active">{{ isset($page_title)?$page_title:"" }}</li>
        </ul>
      </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">

          <div class="box {{ $theme_color }}">
            <div class="box-title">
              <h3>
                <i class="fa fa-list"></i>
                {{ isset($page_title)?$page_title:"" }}
            </h3>
            <div class="box-tool">
                <a data-action="collapse" href="#"></a>
                <a data-action="close" href="#"></a>
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
                  href="{{ $module_url_path.'/payments'}}"
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
                     <th>Member Email Id</th>
                     <th>Description</th>
                     <th>Exp Level</th>
                     <th>Sold Date</th>
                     <th>Total Amount</th>
                     <th>Member Earnings</th>
                     <th>Member Tax</th>
                     <th>After Tax</th>
                     <th>Action</th>
                     <th>Payment Mode</th>
                     <th>Admin Comments</th>
                     
                </tr>
              </thead>
              <tbody>
          @if(isset($arr_transaction) && sizeof($arr_transaction)>0)
                  @foreach($arr_transaction  as $key => $data)
                  <tr>
                    <td>
                      <input type="checkbox" 
                           name="checked_record[]"  
                           value="{{ base64_encode($data['id']) }}" /> 
                    </td>
                     <td>{{$key+1}}</td>
                     <td>{{ $data['member_detail']['email'] or 'NA' }}</td>
                     <td>
                       @if(isset($data['purchase_history'][0]['reference_book']) && $data['purchase_history'][0]['reference_book']=='Yes')
                       {{$data['skill_name']}} Interview Book
                       <br>
                       @endif 
                       {{$data['interview_count']}} Company's Q & A
                       @if(isset($data['ticket_name']) && $data['ticket_name']!='')
                       <br>{{$data['ticket_name']}} Rwe Tickets
                       @endif
                     </td>
                     <td>{{ $data['experience_level'] or 'NA' }}</td>
                     <td>{{date('d M Y', strtotime($data['created_at']))}}</td>
                     <td>Rs.{{ $data['grand_total'] or 'NA' }}</td>
                     <td>Rs.{{ $data['member_amount'] or 'NA' }}</td>
                     <td>Rs.{{ $data['member_tax_amount'] or 'NA' }}</td>
                     <td>Rs.{{ $data['after_tax_amount'] or 'NA' }}</td>
                     @if($data['end_date']>$currentdate && $data['member_payment_status']=='Dont Pay')
                     <td><a href="javascript:void(0);"><button class="btn" type="button" style="color:red;">Dont Pay</button></a></td>
                     @endif
                     @if($data['end_date']<$currentdate && $data['member_payment_status']=='Pay')
                     <td><a href="{{ $module_url_path.'/updatepayment/'.base64_encode($data['id']) }}"><button class="btn" type="button" style="color:blue;">Pay</button></a></td>
                     @endif
                     @if($data['member_payment_status']=='Paid')
                     <td><a href="javascript:void(0);"><button class="btn" type="button" style="color:green;">Paid</button></a></td>
                     @endif

                     <td>Bank Transfer</td>
                     <td><a href="{{ $module_url_path.'/comment/'.base64_encode($data['id']) }}">
                         <i class="fa fa-comments" aria-hidden="true"></i></a></td>
                      
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
           { "bSortable": false },
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
@stop