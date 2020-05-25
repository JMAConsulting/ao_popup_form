(function ($, Drupal) {

  Drupal.AjaxCommands.prototype.closeModal = function (ajax, response, status) {
    var $dialog = $(response.selector);
    if ($dialog.length) {
      $dialog.hide();
    }
  };

})(jQuery, Drupal);
