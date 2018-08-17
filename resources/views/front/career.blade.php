<style>
    .scareer-form_03{display:none !important}

</style>

@extends('front.layout.main')
@section('middle_content')
      <div class="banner-member">
         <div class="pattern-member about-banner">
            
         </div>
      </div>
       <!-- middle section -->
       
         <div class="career-inner-pages careers">
         <div class="container">
            <div class="title-inner">
               <h2>We have requirements for</h2>
            </div>
         </div>
         <div class="container">
            <div class="row">
               <div class="col-sm-12 col-d-12 col-lg-12">
                  <input type="hidden" name="currentdiv" value="" id="currentdiv" />
                  <div class="row">
                     <div class="col-sm-12 col-d-12 col-lg-12">
                         
                         @if(isset($arr_data) && sizeof($arr_data)>0)
                
                  @foreach($arr_data as $key=> $data)
                         <div class="career-insite">
                           <div class="career-insite-in">
                              <div class="career-min">
                                 <div class="career-hide-show" onclick="return opendiv('{{$key+1}}');" id="arrow{{$key+1}}">
                                    <div class="career-search-here php-icon">
                                       <div class="career-title">
                                          <h5>{{ $data['jobtitle'] }}</h5>
                                       </div>
                                       <div class="career-desk">{{ $data['experience'] }} Experience</div>
                                       <div class="clr"></div>
                                    </div>
                                 </div>
                                 <div class="career-hide-inner .scareer-form_03" id="div{{$key+1}}">
                                    <div class="row">
                                       <div class="col-sm-12 col-md-12 col-lg-12">
                                          <div class="career-types-title">Number of Vacancies : <span>{{ $data['opening'] }}</span></div>
                                          <div class="career-types-profile">Job Responsibilities :</div>
                                     
                                     <?=html_entity_decode($data['jobdescription']);?>
                                       </div>
                                      
                                    </div>
                                    <div class="clearfix"></div>
                                   
                                    
                                    <div class="contact-no">
                                    <div class="career-send-cv">Send Your CV at&nbsp; <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></div>
                                    <div class="career-send-cv">Phone Number {{ $data['phone'] }}</div>
                                   </div>
                                    <div class="apply-w"><a href="{{url('/')}}/careers_form/{{ base64_encode($data['id']) }}"><button class="submit-btn ctn">Apply Now</button></a></div>
                                    
                                 </div>
                                 <div class="clr"></div>
                              </div>
                              <div class="clr"></div>
                           </div>
                        </div>


@endforeach
@endif
                        
                       
                        
                        <div class="clr"></div>
                     </div>
                     <div class="clr"></div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clr"></div>
       
      </div>   
            
         <script type="application/javascript">
         function opendiv(id) {
             var current = $("#currentdiv").val();
             $("#currentdiv").val(id);
             for (var i = 1; i <= 10; i++) {
                 if (id != i) {
                     $("#div" + i).hide('slow');
                     $('#arrow' + i).removeClass("career-hide-show-up");
                 }
             }
             $('#arrow' + id).addClass("career-hide-show-up");
             $('#div' + id).slideToggle("slow", function() {
                 if (current == id) {
                     $('#arrow' + current).removeClass("career-hide-show-up");
                     $("#currentdiv").val('');
                 }
             });
         }
         
      </script>
@endsection