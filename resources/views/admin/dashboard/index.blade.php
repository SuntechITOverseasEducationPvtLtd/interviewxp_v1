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
    color: #fff;     padding-top: 16px;
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


span.blue         {color: #368ee0;     float: right; margin-right: 16px;}
span.light-blue   {color: #67c2ef;  float: right; margin-right: 16px;}
span.green        {color: #393;  float: right; margin-right: 16px;}
span.light-green  {color: #78cd51; float: right; margin-right: 16px;}
span.red          {color: #e51400; float: right; margin-right: 16px;}
span.light-red    {color: #fa603d;  float: right; margin-right: 16px;}
span.orange       {color: #f8a31f;  float: right; margin-right: 16px;}
span.light-orange {color: #fabb3d;  float: right; margin-right: 16px;}
span.yellow       {color: #ebe810;  float: right; margin-right: 16px;}
span.pink         {color: #f359a8;  float: right; margin-right: 16px;}
span.magenta      {color: #a200ff;  float: right; margin-right: 16px;}
span.lime         {color: #8cbf26;  float: right; margin-right: 16px;}
span.gray         {color: #aaa;  float: right; margin-right: 16px;}


.blue         {color: #368ee0;   }
.light-blue   {color: #67c2ef;  }
.green        {color: #393;  }
.light-green  {color: #78cd51; }
.red          {color: #e51400; }
.light-red    {color: #fa603d;  }
.orange       {color: #f8a31f;  }
.light-orange {color: #fabb3d;  }
.yellow       {color: #ebe810;  }
.pink         {color: #f359a8;  }
.magenta      {color: #a200ff; }
.lime         {color: #8cbf26;  }
.gray         {color: #aaa;  }


.pagination {
    margin-top: 0;
    margin-bottom: 6px;
    float: right; }
</style>
  
                                  



                 
                 
                 
                 
                 
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
                                   <span class="count1" style="color: #fff;
    font-size: 20px;
    font-weight: bold;">{{ isset($tot_sales_sum) && !empty($tot_sales_sum) && $tot_sales_sum !=""  ?$tot_sales_sum:'0.00 /-' }}</span></p>
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
                                        <p class="big" style="text-align: center;"> <span class="count">{{ isset($arr_user_count) && !empty($arr_user_count) && $arr_user_count !=""  ?$arr_user_count:'0' }}</span></p>
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
                                        <span class="count">{{ isset($reviewsCount) && !empty($reviewsCount) && $reviewsCount !=""  ?$reviewsCount:'0' }}</span></p>
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
                                        <span class="count">{{ isset($skillsCount) && !empty($skillsCount) && $skillsCount !=""  ?$skillsCount:'0' }}</span></p>
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
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_month_of_sales_count[0]['tot_coaching']) && $total_month_of_sales_count[0]['tot_coaching'] !=""  ?$total_month_of_sales_count[0]['tot_coaching']:'0.00' }} /-</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            QA
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_month_of_sales_count[0]['tot_qa']) && $total_month_of_sales_count[0]['tot_qa'] !=""  ?$total_month_of_sales_count[0]['tot_qa']:'0.00' }} /-</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Companies
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_month_of_sales_count[0]['tot_companies']) && $total_month_of_sales_count[0]['tot_companies'] !=""  ?$total_month_of_sales_count[0]['tot_companies']:'0.00' }} /-</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Work Exp
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_month_of_sales_count[0]['tot_work_exp']) && $total_month_of_sales_count[0]['tot_work_exp'] !=""  ?$total_month_of_sales_count[0]['tot_work_exp']:'0.00' }} /-</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Combo QA
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_month_of_sales_count[0]['tot_combo_qa']) && $total_month_of_sales_count[0]['tot_combo_qa'] !=""  ?$total_month_of_sales_count[0]['tot_combo_qa']:'0.00' }} /-</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Combo 2Comp
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_month_of_sales_count[0]['tot_combo_companies']) && $total_month_of_sales_count[0]['tot_combo_companies'] !=""  ?$total_month_of_sales_count[0]['tot_combo_companies']:'0.00' }} /-</span>
                                        </p>
                                    </li>
									<li>
                                        <p>
                                            Combo WE-50
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_month_of_sales_count[0]['tot_combo_workexp']) && $total_month_of_sales_count[0]['tot_combo_workexp'] !=""  ?$total_month_of_sales_count[0]['tot_combo_workexp']:'0.00' }} /-</span>
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
                                            Active <i class="fa fa-minus light-red"></i>
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                           <span class="light-blue">{{ isset($total_no_of_coaches[0]['active_coaches_count']) && $total_no_of_coaches[0]['active_coaches_count'] !=""  ?$total_no_of_coaches[0]['active_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Inactive
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_coaches[0]['inactive_coaches_count']) && $total_no_of_coaches[0]['inactive_coaches_count'] !=""  ?$total_no_of_coaches[0]['inactive_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Closed
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_coaches[0]['deactivated_coaches_count']) && $total_no_of_coaches[0]['deactivated_coaches_count'] !=""  ?$total_no_of_coaches[0]['deactivated_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Blocked
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_coaches[0]['blocked_coaches_count']) && $total_no_of_coaches[0]['blocked_coaches_count'] !=""  ?$total_no_of_coaches[0]['blocked_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Purchaged
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_coaches[0]['purchaged_coaches_count']) && $total_no_of_coaches[0]['purchaged_coaches_count'] !=""  ?$total_no_of_coaches[0]['purchaged_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Denied
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_coaches[0]['denied_coaches_count']) && $total_no_of_coaches[0]['denied_coaches_count'] !=""  ?$total_no_of_coaches[0]['denied_coaches_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Not Sold
                                            <i class="icon-stats-growth2 position-left light-red"></i>
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
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                           <span class="light-blue">{{ isset($total_no_of_users[0]['active_users_count']) && $total_no_of_users[0]['active_users_count'] !=""  ?$total_no_of_users[0]['active_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Inactive
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_users[0]['inactive_users_count']) && $total_no_of_users[0]['inactive_users_count'] !=""  ?$total_no_of_users[0]['inactive_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            A/c Closed
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_users[0]['deactivated_users_count']) && $total_no_of_users[0]['deactivated_users_count'] !=""  ?$total_no_of_users[0]['deactivated_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Blocked
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_users[0]['blocked_users_count']) && $total_no_of_users[0]['blocked_users_count'] !=""  ?$total_no_of_users[0]['blocked_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Purchaged
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_users[0]['purchaged_users_count']) && $total_no_of_users[0]['purchaged_users_count'] !=""  ?$total_no_of_users[0]['purchaged_users_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            Not Purchaged
                                            <i class="icon-stats-growth2 position-left light-red"></i>
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
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_reviews[0]['five_star_count']) && $total_no_of_reviews[0]['five_star_count'] !=""  ?$total_no_of_reviews[0]['five_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=4; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_reviews[0]['four_star_count']) && $total_no_of_reviews[0]['four_star_count'] !=""  ?$total_no_of_reviews[0]['four_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=3; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_reviews[0]['three_star_count']) && $total_no_of_reviews[0]['three_star_count'] !=""  ?$total_no_of_reviews[0]['three_star_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=2; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_reviews[0]['two_tar_count']) && $total_no_of_reviews[0]['two_tar_count'] !=""  ?$total_no_of_reviews[0]['two_tar_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <?php 
                                            for($i=1; $i<=1; $i++) {  echo '<img src="'.$stars.'"/>'; } ?>
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
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
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_skills[0]['zero_two_count']) && $total_no_of_skills[0]['zero_two_count'] !=""  ?$total_no_of_skills[0]['zero_two_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            2-4 yrs
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
                                            <span class="light-blue">{{ isset($total_no_of_skills[0]['two_four_count']) && $total_no_of_skills[0]['two_four_count'] !=""  ?$total_no_of_skills[0]['two_four_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            5-10 yrs
                                            <i class="icon-stats-growth2 position-left light-green"></i>
                                            <span class="light-green">{{ isset($total_no_of_skills[0]['five_ten_count']) && $total_no_of_skills[0]['five_ten_count'] !=""  ?$total_no_of_skills[0]['five_ten_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            10-20 yrs
                                            <i class="icon-stats-growth2 position-left light-red"></i>
                                            <span class="light-red">{{ isset($total_no_of_skills[0]['ten_twenty_count']) && $total_no_of_skills[0]['ten_twenty_count'] !=""  ?$total_no_of_skills[0]['ten_twenty_count']:'0' }}</span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            NA yrs
                                            <i class="icon-stats-growth2 position-left light-blue"></i>
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

                
              <div class="row">
                     <div class="col-md-12" >
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
					 <th>Comapany Commission</th>
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

                                 <td style="line-height: 36px;float: left;width: 425px;">   <a href="{{url('/admin/transactions/sales/'.base64_encode($data[0]).'/'.base64_encode($data[1]))}}" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom" style="float: left;"><i class=" icon-calendar52"></i></a>
                     
                     
                     
                     
                     
                     &nbsp;&nbsp;&nbsp; <a href="{{url('/admin/transactions/sales/'.base64_encode($data[0]).'/'.base64_encode($data[1]))}}">{{$data[2]}} </a></td>
					 
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
                        {!! $entries->render() !!}
                      </div></div></div>
                      <div style="width:100%; height:50px; float:left"></div>
            
                
                        
            

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