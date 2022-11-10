
(function ($, global) {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    //   $('.siderbar1 a').on('click', function(e) {
    //     e.preventDefault();
    //     $('.siderbar1 a').removeClass('active');
    //     $(this).addClass('active');
    // }) 
      
})(jQuery, window);