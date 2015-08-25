<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Entity\ClientEntity.
 */

namespace Drupal\oauth2_server\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Client entities.
 */
class ClientEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['oauth2_server_client']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Client'),
      'help' => $this->t('The Client ID.'),
    );

    return $data;
  }

}
