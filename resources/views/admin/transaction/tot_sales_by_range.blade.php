@extends('admin.layout.master')
    @section('main_content')
    <!-- BEGIN Page Title -->
   <!-- BEGIN Page Title -->

<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<style>.table {
    width: 99.7%;
    max-width: 100%;
    margin-bottom: 20px;
}

.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 0px 0;
    border-radius: 3px;
    float: right;
    position: absolute;
    
    right: 12px;
}


</style>
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
         
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0">

            <input type="hidden" name="multi_action" value="" />

        <table class="datatable table table-striped table-bordered">
              <thead>
                 <tr class="bg-teal-400" style="    background-color: #26A69A !important;    border-color: #26A69A !important;">
                    
                     <th>S.No</th>
             <th>Month</th> 
                     <th>Month Wise Sales</th>
					 <th>Sales Amount</th>
                     <th>Igst</th>
                     <th>Cgst</th>
                     <th>Sgst</th>
                     <th>Affiliate Commission</th>
					 <th>Company Commission</th>
                     <th>Member Payments</th>                     
                     <th>View</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($entries) && sizeof($entries)>0)
                  <?php $i=0; ?>
                  @foreach($entries  as $key => $data)
                  <?php $i=$i+1; ?>
                  <tr>
                   
                     <td> 
                         {{$i}}
                     </td>
                     <td> 
                         
                         
                         <span class="label bg-blue"><?php $month=explode("-",$data[2]);  echo $month[1];?></span>
                     </td>
                     <!-- <td > IE0000{{ $data['id'] or 'NA' }} </td> -->

                     <td style="line-height: 36px;float: left;width: 425px;"> 
                     
                     <a href="{{url('/admin/transactions/sales/'.base64_encode($data[0]).'/'.base64_encode($data[1]))}}" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style="float: left;"><i class=" icon-calendar52"></i></a>
                     
                     
                     
                     
                     
                     &nbsp;&nbsp;&nbsp;
                     <a href="{{url('/admin/transactions/sales/'.base64_encode($data[0]).'/'.base64_encode($data[1]))}}">
                     
                     {{$data[2]}} </a></td>
					 
					 <td> 
					 {{ number_format($data[3],2) }}
                     </td>
					 <td> 
					 {{ number_format($data[5],2) }}
                     </td>
					 <td> 
					 {{ number_format($data[6],2) }}
                     </td>
					 <td> 
					 {{ number_format($data[7],2) }}
                     </td>
					 <td> 
					 0.00
                     </td>
					 <td> 
					 {{ number_format($data[8],2) }}
                     </td>					 
					 <td> 
					 {{ number_format($data[9],2) }}
                     </td>
					 
                     <td> 
                        <span> <a href="{{url('/admin/transactions/sales/'.base64_encode($data[0]).'/'.base64_encode($data[1]))}}" class="myc admin-button-icons call_loader btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom">
                        <i class=" icon-zoomin3" title="View"></i>
                        </a>  </span> <p class="myp">View</p>
                     </td>
                  </tr>
                  @endforeach

                @endif
              </tbody>
            </table>
          <!--  /* {!! $entries->render() !!} */ -->
          </div>
        <div> </div>

      </div>
  </div>
</div>
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