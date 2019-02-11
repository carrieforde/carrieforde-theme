/**
 * Alcatraz Admin JS.
 */

(function($) {
  $(document).ready(function() {
    $('#carrieforde-activation-notice .notice-dismiss').on('click', function() {
      var data = {
        action: 'carrieforde_hide_activation_notice'
      };

      $.post(ajaxurl, data, function(response) {
        // Silence is golden.
      });
    });
  });
})(jQuery);
