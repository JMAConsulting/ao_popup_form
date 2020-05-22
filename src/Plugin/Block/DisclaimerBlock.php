<?php
  /**
   * @file
   * Contains \Drupal\ao_popup_form\Plugin\Block\DisclaimerBlock.
   */

  namespace Drupal\ao_popup_form\Plugin\Block;

  use Drupal\Core\Block\BlockBase;
  use Drupal\Core\Form\FormInterface;

  /**
   * Provides a 'disclaimer' block.
   *
   * @Block(
   *   id = "disclaimer_block",
   *   admin_label = @Translation("Disclaimer block"),
   *   category = @Translation("Custom disclaimer block")
   * )
   */
  class DisclaimerBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {

      $form = \Drupal::formBuilder()->getForm('Drupal\disclaimer\Form\DisclaimerForm');

      return $form;
    }
  }