

@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
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
      <li>
         <i class="fa fa-angle-right"></i>
         <i class="fa fa-info-circle"></i>
         <a href="{{ $module_url_path }}" class="call_loader">{{ $module_title or ''}}</a>
      </li>
      <span class="divider">
      <i class="fa fa-angle-right"></i>
      <i class="fa fa-eye"></i>
      </span>
      <li class="active"> {{ $page_title or ''}}</li>
   </ul>
</div>
<!-- END Breadcrumb -->
<!-- START Main Content -->
<div class="row">
<div class="col-md-12">
   <div class="box">
      <div class="box-title">
         <h3><i class="fa fa-eye"></i>{{ isset($page_title)?$page_title:"" }}</h3>
         <div class="box-tool">
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
               <!--   <div class="form-group">
                  <div class="col-sm-12">
                     <h4><b>User Details:</b></h4>
                  </div>
                  </div> -->
              
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Firstname :</label>
                  </div>
                  <div class="col-sm-9">
                     <h4 class="value">{{ isset($arr_data['member_personal_details']['first_name']) && $arr_data['member_personal_details']['first_name']!=""?ucfirst($arr_data['member_personal_details']['first_name']):'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Lastname :</label>
                  </div>
                  <div class="col-sm-9">
                       <h4 class="value">{{ isset($arr_data['member_personal_details']['last_name']) && $arr_data['member_personal_details']['last_name']!=""?ucfirst($arr_data['member_personal_details']['last_name']):'NA' }}</h4>
                  </div>
               </div>
                 <div class="form-group">
                  <div class="col-sm-3 text-right">
                     <label class="main-label" >Issues Title :</label>
                  </div>
                  <div class="col-sm-9">
                       <h4 class="value">{{ isset($arr_data['issue_title']) && $arr_data['issue_title']!=""?ucfirst($arr_data['issue_title']):'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                    <div class="col-sm-3 text-right">
                     <label class="main-label" >Skills :</label>
                  </div>
                  <div class="col-sm-9">
                       <h4 class="value">{{ isset($arr_data['skill_name']) && $arr_data['skill_name']!=""?ucfirst($arr_data['skill_name']):'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                    <div class="col-sm-3 text-right">
                     <label class="main-label" >Experience Level :</label>
                  </div>
                  <div class="col-sm-9">
                       <h4 class="value">{{ isset($arr_data['experience_level']) && $arr_data['experience_level']!=""?$arr_data['experience_level']:'NA' }}</h4>
                  </div>
               </div>
                 <div class="form-group">
                    <div class="col-sm-3 text-right">
                     <label class="main-label" >Solution :</label>
                  </div>
                  <div class="col-sm-9">
                       <h4 class="value">{{ isset($arr_data['solution']) && $arr_data['solution']!=""?$arr_data['solution']:'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
                    <div class="col-sm-3 text-right">
                     <label class="main-label" >Attachment :</label>
                  </div>
                  <div class="col-sm-9">
                      <h4 class="value"> @if($arr_data['attachment']!='')<a href="{{$referencebook_public_path.$arr_data['attachment']}}" download='' ><i class="fa fa-download" aria-hidden="true"></i></a>
                     @else
                     NA
                     @endif
                    </h4>
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

