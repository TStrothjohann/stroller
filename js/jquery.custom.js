// Materialize Pushpin

var guid = (function() {
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);
  }
  return function() {
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
           s4() + '-' + s4() + s4() + s4();
  };
})();

(function ($) {
  $(document).ready(function() {

    $.fn.pushpin = function (options) {

      var defaults = {
        top: 0,
        bottom: Infinity,
        offset: 0
      }
      options = $.extend(defaults, options);

      $index = 0;
      return this.each(function() {
        var $uniqueId = guid(),
            $this = $(this),
            $original_offset = $(this).offset().top;

        function removePinClasses(object) {
          object.removeClass('pin-top');
          object.removeClass('pinned');
          object.removeClass('pin-bottom');
        }

        function updateElements(objects, scrolled) {
          objects.each(function () {
            // Add position fixed (because its between top and bottom)
            if (options.top <= scrolled && options.bottom >= scrolled && !$(this).hasClass('pinned')) {
              removePinClasses($(this));
              $(this).css('top', options.offset);
              $(this).addClass('pinned');
            }

            // Add pin-top (when scrolled position is above top)
            if (scrolled < options.top && !$(this).hasClass('pin-top')) {
              removePinClasses($(this));
              $(this).css('top', 0);
              $(this).addClass('pin-top');
            }

            // Add pin-bottom (when scrolled position is below bottom)
            if (scrolled > options.bottom && !$(this).hasClass('pin-bottom')) {
              removePinClasses($(this));
              $(this).addClass('pin-bottom');
              $(this).css('top', options.bottom - $original_offset);
            }
          });
        }

        updateElements($this, $(window).scrollTop());
        $(window).on('scroll.' + $uniqueId, function () {
          var $scrolled = $(window).scrollTop() + options.offset;
          updateElements($this, $scrolled);
        });

      });

    };


  });
}( jQuery ));


  jQuery(document).ready(function(){
    if(jQuery('#mainnav').length > 0){
      jQuery('#mainnav').pushpin( { top: jQuery('#mainnav').offset().top } );
    }
  });


//Countdown

if(document.getElementById('countdown')){
  // set the date we're counting down to
  var target_date = new Date('July, 30, 2016').getTime();
   
  // variables for time units
  var days, hours, minutes, seconds;
   
  // get tag element
  var countdown = document.getElementById('countdown');
   
  // update the tag with id "countdown" every 1 second
  setInterval(function () {
   
      // find the amount of "seconds" between now and target
      var current_date = new Date().getTime();
      var seconds_left = (target_date - current_date) / 1000;
   
      // do some time calculations
      days = parseInt(seconds_left / 86400);
      seconds_left = seconds_left % 86400;
       
      hours = parseInt(seconds_left / 3600);
      seconds_left = seconds_left % 3600;
       
      minutes = parseInt(seconds_left / 60);
      seconds = parseInt(seconds_left % 60);
       
      // format countdown string + set tag value
      countdown.innerHTML = 'in... <span class="days">' + days +  ' <b>Tagen,</b> </span><span class="hours">' + hours + ' <b>Stunden,</b> </span> <span class="minutes">'
      + minutes + ' <b>Minuten und</b></span> <span class="seconds">' + seconds + ' <b>Sekunden.</b></span>';  
   
  }, 1000);
}