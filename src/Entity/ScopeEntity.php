<?php

/**
 * @file
 * Contains Drupal\oauth2_server\Entity\ScopeEntity.
 */

namespace Drupal\oauth2_server\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\oauth2_server\ScopeEntityInterface;

/**
 * Defines the Scope entity.
 *
 * @ConfigEntityType(
 *   id = "oauth2_server_scope",
 *   label = @Translation("Scope"),
 *   handlers = {
 *     "list_builder" = "Drupal\oauth2_server\ScopeEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\oauth2_server\Form\ScopeEntityForm",
 *       "edit" = "Drupal\oauth2_server\Form\ScopeEntityForm",
 *       "delete" = "Drupal\oauth2_server\Form\ScopeEntityDeleteForm"
 *     }
 *   },
 *   config_prefix = "oauth2_server_scope",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/oauth2_server_scope/{oauth2_server_scope}",
 *     "edit-form" = "/admin/structure/oauth2_server_scope/{oauth2_server_scope}/edit",
 *     "delete-form" = "/admin/structure/oauth2_server_scope/{oauth2_server_scope}/delete",
 *     "collection" = "/admin/structure/visibility_group"
 *   }
 * )
 */
class ScopeEntity extends ConfigEntityBase implements ScopeEntityInterface {
  /**
   * The Scope ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Scope label.
   *
   * @var string
   */
  protected $server;

  /**
   * The Scope label.
   *
   * @var string
   */
  protected $name;

  /**
   * The Scope label.
   *
   * @var string
   */
  protected $description;

}
