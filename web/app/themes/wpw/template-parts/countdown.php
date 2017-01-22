<?php
$divName = uniqid('clockdiv_');
?>
<div id="<?php echo $divName?>" class="clock">
  <div>
    <span class="days"></span>
    <div class="smalltext"><?php pll_e('Days');?></div>
  </div>
  <div>
    <span class="hours"></span>
    <div class="smalltext"><?php pll_e('Hours');?></div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext"><?php pll_e('Minutes');?></div>
  </div>
  <div class="hidden-xs">
    <span class="seconds"></span>
    <div class="smalltext"><?php pll_e('Seconds');?></div>
  </div>
</div>

<script>
(function ($) {
    "use strict"; // Start of use strict

    function getTimeRemaining(endtime) {
      var t = Date.parse(endtime) - Date.parse(new Date());
      var seconds = Math.floor((t / 1000) % 60);
      var minutes = Math.floor((t / 1000 / 60) % 60);
      var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
      var days = Math.floor(t / (1000 * 60 * 60 * 24));
      return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
      };
    }

    function initializeClock(id, endtime) {
      var clock = document.getElementById(id);
      var daysSpan = clock.querySelector('.days');
      var hoursSpan = clock.querySelector('.hours');
      var minutesSpan = clock.querySelector('.minutes');
      var secondsSpan = clock.querySelector('.seconds');

      function updateClock() {
        var t = getTimeRemaining(endtime);

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
          clearInterval(timeinterval);
        }
      }

      updateClock();
      var timeinterval = setInterval(updateClock, 1000);
    }

    initializeClock('<?php echo $divName?>', '<?php echo esc_html_e($attributes['date'])?>');
})(jQuery); // End of use strict
</script>
