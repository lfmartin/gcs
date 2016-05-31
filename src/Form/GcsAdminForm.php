<?php

namespace Drupal\gcs\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Google Custon Search Settings form.
 */
class GcsAdminForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'gcs_admin_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::configFactory()->get('gcs.settings');

    $form['google_cse_cx'] = array(
      '#type' => 'textfield',
      '#title' => t('Google Custom Search Engine ID'),
      '#required' => TRUE,
      '#description' => t("Enter your Google CSE unique ID."),
      '#default_value' => $config->get('gcs.cx'),
    );
    $form['google_cse_route_wildcard'] = array(
      '#type' => 'textfield',
      '#title' => t('Wildcard URL component'),
      '#required' => TRUE,
      '#description' => t("Enter the wildcard URL component that should be used to build the Search Results Page. The default value is 'google'"),
      '#default_value' => $config->get('gcs.wildcard'),
    );
    $form['google_cse_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title of Search Results Page'),
      '#description' => t("Enter the title of the Search Results Page. Leave empty if there is none."),
      '#default_value' => $config->get('gcs.title'),
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Save',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::configFactory()->getEditable('gcs.settings')
      ->set('gcs.cx', $form_state->getValues()['google_cse_cx'])
      ->set('gcs.wildcard', $form_state->getValues()['google_cse_route_wildcard'])
      ->set('gcs.title', $form_state->getValues()['google_cse_title'])
      ->save();
  }

}
