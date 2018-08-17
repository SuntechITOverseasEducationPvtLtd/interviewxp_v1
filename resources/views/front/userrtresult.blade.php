<div class="table-responsive" style="margin-top: 52px;">
  {{ csrf_field() }}

  		<p style="margin-top: 20px; margin-bottom: -15px" class="show-results">Showing {{($tickets->currentpage()-1)*$tickets->perpage()+1}} to {{($tickets->currentpage()-1) * $tickets->perpage() + $tickets->count()}}
    of  {{$tickets->total()}} results</p>

      <br/>
      <table class="table" style="border: 1px solid #ccc;">
        <thead>
        <tr class="t-head">
          <td>Sl.No</td>
          <td>Checkbox</td>
          <td>Issue Title</td>
          <td></td>
        </tr>
        </thead>
        <tbody>
        <?php
         $checked_values = Session::get('checked_values');
         $realissuesCount = 0;
         $prev_arr_data = '';
         
     	foreach ($checked_values as $key => $value) {
         	if($key != $tickets->currentPage())
         	{
         		$realissuesCount = count($value)+$realissuesCount;
         		if(!empty($value)) $prev_arr_data .= implode(',',$value);
         	}            
     	}
        
         $new_checked_values =  isset($checked_values[$tickets->currentPage()]) ? $checked_values[$tickets->currentPage()] : [];         
          foreach ($tickets as $key=>$ticketsList) {
            if($ticketsList->file_extension =='Pdf'){
               $icon='<i class="fa fa-file-pdf-o"></i>';
               $pages=$ticketsList->pageCount;
             }else if($ticketsList->file_extension =='Video'){
               $icon='<i class="fa fa-play"></i>';
               $pages=$ticketsList->pageCount;
             }else{
               $icon="";
               $pages="";             }

             
            ?>
            <tr style="border: 1px solid #ccc;">
              <td style="background-color:#fff !important;padding: 20px; width: 2%;">{{($tickets->currentpage()-1)*$tickets->perpage()+1+$key}}.</td>
              <td style="background-color:#fff !important;padding: 20px; width: 2%;">
                <div class="ticket_check">
                  <input  type="checkbox"  class="css-checkbox ads_Checkbox"
                    name="check_record[]"  
                    value="{{$ticketsList->id}}" id="{{$ticketsList->id}}" {!! in_array($ticketsList->id, $new_checked_values) ? 'checked' : ''  !!} />
                  <label class="css-label radGroup2" for="{{$ticketsList->id}}">&nbsp;</label>
                </div>
              </td>
              <td style="background-color:#fff !important;padding: 20px; width: 81%;">
                <?php echo $icon; ?> &nbsp; {{$ticketsList->issue_title}}
              </td>
              <td style="background-color:#fff !important;width: 15%; text-align: right;"><?php echo $pages; ?></td>
            </tr>
            <?php
          }
        ?>
        </tbody>
        
        
      </table>
      <input type="hidden" id="prev_page" value="{{$tickets->currentPage()}}">
      <div class="prod-pagination">
          {{ $tickets->render() }}
      </div>
    </div>
    <script type="text/javascript">
    
    
    function rwe_tickets_generation(real_time_tickets) 
    {
        iframe = $('#frame-');
        window.location.reload();
        iframe.attr('src', '{{url('/')}}/MainViewerJS/#../uploads/real_time_attachment/'+real_time_tickets);
    }  
  $('.ticket_check').click(function () 
    {
        var check_record=$("input:checkbox[name='check_record[]']:checked").length;

        var realissuesCount = parseInt('<?php echo $realissuesCount; ?>');
        var limit = parseInt('<?php echo $limit; ?>');
       
        check_record = check_record + realissuesCount;
       
        //console.log(check_record +' ####' +limit);

        if(check_record==limit)
        {
            $('#exceed_limit').html('');
            var result = confirm(' You have selected '+limit+' tickets! Are you sure you want submit?');
        }
        if(check_record>limit)
        {
            $('#exceed_limit').html('Your limit is exceeded.');
            $(this).find("input:checkbox[name='check_record[]']").attr('checked', false);
            return false;
        }
        if(result)
        {
            var arr = $('input[name="check_record[]"]:checked').map(function(){
            return $(this).val();
            }).get();
            var link         = "{{ url('/purchased_tickets') }}";
            var _token       = $("input[name=_token]").val();
            var interview_id = $('#unique').val();
            var ticket_unique_id = $('#ticket_unique_id').val();
            
          var form_data = new FormData();
          form_data.append('_token',_token);
          form_data.append('arr_data',arr);
          form_data.append('id',interview_id);
          form_data.append('ticket_unique_id',ticket_unique_id);
          form_data.append('prev_arr_data','{{$prev_arr_data}}');
   
          jQuery.ajax({
                          url:link,
                          type:'post',
                          dataType:'json',
                          data:form_data,
                          processData:false,
                          contentType:false,
                          beforeSend:function()
                          {
                            $('#error_msg').html('');
                          },
                          success:function(response)
                          {
                            if(response.status=="success")
                              {
                                $('#ticket_unique_id').val(response.ticket_unique_id);
                                $('#modal-success-ticket').html(response.msg);
                                alert(response.msg);
                                location.reload();
                              }
                              if(response.status=="error")
                              {
                                /*alert('user not logged in');*/
                                 $('#modal-error-ticket').html(response.msg);
                                alert(response.msg);
                                location.reload();
                              }
                          } 
                         });   
        }
        
        
    });
</script>
    
