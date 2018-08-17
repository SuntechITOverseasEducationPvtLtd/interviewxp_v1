@extends('admin.layout.master')                

@section('main_content')
@include('common_layout.chart_js')

<style type="text/css">.btn-rounded  {     width: 30px;
    height: 30px;
    text-align: center;
    padding: 3px 5px !important;}
    
    .count {     color: #fff;
    font-size: 20px;
    font-weight: bold; }
    
    .tile p.title {
       font-size: 15px;
    margin-bottom: 2px;
    color: #fff;
}

.content:first-child {
    padding-top: 11px;
}

.content {
    padding: 0 18px 17px 20px;
}
.box.box-orange {
    border: 1px solid #d5d5d5;
    background: #fff;
}.box .box-content {
    padding: 0px 0px 0px 10px;
    background: #fff;
}.weekly-changes {
    margin: 0;
    padding: 0;
    list-style: none;
    min-height: 220px;
}.weekly-changes > li {
    padding-top: 5px;
    padding-bottom: 5px;
}

.weekly-changes > li {
    border-bottom: 1px solid #f5f5f5;
 
}

p {
    margin: 0 0 2px;
    line-height: 18px;
}
</style>
    <!-- Quick stats boxes -->
                            <div class="row">
                                <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400">
                                        <div class="panel-body">
                                            <div class="heading-elements" style="right: 6px;">
                                                <span class="heading-text badge bg-teal-800">+56%</span>
                                            </div>

                                           <h3 class="no-margin">{{ isset($tot_sales_sum) && $tot_sales_sum !=""  ?$tot_sales_sum:'0' }}</h3>
                                            No Of Sales
                                        
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
<div class="row">
 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Today" ><i class="icon-watch"></i></a>

<br>{{ isset($total_day_week_month_count[0]['tot_sales_sum_today']) && $total_day_week_month_count[0]['tot_sales_sum_today'] !=""  ?$total_day_week_month_count[0]['tot_sales_sum_today']:'0' }}

</div>

 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Week" ><i class="icon-alarm"></i></a>

<br>{{ isset($total_day_week_month_count[0]['tot_sales_sum_week']) && $total_day_week_month_count[0]['tot_sales_sum_week'] !=""  ?$total_day_week_month_count[0]['tot_sales_sum_week']:'0' }}

</div>


 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Month" ><i class="icon-calendar52"></i></a>

<br>{{ isset($total_day_week_month_count[0]['tot_sales_sum_month']) && $total_day_week_month_count[0]['tot_sales_sum_month'] !=""  ?$total_day_week_month_count[0]['tot_sales_sum_month']:'0' }}

</div>




</div>


                                </div>



                                 <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-pink-400">
                                        <div class="panel-body">
                                            <div class="heading-elements" style="right: 6px;">
                                                <span class="heading-text badge bg-teal-800" style="background-color: #ca225b;    border-color: #ca225b;">+12%</span>
                                            </div>

                                           <h3 class="no-margin">{{ isset($tot_revenue_sum) && $tot_revenue_sum !=""  ?$tot_revenue_sum:'0' }}</h3>
                                            Revenue Earned
                                        
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->

<div class="row">
 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Today" ><i class="icon-watch"></i></a>

<br>{{ isset($total_day_week_month_count[0]['tot_revenue_sum_today']) && $total_day_week_month_count[0]['tot_revenue_sum_today'] !=""  ?$total_day_week_month_count[0]['tot_revenue_sum_today']:'0' }}

</div>

 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Week" ><i class="icon-alarm"></i></a>

<br>{{ isset($total_day_week_month_count[0]['tot_revenue_sum_week']) && $total_day_week_month_count[0]['tot_revenue_sum_week'] !=""  ?$total_day_week_month_count[0]['tot_revenue_sum_week']:'0' }}

</div>


 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Month" ><i class="icon-calendar52"></i></a>

<br>{{ isset($total_day_week_month_count[0]['tot_revenue_sum_month']) && $total_day_week_month_count[0]['tot_revenue_sum_month'] !=""  ?$total_day_week_month_count[0]['tot_revenue_sum_month']:'0' }}

</div>




</div>



                                </div>



                                 <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-blue-400">
                                        <div class="panel-body">
                                            <div class="heading-elements" style="right: 6px;">
                                                <span class="heading-text badge bg-teal-800" style="background-color: #2293c6;    border-color: #2293c6;" >+34%</span>
                                            </div>

                                           <h3 class="no-margin">{{ isset($arr_user_count) && $arr_user_count !=""  ?$arr_user_count:'0' }}</h3>
                                           Users Register
                                        
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
<div class="row">
 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Today" ><i class="icon-watch"></i></a>

<br>{{ isset($total_day_week_month_count[0]['user_count_today']) && $total_day_week_month_count[0]['user_count_today'] !=""  ?$total_day_week_month_count[0]['user_count_today']:'0' }}

</div>

 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Week" ><i class="icon-alarm"></i></a>

<br>{{ isset($total_day_week_month_count[0]['user_count_week']) && $total_day_week_month_count[0]['user_count_week'] !=""  ?$total_day_week_month_count[0]['user_count_week']:'0' }}

</div>


 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Month" ><i class="icon-calendar52"></i></a>

<br>{{ isset($total_day_week_month_count[0]['user_count_month']) && $total_day_week_month_count[0]['user_count_month'] !=""  ?$total_day_week_month_count[0]['user_count_month']:'0' }}

</div>




</div>
                                </div>



                                 <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400" style="background: #5c6bc0; border-color: #5c6bc0;">
                                        <div class="panel-body">
                                            <div class="heading-elements" style="right: 6px;">
                                                <span class="heading-text badge bg-teal-800" style="background-color: #293ba3;    border-color: #293ba3;">+26%</span>
                                            </div>

                                           <h3 class="no-margin">{{ isset($arr_member_count) && $arr_member_count !=""  ?$arr_member_count:'0' }}</h3>
                                            Members Register
                                        
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
<div class="row">
 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Today" ><i class="icon-watch"></i></a>

<br>{{ isset($total_day_week_month_count[0]['member_count_today']) && $total_day_week_month_count[0]['member_count_today'] !=""  ?$total_day_week_month_count[0]['member_count_today']:'0' }}

</div>

 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Week" ><i class="icon-alarm"></i></a>

<br>{{ isset($total_day_week_month_count[0]['member_count_week']) && $total_day_week_month_count[0]['member_count_week'] !=""  ?$total_day_week_month_count[0]['member_count_week']:'0' }}

</div>


 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Month" ><i class="icon-calendar52"></i></a>

<br>{{ isset($total_day_week_month_count[0]['member_count_month']) && $total_day_week_month_count[0]['member_count_month'] !=""  ?$total_day_week_month_count[0]['member_count_month']:'0' }}

</div>




</div>
                                </div>




                                 <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400" style="background-color: #ff7043;
    border-color: #ff7043;">
                                        <div class="panel-body">
                                            <div class="heading-elements" style="right: 6px;">
                                                <span class="heading-text badge bg-teal-800" style="background-color: #df582d;    border-color: #df582d;">+51%</span>
                                            </div>

                                           <h3 class="no-margin">{{ isset($count_pending) && $count_pending !=""  ?$count_pending:'0' }}</h3>
                                            Pending Uploads
                                        
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                  <div class="row">
 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Today" ><i class="icon-watch"></i></a>

<br>{{ isset($total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_day']) && $total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_day'] !=""  ?$total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_day']:'0' }}

</div>

 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Week" ><i class="icon-alarm"></i></a>

<br>{{ isset($total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_week']) && $total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_week'] !=""  ?$total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_week']:'0' }}

</div>


 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Month" ><i class="icon-calendar52"></i></a>

<br>
{{ isset($total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_month']) && $total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_month'] !=""  ?$total_day_week_month_count[0]['count_pending_multirefbook_company_ticket_month']:'0' }}
</div>




</div>  <!-- /members online -->

                                </div>




                                 <div class="col-lg-2">

                                    <!-- Members online -->
                                    <div class="panel bg-teal-400" style="    background: #4caf50; border-color: #4caf50;">
                                        <div class="panel-body">
                                            <div class="heading-elements" style="right: 6px;">
                                                <span class="heading-text badge bg-teal-800" style="background-color: #1e8a22;    border-color: #1e8a22;">+36%</span>
                                            </div>

                                           <h3 class="no-margin">{{ isset($count_approve) && $count_approve !=""  ?$count_approve:'0' }}</h3>
                                           No.Of Uploads
                                        
                                        </div>

                                        <div class="container-fluid">
                                            <div id="members-online"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->





<div class="row">
 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="Today" ><i class="icon-watch"></i></a>

<br>{{ isset($total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_day']) && $total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_day'] !=""  ?$total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_day']:'0' }}

</div>

 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Week" ><i class="icon-alarm"></i></a>

<br>{{ isset($total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_week']) && $total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_week'] !=""  ?$total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_week']:'0' }}

</div>


 <div class="col-lg-4" style="    text-align: center;    font-weight: bold;">
    <a href="#" class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" data-popup="tooltip" title="" data-original-title="This Month" ><i class="icon-calendar52"></i></a>

<br>{{ isset($total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_month']) && $total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_month'] !=""  ?$total_day_week_month_count[0]['count_approve_multirefbook_company_ticket_month']:'0' }}

</div>




</div>

                                </div>




            


                            </div>
                            <!-- /quick stats boxes -->



<div class="row" style="    margin-top: 80px;">
                                        <div class="col-lg-3 col-lg-offset-3" style="background:url({{ url('/') }}/images/bg1.jpg) #fff;

min-height: 104px;

    background-repeat: no-repeat;
    background-position: bottom;
    /* background: #fff; */
    padding: 22px; ">
                                            <ul class="list-inline text-center">
                                                <li>
                                                  <a  href="{{url('/')}}/admin/transactions/sales" class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class=" icon-coin-dollar"></i></a>
                                                </li>
                                                <li class="text-left">
                                                     <a class="tile  tile-orange" href="{{url('/')}}/admin/transactions/sales">  <div class="text-semibold">Sales</div>
                                                    <div class="text-muted">2,349 avg</div></a>
                                                </li>
                                            </ul>

                                            <div class="col-lg-10 col-lg-offset-1">
                                                <div class="content-group" id="new-visitors"></div>
                                            </div>
                                        </div>

                                              <div class="col-lg-3" style="background:url({{ url('/') }}/images/bg2.jpg) #fff;     margin-left: 30px;

min-height: 104px;

    background-repeat: no-repeat;
    background-position: bottom;
    /* background: #fff; */
    padding: 22px; ">


                                            <ul class="list-inline text-center">
                                                <li>
                                         <a href="{{url('/')}}/admin/transactions/payments" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class=" icon-cash"></i></a>
                                                </li>
                                                <li class="text-left">
                                                  <a class="tile tile-pink" href="{{url('/')}}/admin/transactions/payments">   <div class="text-semibold">Payments</div>
                                                    <div class="text-muted">820 avg</div></a>
                                                </li>
                                            </ul>

                                            <div class="col-lg-10 col-lg-offset-1">
                                                <div class="content-group" id="new-sessions"></div>
                                            </div>
                                        </div>
                                    </div>

              




                {{-- <div class="row">

                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="fa fa-bar-chart-o"></i> Users Chart</h3>
                                {!! $chart->render() !!}
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="fa fa-bar-chart-o"></i> Users & Members Chart</h3>
                                {!! $user_member_charts->render() !!}
                            </div>
                            
                        </div>
                    </div>
                    
                </div> --}}

                 
                 
                 
                 
                 
                 
                    <div class="row">
                    <div class="col-md-12">
                        <div class="">
                          
                            <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                                <div class="tile tile" style="  background-color: #26A69A;    border-color: #26A69A;">
                               <!--  <div class="tile tile-green"> -->
                                    <!-- <div class="img">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div> -->
                                    <div class="content" style="position: none;">
                                        <p class="big" style="text-align: center;">
                                    <span class="count">{{ isset($tot_sales_sum) && $tot_sales_sum !=""  ?$tot_sales_sum:'0' }}</span></p>
                                        <p class="title" style="text-align: center;">Sales of {{ date('M Y') }}</p>
                                    </div>
                                </div>
                            </div>                              
                            <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                                <div class="tile tile" style="background: #5c6bc0;    border-color: #5c6bc0;">
                                    <!-- <div class="img">
                                        <i class="fa fa-copy"></i>
                                    </div> -->
                                    <div class="content" style="position: none;">
                                        <p class="big" style="text-align: center;">
                                        <span class="count">{{ isset($arr_member_count) && $arr_member_count !=""  ?$arr_member_count:'0' }}</span>
                                        </p>
                                        <p class="title" style="text-align: center;">Total No Of Coaches</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                                <div class="tile tile" style="background-color: #EC407A;    border-color: #EC407A;">
                               <!--  <div class="tile tile-green"> -->
                                   <!--  <div class="img">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div> -->
                                    <div class="content" style="position: none;">
                                        <p class="big" style="text-align: center;"> <span class="count">{{ isset($arr_user_count) && $arr_user_count !=""  ?$arr_user_count:'0' }}</span></p>
                                        <p class="title" style="text-align: center;">Total No Of Users</p>
                                    </div>
                                </div>
                            </div>   
                               
                            <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                                <div class="tile tile" style="    background-color: #29B6F6;    border-color: #29B6F6;">
                                   <!--  <div class="img">
                                        <i class="fa fa-user"></i>
                                    </div> -->
                                    <div class="content" style="position: none;">
                                        <p class="big" style="text-align: center;">
                                        <span class="count">{{ isset($reviewsCount) && $reviewsCount !=""  ?$reviewsCount:'0' }}</span></p>
                                        <p class="title" style="text-align: center;">Total No Of Reviews</p>
                                    </div>
                                </div>
                            </div>  
                             <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                                <div class="tile tile" style="    background-color: #29B6F6;
    border-color: #29B6F6;">
                                   <!--  <div class="img">
                                        <i class="fa fa-comments"></i>
                                    </div> -->
                                      <div class="content" style="position: none;">
                                        <p class="big" style="text-align: center;">
                                        <span class="count">{{ isset($skillsCount) && $skillsCount !=""  ?$skillsCount:'0' }}</span></p>
                                        <p class="title" style="text-align: center;">No.Of Skills</p>
                                    </div>
                                </div>
                            </div>  
                              
                            <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                                <div class="tile tile" style="    background: #4caf50;
    border-color: #4caf50;">
                                   <!--  <div class="img">
                                        <i class="fa fa-copy"></i>
                                    </div> -->
                                     <div class="content" style="position: none;">
                                        <p class="big" style="text-align: center;">
                                        <span class="count">0</span></p>
                                        <p class="title" style="text-align: center;">Total No.Of Affiliates </p>
                                    </div>
                                </div>
                            </div> 
                        <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                        <div class="box box-orange">
                            <div class="box-content">
                                <ul class="weekly-changes">
                                    <li>
                                        <p>
                                            
                                            Coaching
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_month_of_sales_count[0]['tot_coaching']) && $total_month_of_sales_count[0]['tot_coaching'] !=""  ?$total_month_of_sales_count[0]['tot_coaching']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            QA
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_month_of_sales_count[0]['tot_qa']) && $total_month_of_sales_count[0]['tot_qa'] !=""  ?$total_month_of_sales_count[0]['tot_qa']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Companies
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_month_of_sales_count[0]['tot_companies']) && $total_month_of_sales_count[0]['tot_companies'] !=""  ?$total_month_of_sales_count[0]['tot_companies']:'0' }}</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Work Exp
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_month_of_sales_count[0]['tot_work_exp']) && $total_month_of_sales_count[0]['tot_work_exp'] !=""  ?$total_month_of_sales_count[0]['tot_work_exp']:'0' }}</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Combo QA
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_month_of_sales_count[0]['tot_combo_qa']) && $total_month_of_sales_count[0]['tot_combo_qa'] !=""  ?$total_month_of_sales_count[0]['tot_combo_qa']:'0' }}</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Combo 2Comp
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_month_of_sales_count[0]['tot_combo_companies']) && $total_month_of_sales_count[0]['tot_combo_companies'] !=""  ?$total_month_of_sales_count[0]['tot_combo_companies']:'0' }}</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Combo WE-50
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_month_of_sales_count[0]['tot_combo_workexp']) && $total_month_of_sales_count[0]['tot_combo_workexp'] !=""  ?$total_month_of_sales_count[0]['tot_combo_workexp']:'0' }}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                        <div class="box box-orange">
                            <div class="box-content">
                                <ul class="weekly-changes">
                                    <li>
                                        <p>
                                            Active
                                            <i class="fa fa-minus light-red"></i>
                                           <span class="light-blue">{{ isset($total_no_of_coaches[0]['active_coaches_count']) && $total_no_of_coaches[0]['active_coaches_count'] !=""  ?$total_no_of_coaches[0]['active_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Inactive
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_coaches[0]['inactive_coaches_count']) && $total_no_of_coaches[0]['inactive_coaches_count'] !=""  ?$total_no_of_coaches[0]['inactive_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Closed
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_coaches[0]['deactivated_coaches_count']) && $total_no_of_coaches[0]['deactivated_coaches_count'] !=""  ?$total_no_of_coaches[0]['deactivated_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Blocked
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_coaches[0]['blocked_coaches_count']) && $total_no_of_coaches[0]['blocked_coaches_count'] !=""  ?$total_no_of_coaches[0]['blocked_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Purchaged
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_coaches[0]['purchaged_coaches_count']) && $total_no_of_coaches[0]['purchaged_coaches_count'] !=""  ?$total_no_of_coaches[0]['purchaged_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Denied
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_coaches[0]['denied_coaches_count']) && $total_no_of_coaches[0]['denied_coaches_count'] !=""  ?$total_no_of_coaches[0]['denied_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Not Sold
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_coaches[0]['notpurchaged_coaches_count']) && $total_no_of_coaches[0]['notpurchaged_coaches_count'] !=""  ?$total_no_of_coaches[0]['notpurchaged_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                        <div class="box box-orange">
                            <div class="box-content">
                                <ul class="weekly-changes">
                                    <li>
                                        <p>
                                            Active
                                            <i class="fa fa-minus light-red"></i>
                                           <span class="light-blue">{{ isset($total_no_of_users[0]['active_users_count']) && $total_no_of_users[0]['active_users_count'] !=""  ?$total_no_of_users[0]['active_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Inactive
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_users[0]['inactive_users_count']) && $total_no_of_users[0]['inactive_users_count'] !=""  ?$total_no_of_users[0]['inactive_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Closed
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_users[0]['deactivated_users_count']) && $total_no_of_users[0]['deactivated_users_count'] !=""  ?$total_no_of_users[0]['deactivated_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Blocked
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_users[0]['blocked_users_count']) && $total_no_of_users[0]['blocked_users_count'] !=""  ?$total_no_of_users[0]['blocked_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Purchaged
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_users[0]['purchaged_users_count']) && $total_no_of_users[0]['purchaged_users_count'] !=""  ?$total_no_of_users[0]['purchaged_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Not Purchaged
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_users[0]['notpurchaged_users_count']) && $total_no_of_users[0]['notpurchaged_users_count'] !=""  ?$total_no_of_users[0]['notpurchaged_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                        <div class="box box-orange">
                            <div class="box-content">
                                <ul class="weekly-changes">
                                    <li>
                                        <p>
                                            <?php 
                                            $stars = url('/')."/images/star.png";    
                                            for($i=1; $i<=5; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_reviews[0]['five_star_count']) && $total_no_of_reviews[0]['five_star_count'] !=""  ?$total_no_of_reviews[0]['five_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=4; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_reviews[0]['four_star_count']) && $total_no_of_reviews[0]['four_star_count'] !=""  ?$total_no_of_reviews[0]['four_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=3; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_reviews[0]['three_star_count']) && $total_no_of_reviews[0]['three_star_count'] !=""  ?$total_no_of_reviews[0]['three_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=2; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_reviews[0]['two_tar_count']) && $total_no_of_reviews[0]['two_tar_count'] !=""  ?$total_no_of_reviews[0]['two_tar_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=1; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_reviews[0]['one_star_count']) && $total_no_of_reviews[0]['one_star_count'] !=""  ?$total_no_of_reviews[0]['one_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                        <div class="box box-orange">
                            <div class="box-content">
                                <ul class="weekly-changes">
                                    <li>
                                        <p>
                                            0-2 yrs
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_skills[0]['zero_two_count']) && $total_no_of_skills[0]['zero_two_count'] !=""  ?$total_no_of_skills[0]['zero_two_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            2-4 yrs
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_skills[0]['two_four_count']) && $total_no_of_skills[0]['two_four_count'] !=""  ?$total_no_of_skills[0]['two_four_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            5-10 yrs
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_skills[0]['five_ten_count']) && $total_no_of_skills[0]['five_ten_count'] !=""  ?$total_no_of_skills[0]['five_ten_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            10-20 yrs
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_skills[0]['ten_twenty_count']) && $total_no_of_skills[0]['ten_twenty_count'] !=""  ?$total_no_of_skills[0]['ten_twenty_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            NA yrs
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_skills[0]['na_count']) && $total_no_of_skills[0]['na_count'] !=""  ?$total_no_of_skills[0]['na_count']:'0' }}</span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-2" style="padding: 0px 2px 0px 2px">
                        <div class="box box-orange">
                            <div class="box-content">
                                <ul class="weekly-changes">
                                    <li>
                                        <p>
                                            Active
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Inactive
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Closed
                                            <i class="fa fa-minus light-green"></i>
                                            <span class="light-green"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Blocked
                                            <i class="fa fa-minus light-red"></i>
                                            <span class="light-red"></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Transactions
                                            <i class="fa fa-minus light-blue"></i>
                                            <span class="light-blue"></span>
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    

                        </div>
                    </div>
                </div>

                
                        
              <!--   <div class="row">
                    <div class="col-md-6">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="fa fa-bar-chart-o"></i> Real Time Chart</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <div id="chart_4" class="chart" style="height: 400px"></div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="box">
                            
                            <div class="box-content">
                                <div id="chart_5" style="height:350px;"></div>
                                <div class="btn-toolbar">
                                    <div class="btn-group stackControls">
                                        <input type="button" class="btn btn-primary" value="With stacking" />
                                        <input type="button" class="btn btn-danger" value="Without stacking" />
                                    </div>
                                    <div class="btn-group graphControls pull-right">
                                        <input type="button" class="btn" value="Bars" />
                                        <input type="button" class="btn" value="Lines" />
                                        <input type="button" class="btn" value="Lines with steps" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->


                </div>

<script type="text/javascript">
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>
                   
@stop                    