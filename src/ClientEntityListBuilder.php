<?php

/**
 * @file
 * Contains Drupal\oauth2_server\ClientEntityListBuilder.
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Client entities.
 *
 * @ingroup oauth2_server
 */
class ClientEntityListBuilder extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Client ID');
    $header['server'] = $this->t('Server');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\oauth2_server\Entity\ClientEntity */
    $row['id'] = $entity->id();
    $row['server'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.oauth2_server_client.edit_form', array(
          'oauth2_server_client' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
