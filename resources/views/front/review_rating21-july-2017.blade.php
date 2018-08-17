@extends('front.layout.main')
@section('middle_content')
   
    <div class="banner-change-pw">
        <div class="pattern-change-pw">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-changepw">Review Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle-area min-height">
        <div class="container">

            <!--tab-->
            <form method="POST" action="{{url('/add_review')}}" id="frm_review_rating">

            {{csrf_field()}}
            <div class="col-sm-12">
                <!--<section id="id1" style="display: block;">-->
                    <div class="write-rev">
                        <h4>Please rate your experience<span class="star">*</span></h4>
                        <div class="star-wrapper">
                            <div class="starrr">
                                <input class="star required" type="radio" required="" name="review_star" value="1" />
                                <input class="star" type="radio" name="review_star" value="2" />
                                <input class="star" type="radio" name="review_star" value="3" />
                                <input class="star" type="radio" name="review_star" value="4" />
                                <input class="star" type="radio" name="review_star" value="5" />
                            </div>
                            <div class="clearfix"></div>
                            <div class="error">{{ $errors->first('review_star') }}</div>
                        </div>
                    </div>
                    <div class="rev-social">
                        <div class="form-group">
                            <label class="p-bottom">Add Review<span class="star">*</span></label>
                            <textarea class="text-area" data-rule-required="true" data-rule-maxlength="300" cols="30" rows="5" name="review" placeholder="Add Review"></textarea>
                        </div>
                        
                        <div class="error">{{ $errors->first('review') }}</div>
                        <!--inline checkbox-->
                        <div class="user-box">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="form-lable p-top">Share with Friends</div>
                                </div>
                                <div class="col-sm-12 col-md-9 col-lg-10">
                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox_0ua4"></div>
                                   <!-- <div class="radio-btns">
                                        <div class="check-box d-inlin">
                                            <input checked="checked" class="css-checkbox" id="radio1" name="radiog_dark" type="checkbox">
                                            <label class="css-label radGroup2" for="Radio1">Facebook</label>
                                            <div class="check"></div>
                                        </div>
                                        <div class="check-box d-inlin">
                                            <input class="css-checkbox" id="radio2" name="radiog_dark" type="checkbox">
                                            <label class="css-label radGroup2" for="Radio2">Twitter</label>
                                            <div class="check">
                                                <div class="inside"></div>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!--end-->
                        <!--upload resume section-->
                        <!--<div class="form-group  m-top">
                        <label>Attach Photos to this Reviews (Optional)</label>
                        <div class="user-box row">
                           <div class="col-sm-12 col-md-12 col-lg-12">
                              <input id="profile_image" style="visibility:hidden; height: 0;" name="file" type="file">
                              <div class="input-group m-top">
                                 <div class="btn btn-primary btn-file btn-green">
                                    <a class="file" onclick="browseImage()">File Upload</a>
                                 </div>
                                 <div class="btn btn-primary btn-file remove" style="border-right: 1px solid rgb(251, 251, 251) ! important; display: none;" id="btn_remove_image">
                                    <a class="file" onclick="removeBrowsedImage()"><i class="fa fa-trash"></i>
                                    </a>
                                 </div>
                                 <input class="form-control file-caption  kv-fileinput-caption back-gray" id="profile_image_name" disabled="disabled" type="text">
                              </div>
                           </div>
                           <div class="clearfix"></div>
                        </div>
                        
                     </div>-->
                        <!--end-->
                        <div class="m-top">
                    <input type="hidden" name="enc_user" value="{{isset($user_id)?$user_id:''}}">
                    <input type="hidden" name="enc_interview" value="{{isset($interview_id)?$interview_id:''}}">
                    <input type="hidden" name="enc_unique" value="{{isset($unique_id)?$unique_id:''}}">
					<input  type="hidden" name="reviewType" id="reviewType" value="" />
					<input  type="hidden" name="reviewTypeID" id="reviewTypeID" value="" />
                    <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </div>

                <!--</section>-->
            </div>

            <!--end-->
            </form>
        </div>
    </div>
    <script type="text/javascript">
   $("#frm_review_rating").validate({
         errorElement: 'div',
         errorClass: 'error',
         highlight: function (element) {
             $(element).removeClass('error');
         }
   });
   
  
</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5494209d1723c6e6"></script>
@endsection    