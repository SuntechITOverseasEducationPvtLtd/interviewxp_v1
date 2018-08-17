<style>
    .stickets_01{color:green;padding:11px 15px 0;}
.stickets_02{padding:11px 15px 0;}
.stickets_03{padding-left:18px;}
.stickets_04{height:440;}
.stickets_05{margin:0;}
</style>

@extends('front.layout.main') 
@section('middle_content')
<div id="header-home" class="home-header"></div>
<div class="banner-change-pw">
    <div class="pattern-change-pw">
        <div class="container">
            <div class="row">
            
                <!-- <div class="col-sm-12"> -->
                {{-- <div class="col-sm-9 col-md-9 col-lg-9 search">
                   <div class="input-box">
                        <form method="get" name="frm_search" action="{{url('/')}}/searchskill">
                            {{ csrf_field() }}
                           
                            <select data-placeholder="Select Skill" class="chosen-select" title="Select one" name="skill_id" id="skill_name">
                                <option value=""></option>
                                @if(isset($arr_skill) && sizeof($arr_skill)>0) @foreach($arr_skill as $skill)
                                <option value="{{$skill['id']}}">{{ucfirst($skill['skill_name'])}}</option>
                                @endforeach @endif
                            </select>
                            <div class="error" id="err_search"></div>
                            <button type="submit" class="search-btn" id="btn_find" name="btn_find" value="find">Find</button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<div class="middle-area min-height">
    <div class="container">
    @include('front.layout._operation_status')
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><img src="{{url('/')}}/images/close-img.png" alt="Interviewxp"/></button>
			<h4 class="modal-title">Rwe Tickets</h4>
			</div>
			<div id="modal-success-ticket" class=" stickets_01"></div>    
			<div id="modal-error-ticket"  class="error stickets_02"></div>
			<div id="exceed_limit" class="error stickets_03"></div>
			<div class="modal-body stickets_04" >
			<div class="row">
			</div>



			{{ csrf_field() }}

			<input type="hidden" id="unique" value="{{base64_encode($arr_realtime['id'])}}">
			<input type="hidden" id="limit">
			<div class="model-tab outer-box history-page stickets_05">
			<div class="table-responsive">
			<table class="table">
			<thead>

			<tr class="t-head">
			<td>Sr.No</td>
			<td>Checkbox</td>
			<td>Issue Title</td>
			</tr>

			</thead>
			<tbody>
			@if(isset($arr_realtime['realtime_details']) && sizeof($arr_realtime['realtime_details'])>0)
			@foreach($arr_realtime['realtime_details'] as $key => $realtime)
			<tr class="main-content">
			<td>
			{{$key+1}}
			</td>
			<td>
			<div class="ticket_check">
			<input  type="checkbox"  class="css-checkbox ads_Checkbox"
			name="check_record[]"  
			value="{{$realtime['id']}}" id="{{$realtime['id']}}" />
			<label class="css-label radGroup2" for="{{$realtime['id']}}">&nbsp;</label>
			</div>
			</td>
			<td>
			{{$realtime['issue_title']}}
			</td>
			</tr>
			@endforeach
			@endif
			</tbody>
			</table> 
			@if(isset($arr_realtime['realtime_details']) && sizeof($arr_realtime['realtime_details'])==0)
			<div class="error">No records found.</div>
			@endif

			</div>
			</div>
			</div>
			<div class="modal-footer">
			<!--<button type="button" id="create_company" onclick="javascript: return companyupload({{@$uploads['id']}});" class="submit-btn ctn">Upload</button>-->
			</div>
		</div>
	</div>
</div>
@endsection