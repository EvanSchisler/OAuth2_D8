<?php
/**
 * Created by PhpStorm.
 * User: eschisler
 * Date: 24/08/15
 * Time: 1:32 PM
 */

namespace Drupal\oauth2_server\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;
use Drupal\oauth2_server\ScopeInterface;


/**
 * Defines a scope configuration entity class.
 *
 * @ConfigEntityType(
 *   id = "scope",
 *   label = @Translation("Scope"),
 *   fieldable = FALSE,
 *   controllers = {
 *     "list_builder" = "Drupal\oauth2_server\ScopeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\oauth2_server\Form\ScopeForm",
 *       "edit" = "Drupal\oauth2_server\Form\ScopeForm",
 *       "delete" = "Drupal\oauth2_server\Form\ScopeDeleteForm"
 *     }
 *   },
 *   config_prefix = "scope",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name"
 *   },
 *   links = {
 *     "edit-form" = "/scope.edit",
 *     "delete-form" = "/scope.delete"
 *   }
 * )
 */
class Scope extends ConfigEntityBase implements ScopeInterface {

  /**
   * The ID of the scope.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the scope.
   *
   * @var string
   */
  public $name;

}