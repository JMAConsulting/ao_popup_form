(function ($, Drupal) {
    $('#edit-clear').click(function(e) {
      if ($('#edit-acknowledge').is(":checked")) {
        $('.block-disclaimerblock-modal').hide();
        startTheScroll();
        e.preventDefault();
        return false;
      }
    });
})(jQuery, Drupal);
