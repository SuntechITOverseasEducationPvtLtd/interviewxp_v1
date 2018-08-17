

@extends('front.layout.main')
@section('middle_content')
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/parsley.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/data-tables/latest/dataTables.bootstrap.min.css">
<!-- <link href="{{url('/')}}/css/front/parlsey.css" rel="stylesheet" type="text/css" /> -->
<div class="banner-change-pw">
   <div class="pattern-change-pw">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="heading-changepw">{{$module_title}}</div>
            </div>
         </div>
      </div>
   </div>
</div>
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<div class="middle-area min-height">
   <div class="container">
      <!--tab-->
      <div class="col-sm-12">
         <div class="appom-box">
            <div class="box-m">
               <div class="tab-contact">
                  <div class="tabs responsive-tabs responsive-tabs-initialized">
                     <nav>
                        <ul>
                           <li class="active">
                              <a href="#">Alerts Details</a>
                           </li>
                           <li class="">
                              <a href="{{ url('/')}}/user/manage_alert">My Saved Alerts</a>
                           </li>
                        </ul>
                     </nav>
                     <div class="content">
                        <h4>You will receive an alerts on the basis of the fields you have filled</h4>
                        @include('front.layout._operation_status')
                        <form action="{{url('/user/update_alert')}}" id="frm_create_alerts" method="POST" data-parsley-validate>
                           {{ csrf_field() }}
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <label class="h-text">Skills :</label>
                                    <label>{{$arr_data['skills'][0]['skill_name'] or 'NA'}}</label>
                                 </div>
                                 <div class="form-group">
                                    <label class="h-text">Experience Level :</label>
                                    <label>{{$arr_data['exp_level'] or 'NA'}} Years</label>
                                 </div>
                                 <div class="form-group">
                                    <label class="h-text">Name Your Alerts  : </label>
                                    <label>{{$arr_data['alert_name'] or 'NA'}}</label>
                                 </div>
                                 <div class="check-box">
                                     <label class="h-text">Skill Sets  : </label>
                                    <label>{{$arr_data['skill_set'] or 'NA'}}</label>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--end-->
   </div>
</div>
<link rel="stylesheet" type="text/css" href="{{url('/')}}/css/front/skillautocomplete.css"/>
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

@endsection

