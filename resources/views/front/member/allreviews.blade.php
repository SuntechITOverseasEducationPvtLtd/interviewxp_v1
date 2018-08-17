@extends('front.layout.main')
@section('middle_content')
<div id="member-header" class="after-login"></div>
<div class="banner-member">
   <div class="pattern-member">
   </div>
</div>
<div class="container-fluid fix-left-bar">
   <div class="row">
      @include('front.member.member_sidebar')
     
      <div class="col-sm-9 col-md-9 col-lg-10 middle-content">
         <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            <h2 class="my-profile m-history">Reviews & Ratings</h2>
               <div class="outer-box history-page">
                  <!--                  <h4>Interviews</h4>-->
                  <!-- tabbing section -->
                  <div class="table-responsive">
                     <table class="table">
                        <thead>
                           <tr class="t-head">
                              <td>S.No</td>
                              <td>Description</td>
                              <td>Experience Level</td>
                              <td>&nbsp;</td>
                           </tr>
                        </thead>
                        @if(isset($memberReviewSkills) && sizeof($memberReviewSkills)>0)
                        @foreach($memberReviewSkills as $key => $uploads)
                        <thead class="box  hideRow hideRow{{$key+1}}">
                           <tr class="top hideAll" id="{{$key+1}}">
                              <td>{{$key+1}}</td>
                              <td>
                             <?php
                              $interview_skill_name = '';
                              if(isset($uploads['skill_name']) && isset($uploads['experience_level'])  && $uploads['experience_level'] != 'NA')
                              {
                                $interview_skill_name = $uploads['allskill'].' Real Time Interview Questions &amp; Answers';
                              }
                              else if(($uploads['skill_name']) && isset($uploads['experience_level'])){                 
                                $interview_skill_name = $uploads['allskill'].' Interview Questions &amp; Answers';
                              }
                              ?>  
                                 {{$interview_skill_name}}   
                              </td>
                              <td>
                                 {{isset($uploads['experience_level']) && $uploads['experience_level'] != 'NA'?$uploads['experience_level'].' Year':'NA'}}
                              </td>
                              <td><a href="{{ 'reviews-ratings/'.base64_encode($uploads['skill_id'])}}" class="call_loader admin-button-icons">
                              <i class="fa fa-eye-open" title="Review Message" ></i>  <p>View</p> 
                            </a></td>
                           </tr>
                         
                        </thead>
                   
                     @endforeach
                     @else
                     <tr class="strips">
                     <td class="allreviews_01">
                     No Records found...
                     </td>
                     </tr>
                     @endif    
                     </tr>
                     </table>
                     {!! $memberReviewSkills->render() !!}
                </div>

      </div>

      <!-- end -->
   </div>
    </div>
</div>
   </div>
</div>
<style type="text/css">
   .pagination>li>a, .pagination>li>span{
         height: 40px;
   }
   .allreviews_01{color:red;}
</style>

@endsection