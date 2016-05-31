<?php

namespace Drupal\gcs\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides 'Google Custom Search' block.
 *
 * @Block(
 *   id = "gcs_block",
 *   admin_label = @Translation("Google Custom Search block"),
 * )
 */
class GcsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\gcs\Form\GcsForm');
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return AccessResult::allowedIfHasPermission($account, 'access gcs');
  }

}
