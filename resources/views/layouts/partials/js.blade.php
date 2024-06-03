<!-- latest jquery-->
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('js/sidebar-menu.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<!-- Plugins JS start-->
@stack('scripts')
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/theme-customizer/customizer.js') }}"></script>
<!-- login js-->
<!-- Plugin used-->
<script>
  
    /*------------------------------------------
    --------------------------------------------
    Add Loading When fire Ajax Request
    --------------------------------------------
    --------------------------------------------*/
    $(document).ajaxStart(function() {
        $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    });
  
    /*------------------------------------------
    --------------------------------------------
    Remove Loading When fire Ajax Request
    --------------------------------------------
    --------------------------------------------*/
    $(document).ajaxStop(function() {
        $('#loading').removeClass('loading');
        $('#loading-content').removeClass('loading-content');
    });
      
</script>