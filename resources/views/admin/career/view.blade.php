@extends('admin.layout.master')                
@section('main_content')
<!-- BEGIN Page Title -->
<!-- BEGIN Page Title -->
<style>
    h4.value {font-size:15px; line-height:0px; } .form-horizontal .form-group {    margin: 0px;   margin-bottom: 5px;
    border-bottom: 1px solid #fff;
    line-height: 19px; }
    .form-horizontal .form-group .col-sm-7 {

    color: #08746a;
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
              <div class="col-md-6" style="background: whitesmoke;     padding: 5px 0px;">
                  
                  
                  <ul class="navigation" style="padding: 0px 0px 5px;">
										
											<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> {{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }} Resume details</a></li>
										
								
                      
                      
										</ul>
										
										
										
               <div class="form-group">
                  <div class="col-sm-5">
                     <label class="main-label" >Name :</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['first_name']) && $arr_data['first_name'] !=""  ?ucfirst($arr_data['first_name']):'NA' }}</h4>
                  </div>
               </div>


<div class="form-group">
                   <div class="col-sm-5">
                     <label class="main-label" >Email:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['email']) && $arr_data['email'] !=""  ?ucfirst($arr_data['email']):'NA' }}</h4>
                  </div>
               </div>


 <div class="form-group">
               <div class="col-sm-5">
                     <label class="main-label" >Mobile.No:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">+{{ isset($arr_data['mobile_code']) && $arr_data['mobile_code'] !=""  ?ucfirst($arr_data['mobile_code']):'NA' }} {{ isset($arr_data['mobile_no']) && $arr_data['mobile_no'] !=""  ?ucfirst($arr_data['mobile_no']):'NA' }}</h4>
                  </div>
               </div>

               
               <div class="form-group">
                  <div class="col-sm-5">
                     <label class="main-label" >DOB:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['birth_date']) && $arr_data['birth_date'] !=""  ?ucfirst($arr_data['birth_date']):'NA' }}</h4>
                  </div>
               </div>

<div class="form-group">
                 <div class="col-sm-5">
                     <label class="main-label" >Gender:</label>
                  </div>
                  <div class="col-sm-7">
                      @if($arr_data['gender']=='M')
                        <h4 class="value">Male</h4>
                        @elseif($arr_data['gender']=='F')
                        <h4 class="value">Female</h4>
                        @endif   
                  </div>
               </div>








                <div class="form-group" style="display:none">
               <div class="col-sm-5">
                     <label class="main-label" >Job Title :</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['job_title']) && $arr_data['job_title'] !=""  ?$arr_data['job_title']:'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                  <div class="col-sm-5">
                     <label class="main-label" >Total Experience :</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['experience_years']) && $arr_data['experience_years'] !=""  ?$arr_data['experience_years'].' Years '.$arr_data['experience_month'].' Month':'NA' }}</h4>
                  </div>
               </div>
               <div class="form-group">
             <div class="col-sm-5">
                     <label class="main-label" >Company Name :</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['company_name']) && $arr_data['company_name'] !=""  ?ucfirst($arr_data['company_name']):'NA' }}</h4>
                  </div>
               </div>

                <div class="form-group" style="display:none">
                 <div class="col-sm-5">
                     <label class="main-label" >Employer Type:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['employer_type']) && $arr_data['employer_type'] !=""  ?ucfirst($arr_data['employer_type']):'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Designation:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['designation']) && $arr_data['designation'] !=""  ?ucfirst($arr_data['designation']):'NA' }}</h4>
                  </div>
               </div>

                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Duration:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">
                         <?php  $start_month = $arr_data['start_month']; 
                               $start_year  =  $arr_data['start_year'];
                               $end_month   =  $arr_data['end_month'];
                               $end_year    =  $arr_data['end_year'];
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
                    </h4>
                  </div>
               </div>
              
                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Annual Salary:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['annual_salary']) && $arr_data['annual_salary'] !=""  ?ucfirst($arr_data['annual_salary']):'NA' }}</h4>
                  </div>
               </div>

                <div class="form-group" style="height: 55px;">
                <div class="col-sm-5" style="line-height: 51px;">
                     <label class="main-label" >Present Location:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value" style="    line-height: 17px;">{{ isset($arr_data['current_work_location']) && $arr_data['current_work_location'] !=""  ?ucfirst($arr_data['current_work_location']):'NA' }}</h4>
                  </div>
               </div>
                 
             
               
                
               <div class="form-group">
                  <div class="col-sm-5">
                     <label class="main-label" >Resume:</label>
                  </div>
                  <div class="col-sm-7">
                    @if($arr_data['resume'] !="")
                      <h4 class="value">
                      
                         <a href="{{url('/')}}/uploads/career_resume/{{$arr_data['resume']}}" download=''       class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" >
                         <i class="icon-download" aria-hidden="true"></i>
                         
                         </a>
                     @else
                      <h4 class="value">File Not Exists</h4>
                     @endif 
                  </div>
               </div>
</div>
           
           
           
           
               <div class="col-md-5" style="background: whitesmoke; padding: 5px 0px; margin-left: 5px;">
                  
                  
                  <ul class="navigation" style="padding: 0px 0px 5px;">
										
											<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Previous compnay details</a></li>
										
								
                      
                      
										</ul>
										
										
										
             
               <div class="form-group">
             <div class="col-sm-5">
                     <label class="main-label" >Company Name :</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['cnn']) && $arr_data['cnn'] !=""  ?ucfirst($arr_data['cnn']):'NA' }}</h4>
                  </div>
               </div>

            
              

                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Duration:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">
                         <?php  $start_month = $arr_data['smn']; 
                               $start_year  =  $arr_data['syn'];
                               $end_month   =  $arr_data['emn'];
                               $end_year    =  $arr_data['eyn'];
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
                           
                           {{$start_year}}
                           @else NA
                           @endif   
                    </h4>
                  </div>
               </div>
                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Designation:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['dn']) && $arr_data['dn'] !=""  ?ucfirst($arr_data['dn']):'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Annual Salary:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['asn']) && $arr_data['asn'] !=""  ?ucfirst($arr_data['asn']):'NA' }}</h4>
                  </div>
               </div>
               
               
               
               
                        <ul class="navigation" style="padding: 0px 0px 5px;">
										
											<li class="active"><a href="#profile" data-toggle="tab"><i class="icon-user"></i> Previous compnay details</a></li>
										
								
                      
                      
										</ul>
										
										
										
             
               <div class="form-group">
             <div class="col-sm-5">
                     <label class="main-label" >Company Name :</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['cnnn']) && $arr_data['cnnn'] !=""  ?ucfirst($arr_data['cnnn']):'NA' }}</h4>
                  </div>
               </div>

            
              

                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Duration:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">
                         <?php  $start_month = $arr_data['smnn']; 
                               $start_year  =  $arr_data['synn'];
                               $end_month   =  $arr_data['emnn'];
                               $end_year    =  $arr_data['eynn'];
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
                           
                           {{$start_year}}
                           @else NA
                           @endif   
                    </h4>
                  </div>
               </div>
                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Designation:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['dnn']) && $arr_data['dn'] !=""  ?ucfirst($arr_data['dnn']):'NA' }}</h4>
                  </div>
               </div>
                <div class="form-group">
                <div class="col-sm-5">
                     <label class="main-label" >Annual Salary:</label>
                  </div>
                  <div class="col-sm-7">
                     <h4 class="value">{{ isset($arr_data['asnn']) && $arr_data['asnn'] !=""  ?ucfirst($arr_data['asnn']):'NA' }}</h4>
                  </div>
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

