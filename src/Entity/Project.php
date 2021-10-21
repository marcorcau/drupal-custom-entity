<?php

namespace Drupal\project\Entity;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\project\FieldDefinitionHelper;
use Drupal\project\ProjectInterface;

/**
 * Defines the project entity class.
 *
 * @ContentEntityType(
 *   id = "project",
 *   label = @Translation("Project"),
 *   label_collection = @Translation("Projects"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\project\ProjectListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\project\Form\ProjectForm",
 *       "edit" = "Drupal\project\Form\ProjectForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\project\Routing\EditFormAsCanonicalHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "project",
 *   admin_permission = "administer project",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/project/add",
 *     "canonical" = "/project/{project}",
 *     "edit-form" = "/admin/content/project/{project}/edit",
 *     "delete-form" = "/admin/content/project/{project}/delete",
 *     "collection" = "/admin/content/project"
 *   },
 *   field_ui_base_route = "entity.project.settings"
 * )
 */
class Project extends CustomContentEntityBase implements ProjectInterface {

  /**
   * {@inheritdoc}
   */
  protected static function addCustomFields(&$fields) {

    // Define custom entity fields making use of BaseFieldDefinition::create() method

    // For example ...
    $fields['maintainers'] = FieldDefinitionHelper::createReference()
      ->setLabel('Maintainers')
      ->setDescription(t('User ID of the project maintainers.'))
      ->setSetting('target_type', 'user')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED);
  }
}
