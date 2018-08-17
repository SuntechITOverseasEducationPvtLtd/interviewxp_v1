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

  
 
      <div class="box-content" style="    padding: 30px;">
          
          @include('admin.layout._operation_status')  
          {!! Form::open([ 'url' => $module_url_path.'/update/'.$enc_id,
                                 'method'=>'POST',
                                 'enctype' =>'multipart/form-data',   
                                 'class'=>'form-horizontal', 
                                 'id'=>'validation-form' 
                                ]) !!} 

           {{ csrf_field() }}

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">First Name<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="first_name" value="{{ $obj_user->first_name }}" data-rule-required="true" data-rule-lettersonly="true" data-rule-maxlength="255" />
                      <span class="help-block">{{ $errors->first('first_name') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Last Name<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="last_name" value="{{ $obj_user->last_name  }}" data-rule-required="true" data-rule-lettersonly="true" data-rule-maxlength="255" />
                      <span class="help-block">{{ $errors->first('last_name') }}</span>
                  </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Email<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-4 controls" >
                      <input type="text" class="form-control" name="email" value="{{ $obj_user->email  }}" data-rule-required="true" data-rule-maxlength="255" data-rule-email="true"/>
                      <span class="help-block">{{ $errors->first('email') }}</span>
                  </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                <input type="submit"  class="btn btn-primary" value="Update">
            </div>
        </div>
    </form>
</div>
</div>
</div>

<!-- END Main Content -->
 
@stop                    