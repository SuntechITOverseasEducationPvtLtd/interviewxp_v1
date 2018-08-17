@extends('admin.layout.master')                
@section('main_content')    
 <!-- BEGIN Page Title -->
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

          @include('admin.layout._operation_status')  
           {!! Form::open([ 'url' => $module_url_path.'/update',
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Experience Level</label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" readonly="" name="exp_level" placeholder="Enter Experience Level" data-rule-required="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['exp_level'])?$arr_data['exp_level']:'' }}" />
                      <span class="help-block">{{ $errors->first('exp_level') }}</span>
                  </div>
            </div>
               <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Validity<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="validity" placeholder="Enter Validity" data-rule-required="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['validity'])?$arr_data['validity']:'' }}" />
                      <span class="help-block">{{ $errors->first('validity') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Reference Book Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="ref_book_price" placeholder="Enter Reference Book Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['ref_book_price'])?$arr_data['ref_book_price']:'' }}" />
                      <span class="help-block">{{ $errors->first('ref_book_price') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Combo(Coach + Q&A) Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="combo_coach_interview_qa" placeholder="Enter Combo(Coach + Q&A) Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['combo_coach_interview_qa'])?$arr_data['combo_coach_interview_qa']:'' }}" />
                      <span class="help-block">{{ $errors->first('combo_coach_interview_qa') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Interview Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="interview_price" placeholder="Enter Interview Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['interview_price'])?$arr_data['interview_price']:'' }}" />
                      <span class="help-block">{{ $errors->first('interview_price') }}</span>
                  </div>
            </div>
			<div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">5 Companies price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="price_for_5_companies" placeholder="Enter 5 Companies Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['price_for_5_companies'])?$arr_data['price_for_5_companies']:'' }}" />
                      <span class="help-block">{{ $errors->first('price_for_5_companies') }}</span>
                  </div>
            </div>
			<div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">10 Companies price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="price_for_10_companies" placeholder="Enter 10 Companies Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['price_for_10_companies'])?$arr_data['price_for_10_companies']:'' }}" />
                      <span class="help-block">{{ $errors->first('price_for_10_companies') }}</span>
                  </div>
            </div>
			<div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">20 Companies price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="price_for_20_companies" placeholder="Enter 20 Companies Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['price_for_20_companies'])?$arr_data['price_for_20_companies']:'' }}" />
                      <span class="help-block">{{ $errors->first('price_for_20_companies') }}</span>
                  </div>
            </div>
			

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Combo(Coach + Company) Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="combo_coach_company" placeholder="Enter Combo(Coach + Company) Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['combo_coach_company'])?$arr_data['combo_coach_company']:'' }}" />
                      <span class="help-block">{{ $errors->first('combo_coach_company') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Training Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="training_price" placeholder="Enter Training Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['training_price'])?$arr_data['training_price']:'' }}" />
                      <span class="help-block">{{ $errors->first('training_price') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">25 Ticket Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="price_for_25_ticket" placeholder="Enter 25 Ticket Price" data-rule-required="true" data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['price_for_25_ticket'])?$arr_data['price_for_25_ticket']:'' }}" />
                      <span class="help-block">{{ $errors->first('price_for_25_ticket') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">50 Ticket Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="price_for_50_ticket" placeholder="Enter 50 Ticket Price" data-rule-required="true" data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['price_for_50_ticket'])?$arr_data['price_for_50_ticket']:'' }}" />
                      <span class="help-block">{{ $errors->first('price_for_50_ticket') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">75 Ticket Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="price_for_75_ticket" placeholder="Enter 75 Ticket Price" data-rule-required="true" data-rule-digits="true"{{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['price_for_75_ticket'])?$arr_data['price_for_75_ticket']:'' }}" />
                      <span class="help-block">{{ $errors->first('price_for_75_ticket') }}</span>
                  </div>
            </div>

            <div class="form-group" style="margin-top: 25px;">
                  <label class="col-sm-3 col-lg-2 control-label">Combo(Coach + Work Exp) Price<i style="color: red;">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="combo_coach_realissues" placeholder="Enter Combo(Coach + Work Exp) Price" data-rule-required="true"  data-rule-digits="true" {{-- data-rule-lettersonly="true" --}}  value="{{ isset($arr_data['combo_coach_realissues'])?$arr_data['combo_coach_realissues']:'' }}" />
                      <span class="help-block">{{ $errors->first('combo_coach_realissues') }}</span>
                  </div>
            </div>

            <input type="hidden" name="enc_id" value="{{isset($enc_id)?$enc_id:''}}"  >


            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
               
                {!! Form::submit('Update',['class'=>'btn btn btn-primary','value'=>'true'])!!}
                
              </div>
            </div>
    
          {!! Form::close() !!}
      </div>
    </div>
  </div>
  
  <!-- END Main Content -->     
@stop                    
