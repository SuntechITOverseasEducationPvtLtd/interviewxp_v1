

@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<style type="text/css"> h4 { line-height: 0px;      font-size: 15px; } </style>
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
                     <h4><b>Alert Details:</b></h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >A/C Type :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_type']) && $arr_data['user_type'] !=""  ?$arr_data['user_type']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >User First Name :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_details']['first_name']) && $arr_data['user_details']['first_name'] !=""  ?$arr_data['user_details']['first_name']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >User Last Name :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_details']['last_name']) && $arr_data['user_details']['last_name'] !=""  ?$arr_data['user_details']['last_name']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Email :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['user_details']['email']) && $arr_data['user_details']['email'] !=""  ?$arr_data['user_details']['email']:'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Gender :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">@if($arr_data['user_details']['gender']=="M")Male @else Female @endif</h4>
                  </div>
               </div>
                <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >PH.No :</label>
                  </div>
                  <div class="col-sm-9">
                      <h4 class="value">{{ isset($arr_data['user_details']['mobile_no']) && $arr_data['user_details']['mobile_no'] !=""  ?$arr_data['user_details']['mobile_no']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Exp Level :</label>
                  </div>
                  <div class="col-sm-9">
                      <h4 class="value">{{ isset($arr_data['exp_level']) && $arr_data['exp_level'] !=""  ?$arr_data['exp_level'].' years':'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Skill :</label>
                  </div>
                  <div class="col-sm-9">
                      <h4 class="value">{{ isset($arr_data['skills'][0]['skill_name']) && $arr_data['skills'][0]['skill_name'] !=""  ?$arr_data['skills'][0]['skill_name']:'NA' }}</h4>
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

