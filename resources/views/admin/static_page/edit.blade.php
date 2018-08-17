    @extends('admin.layout.master')


    @section('main_content')
    <!-- BEGIN Page Title -->
   <div class="row">
  <div class="col-md-12">

    <div class="panel panel-flat" style="padding: 20px">
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

  
 
      <div class="box-content" style="padding: 20px">

            @include('admin.layout._operation_status') 

            <div class="tabbable">

              {!! Form::open([ 'url' => $module_url_path.'/update',
               'method'=>'POST',
               'enctype' =>'multipart/form-data',   
               'class'=>'form-horizontal', 
               'id'=>'validation-form' 
               ]) !!} 

               <ul  class="nav nav-tabs">
                @include('admin.layout._multi_lang_tab')
              </ul>                                
              <div id="myTabContent1" class="tab-content">
                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Page Title<i class="red">*</i></label>
                  <div class="col-sm-6 col-lg-4 controls">
                    
                        {!! Form::text('page_title',$arr_data['page_title'],['class'=>'form-control','data-rule-required'=>'true' ,'readonly','data-rule-maxlength'=>'255','placeholder'=>'Page Title']) !!}
                        
                    <span class='help-block'>{{ $errors->first('page_title') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_keyword">Meta Keyword<i class="red">*</i></label>
                  <div class="col-sm-6 col-lg-4 controls">
                  
                    
                        {!! Form::text('meta_keyword',$arr_data['meta_keyword'],['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'255','placeholder'=>'Meta Keyword']) !!}
                    
                    <span class='help-block'>{{ $errors->first('meta_keyword') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_desc">Meta Description
                       
                          <i class="red">*</i>
                       
                  </label>
                  <div class="col-sm-6 col-lg-4 controls">

                    
                        {!! Form::text('meta_desc',$arr_data['meta_desc'],['class'=>'form-control','data-rule-required'=>'true','data-rule-maxlength'=>'255','placeholder'=>'Meta Description']) !!}
                    
                       

                    <span class='help-block'>{{ $errors->first('meta_desc') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_desc">Page Content<i class="red">*</i></label>
                  <div class="col-sm-6 col-lg-8 controls">
                    

                    
                        {!! Form::textarea('page_desc',$arr_data['page_desc'],['class'=>'form-control','data-rule-required'=>'true','placeholder'=>'Page Content']) !!}
                    
                    <span class='help-block'>{{ $errors->first('page_desc') }}</span>
                  </div>
                </div>
              </div>
             <input type="hidden" name="enc_id" value="{{$enc_id}}"> 
            </div>
            
            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                {!! Form::submit('Update',['class'=>'btn btn btn-primary','value'=>'true','onclick'=>'saveTinyMceContent()'])!!}
              </div>
            </div>
            {!! Form::close() !!}
          </div>

        </div>
      </div>
    </div>

  <!-- END Main Content -->

  <script type="text/javascript">

    function saveTinyMceContent()
    {
      tinyMCE.triggerSave();
    }

    $(document).ready(function()
    {
      tinymce.init({
        selector: 'textarea',
        height:350,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code'
        ],
        valid_elements : '*[*]',
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '//www.tinymce.com/css/codepen.min.css'
        ]
      });  
    });
  </script>

  @stop
