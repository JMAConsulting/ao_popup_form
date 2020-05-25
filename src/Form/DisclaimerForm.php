<?php
  /**
   * @file
   * Contains \Drupal\disclaimer\Form\DisclaimerForm.
   */
  namespace Drupal\disclaimer\Form;

  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;
  use Drupal\disclaimer\HideModalCommand;
  use Drupal\Core\Controller\ControllerBase;
  use Drupal\Core\Ajax\AjaxResponse;
  use Drupal\Core\Ajax\ReplaceCommand;


  class disclaimerForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
      return 'disclaimer_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

      if (\Drupal::languageManager()->getCurrentLanguage()->getId() == 'fr') {
        $markup = "<div class=\"disclaimer\">
<div class=\"content\">
<p>Il est important d’effectuer votre propre recherche et de prendre vos propres décisions éclairées. Veuillez noter qu’Autisme Ontario ne cautionne aucune thérapie, aucun produit, aucun traitement, aucune stratégie, aucune opinion, aucun service ou aucune personne en particulier. Nous appuyons cependant votre droit à l’information.</p>

<p>Cliquez <a data-entity-substitution=\"file\" data-entity-type=\"file\" data-entity-uuid=\"aaa34767-aa89-4fc6-bd83-bda3c6d6286b\" href=\"/sites/default/files/2020-05/Site%20Disclaimer_Christa_BIL.pdf\">ici</a> pour lire l’avertissement d’Autisme Ontario dans son intégralité.</p>

<p>";
        $acknowledgement = "Je reconnais que j’ai lu les avertissements et les limitations de responsabilité d’Autisme Ontario.";
      }
      else {
        $markup = "<div class=\"disclaimer\">
<div class=\"content\">
<p>It is important to do your own research and make your own informed decisions. Please note that Autism Ontario does not endorse any specific therapy, product, treatment, strategy, opinions, service, or individual. We do, however, endorse your right to information.</p>

<p>Click <a data-entity-substitution=\"file\" data-entity-type=\"file\" data-entity-uuid=\"aaa34767-aa89-4fc6-bd83-bda3c6d6286b\" href=\"/sites/default/files/2020-05/Site%20Disclaimer_Christa_BIL.pdf\">here</a> to read Autism Ontario’s full disclaimer.</p>

<p>";
        $acknowledgement = "I acknowledge that I have read Autism Ontario’s disclaimers and limitations of liability.";
      }
      $form['#prefix'] = '<div id="disclaimer_form">';
      $form['#suffix'] = '</div>';

      $form['help'] = [
        '#type' => 'markup',
        '#markup' => $markup,
      ];

      $form['acknowledge'] = array(
        '#type' => 'checkbox',
        '#title' => $acknowledgement,
        '#required' => TRUE,
      );

      $form['help_2'] = [
        '#type' => 'markup',
        '#markup' => "</p></div>
     </div>
     ",
      ];

      $form['actions']['#type'] = 'actions';
      $form['actions']['clear'] = [
        '#type' => 'submit',
        '#value' => t('Close'),
        '#attributes' => [
          'class' => ['use-ajax'],
        ],
        '#ajax'  => [
          'callback' => [$this, 'submitModalFormAjax'],
          'event' => 'click',
        ],
      ];
      $form['#attached']['library'][] = 'core/drupal.dialog.ajax';
      $form['#attached']['library'][] = 'disclaimer/disclaimer';

      return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {


    }

  /**
   * AJAX callback handler that displays any errors or a success message.
   */
  public function submitModalFormAjax(array $form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    // If there are any form errors, re-display the form.
    if ($form_state->hasAnyErrors()) {
      $form['status_messages'] = [
        '#type' => 'status_messages',
        '#weight' => -1000,
      ];
      $response->addCommand(new ReplaceCommand('#disclaimer-form', $form));
    }
    else {
      //Close the modal.
      $command = new HideModalCommand('.block-disclaimerblock-modal', TRUE);
      $response->addCommand($command);
    }
    return $response;
  }

}
