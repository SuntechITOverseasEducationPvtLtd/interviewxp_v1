    @extends('admin.layout.master')                 


    @section('main_content')
    <!-- BEGIN Page Title -->
    
      <style>
        
        .ubuntuRegText {
    font-family: ubuntuRegular;
    font-size: 15px;
    color: #373737;
}
.list-group-item { width: 250px;
  
    float: left;
    margin: 0px 2px;     margin: 2px 2px;
    background: #dddddd1f; }

.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
}.checkbox label, .radio label {
  min-height: 20px;
    padding-left: 29px;
    margin-bottom: 0;
    font-weight: 500;
    cursor: pointer;
    font-size: 15px;
    /* margin-top: -20px; */
    color: #1e79c1;
}
 .checkbox {
    padding-top: 0px !important; }
input[type=checkbox] {
  position: absolute;
  top: 50%;
  margin-top: -6px;
  margin-left: -20px;
  opacity: 0; 
}
.checkbox span.inner {
  background-image: url(http://cloudforcehub.com/interviewxp/images/checkbox_uncheck.png);
  display: block;
  width: 20px;
  height: 20px;
  position: absolute;
  top: 50%;
  margin-left: -30px;
  margin-top: -12px;
  cursor: pointer;     padding-top:0px;
}
.checkbox input[type=checkbox]:checked ~ span {
  background-image: url(http://cloudforcehub.com/interviewxp/images/checkbox_check.png);
}
.checkbox input[type=checkbox]:checked ~ font {
color: #2bb7aa;
	text-decoration:line-through;
}

.panel {
    margin-bottom: 20px;
    border-color: #ddd;
    color: #333333;
    float: left;
    width: 100%;
}

    </style>
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
                
                <div class="col-sm-12" style="text-align: right;">
              <input type="submit"  class="btn btn-primary" value="Update">
            </div>
            
 </div>
            <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Role Name<i class="red">*</i></label>
                  <div class="col-sm-9 col-lg-9 controls" >
                      <input type="text" class="form-control" name="rolename" value="{{ $arr_data['rolename'] }}" data-rule-required="true" data-rule-maxlength="255" />
                      <span class="help-block">{{ $errors->first('rolename') }}</span>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                     <div class="row" >
         
         
         <div class="content-group border-top-lg border-top-primary" style="    margin-top: 80px;">
							<div class="page-header page-header-default page-header-xs" style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
								<div class="page-header-content">
									<div class="page-title" style="    padding-top: 6px;
    padding-bottom: 6px;">
										<h5><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Privileges For Current Role</span></h5>
									<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

								
								</div>

							</div>
						</div>
						
       
           @if(sizeof($arr_roles)>0)
                  @foreach($arr_roles as $arr_rolesF)
                  
                  
                   <?php $categoryid=$arr_rolesF['id']; $roledata = DB::table('tbl_rolename')->where('categoryid',$categoryid)->get();  ?> 
                   
                   
                   
             <div class="col-sm-12 col-lg-12 controls" > 
             
             
                <div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">	<a href="#" class="heading-text" style="font-size: 17px;   font-weight: 500;   color: #15629e;">{{ $arr_rolesF['rcname']}}</a>  Admin Setting <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
									<div class="heading-elements">
	
				                	</div>
								</div>

								<div class="list-group no-border no-padding-top">
						  @foreach($roledata as $roledataF)	 
						  
						  <?php $rolesidass=$arr_data['id']; $assroleid=$roledataF->id; $roledatacoiunt = DB::table('tbl_roles_assign')->where('roleid',$rolesidass)->where('roeassignid',$assroleid)->count(); 
						  
						  if($roledatacoiunt==1) { $checkd="checked"; } else { $checkd=""; }
						  
						  ?> 
						  
							<div class="list-group-item"><div class="checkbox ubuntuRegText">
                              <label>
                                <input type="checkbox" name="roleselect[]" value="{{ $arr_rolesF['id']}}-{{ $roledataF->id}}"  <?=$checkd;?> > <font>{{ $roledataF->rolename}}</font>
                                <span class="inner"></span>
                              </label>
                          </div></div>
                          
                          
                        
                          
                        @endforeach
                          
                          
                          
                          
								</div>
							</div>
							
							
							
							
							</div>
							
						  @endforeach
                @endif
                
               
         
                  </div>
            </div>

          
            
            <div class="form-group">
               <div class="col-sm-12" style="text-align: right;">
                <input type="submit"  class="btn btn-primary" value="Update">
            </div>
        </div>
    </form>
</div>
</div>
</div>

<!-- END Main Content -->
 
@stop                    