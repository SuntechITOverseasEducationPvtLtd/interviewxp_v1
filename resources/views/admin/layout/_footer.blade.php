               <div class="footer text-muted">
                    <p style="    padding-left: 30px;">{{date('Y')}} © {{ config('app.project.name') }} Admin.</p>
            </div>

                <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
    

        

        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/additional-methods.js"></script>
    
        <script src="{{ url('/') }}/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="{{ url('/') }}/assets/jquery-cookie/jquery.cookie.js"></script>

        <!--page specific plugin scripts-->
        <script src="{{ url('/') }}/assets/flot/jquery.flot.js"></script>
        <script src="{{ url('/') }}/assets/flot/jquery.flot.resize.js"></script>
        <script src="{{ url('/') }}/assets/flot/jquery.flot.pie.js"></script>
        <script src="{{ url('/') }}/assets/flot/jquery.flot.stack.js"></script>
        <script src="{{ url('/') }}/assets/flot/jquery.flot.crosshair.js"></script>
        {{--<script src="{{ url('/') }}/assets/flot/jquery.flot.tooltip.min.js"></script>--}}
        <script src="{{ url('/') }}/assets/sparkline/jquery.sparkline.min.js"></script>

        <script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-switch/static/js/bootstrap-switch.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
        <script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/ckeditor/ckeditor.js"></script> 
        <script type="text/javascript" src="{{ url('/') }}/assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

        <script src="{{ url('/') }}/assets/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
         <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <!--flaty scripts-->
        <script src="{{ url('/') }}/js/admin/flaty.js"></script>
        <script src="{{ url('/') }}/js/admin/flaty-demo-codes.js"></script>
        <script src="{{ url('/') }}/js/admin/validation.js"></script>
        <script src="{{ url('/') }}/js/admin/loading.js"></script>

<style>
    
    
    .table > tbody > tr > td, .table > tfoot > tr > td {
  
    border: 0px !important;
    
    }
    
  .table > thead:first-child > tr:first-child > th {
    border: 0px;
}
</style>

    </body>
</html>
