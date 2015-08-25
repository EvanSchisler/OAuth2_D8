<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Entity\Client.
 */

namespace Drupal\oauth2_server\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for The OAuth2 Client entities.
 */
class ClientViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['client']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('The OAuth2 Client'),
      'help' => $this->t('The The OAuth2 Client ID.'),
    );

    return $data;
  }

}
