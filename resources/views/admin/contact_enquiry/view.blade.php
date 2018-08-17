

@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<!-- BEGIN Page Title -->
<style>
    
    h4.value { font-size:15px;  line-height:0px; }
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
         <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-6">
                     <h3>
                        <span 
                           class="text-" 
                           ondblclick="scrollToButtom()"
                           style="cursor: default;" 
                           title="Double click to Take Action" 
                           >
                        </span>
                     </h3>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               {!! Form::open([ 
               'method'=>'POST',
               'enctype' =>'multipart/form-data',   
               'class'=>'form-horizontal', 
               'id'=>'validation-form' 
               ]) !!} 
               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" ></label>
                  <div class="col-sm-3 col-lg-3 controls">
                     <h4><b>Enquiry Details:</b></h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >User Name :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_contact_enquiry['user_name']) && $arr_contact_enquiry['user_name'] !=""  ?$arr_contact_enquiry['user_name']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >User Email :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_contact_enquiry['email']) && $arr_contact_enquiry['email'] !=""  ?$arr_contact_enquiry['email']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Contact :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_contact_enquiry['phone']) && $arr_contact_enquiry['phone'] !=""  ?$arr_contact_enquiry['phone']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Message :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_contact_enquiry['message']) && $arr_contact_enquiry['message'] !=""  ?$arr_contact_enquiry['message']:'NA' }}</h4>
                  </div>
               </div>
               {!! Form::close() !!}
            </div>
         </div>
      </div>
   </div>
</div>
<!-- END Main Content -->
<script type="text/javascript">
   function scrollToButtom()
   {
       $("html, body").animate({ scrollTop: $(document).height() }, 1000);
   }
   
   $(document).ready(function()
   {
       $("#select_action").bind('change',function()
       {
           if($(this).val()=="cancel")
           {
               $("#reason_section").show();
           }
           else
           {
               $("#reason_section").hide();
           }
       });
   });
</script>
@stop

