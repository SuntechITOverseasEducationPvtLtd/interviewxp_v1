@extends('front.layout.main')
@section('middle_content')
    <div id="header-home" class="home-header"></div>
    <div class="banner-member">
        <div class="pattern-member about-banner">
        </div>
    </div>

    <!-- middle section -->
    <div class="middle-area max-height">
        <div class="container">
             <div class="view-all">
                <div class="list-heading">
                    <h2>
                    {{isset($module_name)?$module_name:''}}
                    </h2>
                  
                </div>
             
                    <div class="ul-category view-category cat-list">
                        <ul>
                           <div class="row">
                           @if(isset($result) && sizeof($result)>0 && $module_name == 'Skills')
                           @foreach($result as $skills)
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="{{url('/')}}/skill/{{base64_encode($skills['skill_name'])}}" title="{{$skills['skill_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i> {{(strlen(trim($skills['skill_name'])) > 38) ? substr(trim($skills['skill_name']),0,35).'...' : $skills['skill_name']}}</a></li>
                            @endforeach
                            @endif

                            @if(isset($result) && sizeof($result)>0 && $module_name == 'Specializations')
                              @foreach($result as $specialization)
                               <li class="col-sm-6 col-md-3 col-lg-3"><a href="{{url('/')}}/specialization/{{base64_encode($specialization['specialization_name'])}}" title="{{$specialization['specialization_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i>  {{(strlen(trim($specialization['specialization_name'])) > 38) ? substr(trim($specialization['specialization_name']),0,35).'...' : $specialization['specialization_name']}}</a></li>
                              @endforeach
                            @endif

                            @if(isset($result) && sizeof($result)>0 && $module_name == 'Qualifications')
                           @foreach($result as $qualification)
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="{{url('/')}}/qualification/{{base64_encode($qualification['id'])}}" title="{{$qualification['qualification_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i> {{(strlen(trim($qualification['qualification_name'])) > 38) ? substr(trim($qualification['qualification_name']),0,35).'...' : $qualification['qualification_name']}}</a></li>
                            @endforeach
                            @endif

                            @if(isset($result) && sizeof($result)>0 && $module_name == 'Categories')
                           @foreach($result as $category)
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="{{url('/')}}/category/{{base64_encode($category['id'])}}" title="{{$category['category_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i> {{(strlen(trim($category['category_name'])) > 38) ? substr(trim($category['category_name']),0,35).'...' : $category['category_name']}}</a></li>
                            @endforeach
                            @endif

                            @if(isset($result) && sizeof($result)>0 && $module_name == 'Companies')
                           @foreach($result as $company)
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="{{url('/')}}/company/{{base64_encode($company['company_name'])}}" title="{{$company['company_name']}}"><i class="fa fa-circle-o" aria-hidden="true"></i> {{(strlen(trim($company['company_name'])) > 38) ? substr(trim($company['company_name']),0,35).'...' : $company['company_name']}}</a></li>
                            @endforeach
                            @endif
                            <!--
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Administration / Secreatry</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Animation / Gaming</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Automobile / Auto</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Auditing / Tax / Front Office</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Accounting / Auditing / Tax</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Administration / Secreatry</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Animation / Gaming</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Automobile / Auto</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Auditing / Tax / Front Office</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Accounting / Auditing / Tax</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Administration / Secreatry</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Animation / Gaming</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Automobile / Auto</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Auditing / Tax / Front Office</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Accounting / Auditing / Tax</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Administration / Secreatry</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Animation / Gaming</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Automobile / Auto</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Architecture / Interior Design</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Advertising / PR /MR</a></li>
                            <li class="col-sm-6 col-md-3 col-lg-3"><a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> Auditing / Tax / Front Office</a></li>
                            -->
                            </div>
                        </ul>
						<div class="prod-pagination">
							{{ $result->render() }}
						</div>
                    </div>
                    
            </div>
        </div>
    </div>
@endsection

