<?php

/**
 * @file
 * Contains Drupal\oauth2_server\ClientListBuilder.
 */

namespace Drupal\oauth2_server;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of The OAuth2 Client entities.
 *
 * @ingroup oauth2_server
 */
class ClientListBuilder extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('The OAuth2 Client ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\oauth2_server\Entity\Client */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
      $this->getLabel($entity),
      new Url(
        'entity.client.edit_form', array(
          'client' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
