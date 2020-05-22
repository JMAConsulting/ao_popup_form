<?php
  /**
   * @file
   * Contains \Drupal\disclaimer\Form\DisclaimerForm.
   */
  namespace Drupal\disclaimer\Form;

  use Drupal\Core\Form\FormBase;
  use Drupal\Core\Form\FormStateInterface;

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

      $form['actions']['clear'] = [
        '#type' => 'button',
        '#value' => t('Close'),
        '#attributes' => [
          'onclick' => 'return false;',
          'class' => 'spb_close',
        ],
      ];
      return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {


    }
  }