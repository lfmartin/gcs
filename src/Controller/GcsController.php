<?php

namespace Drupal\gcs\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Route controller for GCS.
 */
class GcsController extends ControllerBase {

  /**
   * Builds the Search Results based on the string provided.
   */
  public function buildResults($wild_card, $keys) {
    $config = \Drupal::configFactory()->get('gcs.settings');
    $element = array('#theme' => 'gcs');
    $element['#title'] = 'Page not found';
    if ($wild_card == $config->get('gcs.wildcard')) {
      $attachments = array();
      $attachments['library'][] = 'gcs/gcsLibrary';
      $attachments['drupalSettings']['gcsSettings']['gcsCX'] = $config->get('gcs.cx');
      $attachments['drupalSettings']['gcsSettings']['gcsKey'] = (!empty($keys)) ? $keys : NULL;
      $element = array(
        '#theme' => 'gcs',
        '#title' => $config->get('gcs.title'),
        '#attached' => $attachments,
      );
    }
    return $element;
  }

}
