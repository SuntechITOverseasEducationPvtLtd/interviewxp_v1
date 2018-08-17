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
    .flipslide {cursor: pointer; }
                        </style>
                       <script> 
$(document).ready(function(){ 
    $(".flipslide").click(function(){
        $thid=$(this).attr('id');
        alert($thid);
        $(".flipslidedownal"+$thid).slideToggle("slow");
    });
});
</script>
            <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat">
            <div class="panel-heading">
              <h5 class="panel-title"><i class=" icon-add-to-list" style="color: #13c0b2;
    font-size: 25px;"></i> {{ isset($page_title)?$page_title:"" }}</h5>
              <div class="heading-elements">
                  
                  <a href="{{ $module_url_path }}/total-payments" class="pull-right label bg-success-400" style="font-size: 14px;color:#fff; margin-top: 8px;"><h3 class="pull-right" style="padding: 0px;
    margin: 0px;
    font-size: 14px;">{{ date('j M, Y, g:i A T', strtotime($fromdate))}} - {{ date('j M, Y, g:i A T', strtotime($todate))}}</h3></a>
                  
                  
              
                      </div>
            </div>

  
    
        <div class="box-content">
            
            
            
 
        
          @include('admin.layout._operation_status')  

         
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

<table class="datatable table table-striped table-bordered">
              <thead>
                 <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                    
                     <th>S.No</th>
                     <th>Name</th>
                     <th>Gender</th>
                     <th>Mob No</th>
                     <th>Email</th>
                     <th>No.of Skills</th>
                     <th>Amount</th>
                     <th>IGST</th>
                     <th>CGST</th>
                     <th>SGST</th>
                     <th>Amount+Tax</th>                     
                     <th>Admin Commission</th>
					 <th>Member Earnings</th>
                     <th>TDS</th>
                     <th>Income After Tax</th>
                     <th>Payment Action</th>
                     <th>View</th>
                </tr>
              </thead>
              <tbody>
          @if(isset($arr_transaction) && sizeof($arr_transaction)>0)
                  @foreach($arr_transaction  as $key => $data)
                  <tr>
                    
                     <td>{{$key+1}}</td>
                     <td>
                         <div style="    width: 150px;">
                         
                         <a href="{{url('/admin/transactions/member-payments/'.base64_encode($data['member_user_id']).'/'.base64_encode($fromdate).'/'.base64_encode($todate))}}">{{ $data['member_detail']['first_name'].' '.$data['member_detail']['last_name']}}</a>
                         
                         </div>
                         </td>
                     <td>
                         
                         
                         
                          
                          @if($data['member_detail']['gender']=='F')
                          Female
                          @elseif($data['member_detail']['gender']=='M')
                          Male 
                          @endif 
                     </td>
                     <td> {{ $data['member_detail']['mobile_no'] or 'NA' }}</td>
                     <td>{{ $data['member_detail']['email'] or 'NA' }}</td>
                     <td>{{ $data['all_interview_detail'][0]['no_of_skills'] or 'NA' }}</td>
                     <td>{{ number_format($data['base_price'],2) }}</td>
                     <td>{{ number_format($data['igst_amount'],2) }}</td>
                     <td>{{ number_format($data['cgst_amount'],2) }}</td>
                     <td>{{ number_format($data['sgst_amount'],2) }}</td>
                     <td>{{ number_format($data['grand_total'],2) }}</td>
                     <td>{{ number_format($data['admin_amount'],2) }}</td>
					 <td>{{ number_format($data['member_amount'],2) }}</td>
                     <td>{{ number_format($data['member_tax_amount'],2) }}</td>
                     <td>{{ number_format($data['after_tax_amount'],2) }}</td>
                     @if($data['end_date']>$currentdate && $data['member_payment_status']=='Dont Pay')
                     <td><button class="btn btn-warning" type="button" >Pending</button></td>
                     @endif
                     @if($data['end_date']<$currentdate && $data['member_payment_status']=='Pay')
                     <td><a href="javascript:member_payment('{{base64_encode($data['id'])}}','{{base64_encode($data['member_user_id'])}}','{{base64_encode($fromdate)}}','{{base64_encode($todate)}}')"><button class="btn btn-primary" type="button" >Pay</button></a></td>
                     @endif
                     @if($data['member_payment_status']=='Paid')
                     <td>
                         
                         <button class="btn btn-success" type="button" >Paid</button>
                     
                     
                     
                     </td>
                     
                     
                     @endif
                       <td>
                         
                       <span> 
                      <a style="padding: 1px 3px;" href="{{url('/admin/transactions/member-payments/'.base64_encode($data['member_user_id']).'/'.base64_encode($fromdate).'/'.base64_encode($todate))}}" class="admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span>
                     
                     
                     
                     </td>
                  </tr>
                  @endforeach
                  @endif
              </tbody>
            </table>
          </div>
        <div> </div>

      </div>
  </div>
</div>
  <!-- Modal -->
<div class="modal fade" id="member_payments_modal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                     Member Payment
                </h4>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                
               {{ Form::open(array('url'=>'','method'=>'post', 'id'=>'form_member_payment')) }}
                  <div class="form-group">
                    {{ csrf_field() }}
                    {!! Form::text('RefId', null,['required','class'=>'form-control','id'=>'refId','placeholder'=>'Enter Refference ID']) !!}                    
                  </div>
                    <div class="form-group">
                    {!! Form::hidden('inputId', null,['class'=>'form-control','id'=>'inputId']) !!}
                    {!! Form::hidden('transId', null,['class'=>'form-control','id'=>'transId']) !!}
                    {!! Form::hidden('fd', null,['class'=>'form-control','id'=>'fd']) !!}
                    {!! Form::hidden('td', null,['class'=>'form-control','id'=>'td']) !!}
                    {!! Form::textarea('inputComment', null, array('required','class'=>'form-control','placeholder'=>'Enter Comment', 'cols'=>2,'rows'=>2)) !!}
                    </div>
                  <div class="form-group">
                    {!! Form::file('payment_img', null,['class'=>'form-control','id'=>'inputInterviewId']) !!}                    
                  </div>
                  <div class="form-group">
                    {!! Form::submit('submit', array('class'=>'btn btn-primary', 'id'=>'btn_admin_comment')) !!}
                  </div>
                {{ Form::close() }}            
            </div>
         
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

    function member_payment(transId,id,fd,td) {

          $('#member_payments_modal').modal('show');
          $('#inputId').val(id);
          $('#transId').val(transId);
          $('#fd').val(fd);
          $('#td').val(td);
          var url = "{{url('/')}}/admin/transactions/pay-member-payment";
          $('#form_member_payment').attr('action',url);
        return false;   
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