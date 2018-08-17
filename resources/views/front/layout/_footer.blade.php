<script type="text/javascript">
$(document).ready(function(){
    
   $(document).on('click', '.videoidtake', function() {  
   
       $idvalue=$(this).attr('id');  
       
       
       $('.videouploadidhere').html('<iframe width="100%" height="315" src="https://www.youtube.com/embed/'+$idvalue+'?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" ></iframe>');
       
   });
   
   
   
});
  
  
    </script>
<script type="text/javascript">
   $('#btn_find').click(function(){
      var skill_name=$('#skill_name').val();
      if(skill_name=='' || skill_name==null)
      {
         $('#skill_name').val('');
         $('#err_search').html('Please select skill field for searching.');
         $('#skill_name').keyup(function () {  $('#err_search').html(''); });
         $("#skill_name").focus();
         return false;
      }
   });
</script>

<link href="{{url('/')}}/css/front/chosen.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/chosen.jquery.js"></script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/search-dropdown.js"></script>
   <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
<script type="text/javascript">
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>


<div class="footer-bg">
   <div class="container">
      <div class="footerdv">
         <div class="footerdiviner"><a href="{{url('/about_us')}}">About Us</a></div>
      <div class="footerdiviner"><a href="{{url('/terms_of_use')}}">Terms of use</a></div>
        <div class="footerdiviner"><a href="{{url('/privacy_policy')}}">Privacy Policy</a></div>
        <div class="footerdiviner"><a href="{{url('/careers')}}">Careers </a></div>
        <div class="footerdiviner"><a href="{{url('/contact_us')}}">Contact Us</a></div>
        <!--  <li style="border:none;"><a href="javascript:void(0)">Sitemap</a></li> -->
      </div>
      <p class="text-center">Copyright @ {{date('Y')}} interviewxp All Rights reserved</p>
   </div>
</div>

<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/bootstrap-modal.js"></script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/modalmanager.js"></script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/responsivetabs.js"></script>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/common.js"></script>

<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/jquery.rating.js"></script>
<a class="cd-top hidden-xs hidden-sm" href="">Top</a>
<script type="text/javascript" language="javascript" src="{{url('/')}}/js/front/backtotop.js"></script>
<script src="{{url('/')}}/js/front/timepicker.js"></script>
<script>
  
  $(document).ready(function () {
        $('.startTimepicker').timepicker();
        $('.endTimepicker').timepicker();
        $( ".datepicker" ).datepicker({
          dateFormat: 'yy-mm-dd' 
        });
     }); 
     
     
     
     

  </script>
  

		
		<style>
		    
		    
.footerdv { padding-bottom: 20px; padding-top: 20px; text-align: center;}
.footerdiviner {color: #fff; display: inline-block; border-right: 1px solid #fff; padding: 0 18px; font-size: 15px; font-family: 'ubunturegular',sans-serif; line-height: 13px; }
.footerdiviner a {color:#dcdcdc; letter-spacing: 0.2px;}
    
    
    
.sfooter_01{ margin-top: 40px !important;}
.sfooter_02{position: absolute; z-index 9999;  background: white; padding:3px; border-radius:10px;  right:0px;}
.sfooter_03{width:100%"}    
    
		</style>
		
		
		
		
		
		
		
		
		
		<div class="modal fade popup-cls in" id="videoplayintro" style="margin-top: 40px !important;" role="dialog" aria-hidden="false" tabindex="-1">
				  <div class="modal-dialog">
					 <div class="modal-content">
					
					
					  <button type="button" class="close sfooter_02" data-dismiss="modal" >
					      <img src="http://cloudforcehub.com/interviewxp/images/close-img.png" alt="Interviewxp"></button>
					 
						<div class="videouploadidhere sfooter_03">
				<iframe width="100%" height="315" src="https://www.youtube.com/embed/VFTNOF77bMs?rel=0&amp;controls=0&amp;showinfo=0" 
					frameborder="0" allow="autoplay; encrypted-media"></iframe>
						</div>
				 
					   
						<!--end-->
					 </div>
					 
				  </div>
			   </div>
		
		 
		 
		 
		 
		 
		 
		 
		 

</body>
</html>