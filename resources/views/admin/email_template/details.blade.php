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
              
              <?php $mailcategory=$arr_data['mailcategory'];  $templatec = DB::table('tbl_mail_category') ->where(['id'=>$mailcategory])->get(); ?>
              
                   <div id="myTabContent1" class="tab-content">

                

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_title">Template Category:</label>
                  <div class="col-sm-6 col-lg-4 controls">
                     {{$templatec[0]->name}} 
                  </div>
                </div>

               

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="meta_desc">Subject:</label>
                  <div class="col-sm-6 col-lg-4 controls">
 {{$arr_data['subject']}}
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label" for="page_desc">Mail Body: </label>
                  <div class="col-sm-6 col-lg-8 controls">
                 
                    
                             <?=html_entity_decode($arr_data['bodytext']);?>
                  </div>
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
