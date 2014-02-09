(function($) {

  $(window).on("load resize",function(e){
    var allPanels = $('.Section .Section-content');

    if ( $(window).width() < 400 ) {
      // mobile-ish
      $('.Session-item, .Speakers-speaker').css({height: 'auto'});

      allPanels.hide();
      $('.Section .Section-title').click(function(e) {
        e.preventDefault();
        allPanels.hide();
        $(this).parent().find('.Section-content').slideDown(100);
      });


    } else if ( $(window).width() >= 400 ) {
      // pad-screen-ish
      allPanels.show();

      var navHeight = $('.Navigation').outerHeight();
      $('body').css( {
        position: 'relative',
        top: navHeight + 'px'
      } );

        var currentTallest = 0,
       currentRowStart = 0,
       rowDivs = new Array(),
       $el,
       topPosition = 0;

      $('.Session-item, .Speakers-speaker').each(function() {

        $el = $(this);
        topPostion = $el.position().top;

        if (currentRowStart != topPostion) {

          // we just came to a new row.  Set all the heights on the completed row
          for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
          }

          // set the variables for the new row
          rowDivs.length = 0; // empty the array
          currentRowStart = topPostion;
          currentTallest = $el.height();
          rowDivs.push($el);

        } else {

          // another div on the current row.  Add it to the list and check if it's taller
          rowDivs.push($el);
          currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

       }

       // do the last row
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
          rowDivs[currentDiv].height(currentTallest);
        }

      });

    }

  });

})(jQuery);

