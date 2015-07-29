<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 27/07/15
 * Time: 4:50 PM
 */

namespace Drupal\oauth2_server;
use

  Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

class ClientListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('OAuth2_Server implements a Clients model. These clients are fieldable entities. You can manage the fields on the <a href="@adminlink">Clients admin page</a>.', array(
        '@adminlink' => \Drupal::urlGenerator()->generateFromRoute('oauth2_server.client_settings'),
      )),
    );
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the client list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    //@TODO - Change these to match the client entity
    $header['id'] = $this->t('ContactID');
    $header['name'] = $this->t('Name');
    $header['first_name'] = $this->t('First Name');
    $header['gender'] = $this->t('Gender');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    //@TODO - Change these to match the client entity
    /* @var $entity \Drupal\content_entity_example\Entity\Contact */
    $row['id'] = $entity->id();
    $row['name'] = $entity->link();
    $row['first_name'] = $entity->first_name->value;
    $row['gender'] = $entity->gender->value;
    return $row + parent::buildRow($entity);
  }
}