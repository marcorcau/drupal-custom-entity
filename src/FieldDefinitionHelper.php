<?php

namespace Drupal\project;

use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Class FieldDefinitionHelper
 */
class FieldDefinitionHelper {

  /**
   * @param $weight
   */
  protected static $currentWeight = 0;

  static function setWeight($weight) {
    self::$currentWeight = $weight;
  }

  /**
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createString() {
    return self::createField('string', 'string_textfield', 'string')
      ->setSettings([
        'max_length'      => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type'     => 'string_textfield',
        'settings' => ['size' => 24,],
        'weight'   => self::$currentWeight,
      ]);
  }

  /**
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createEmailAddress() {
    return self::createField('email', 'string_textfield', 'string')
      ->setSettings([
        'max_length'      => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'type'     => 'string_textfield',
        'settings' => ['size' => 24,],
        'weight'   => self::$currentWeight,
      ]);
  }

  /**
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createDecimal() {
    return self::createField('decimal', 'number', 'number_decimal')
      /*
               ->setSettings([
                 'max_length'      => 255,
                 'text_processing' => 0,
               ])*/
               ->setDefaultValue('')
               ->setDisplayOptions('form', [
                 /*
                 'type'     => 'string_textfield',
                 'settings' => ['size' => 24,],
                 */
                 'weight'   => self::$currentWeight,
               ]);
  }

  /**
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createInteger() {
    return self::createField('integer', 'number', 'number_integer')
      ->setDefaultValue('')
      ->setDisplayOptions('form', [
        'weight' => self::$currentWeight,
      ]);
  }
  /**
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createTextArea() {
    return self::createField('text_long', 'text_textarea', 'text_default')
      ->setSettings([
        'text_processing' => 1,
      ])
      ->setDefaultValue('');
  }

  /**
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createDate() {
    return self::createField('datetime', 'datetime_default', 'datetime_default')
      ->setSetting('datetime_type', 'date')
      ->setDefaultValue([
        'default_date_type' => 'now',
        'default_date'      => 'now',
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'type'   => 'datetime_default',
        'settings' => ['format_type' => 'short',],
        'weight' => self::$currentWeight,
      ]);
  }

  /**
   * @param $options
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createBoolean($options = []) {
    if (!isset($options['form_type']) || !in_array($options['form_type'], ['boolean_checkbox', 'options_buttons'])) {
      $options['form_type'] = 'boolean_checkbox';
    }

    return self::createField('boolean', $options['form_type'], 'boolean')
      ->setSetting('off_label', 'No')
      ->setSetting('on_label', 'Sí');
  }

  /**
   * @var $options
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createSelect($options = []) {
    if (!isset($options['form_type']) || !in_array($options['form_type'], ['options_select', 'options_buttons'])) {
      $options['form_type'] = 'options_select';
    }

    return self::createField('list_string', $options['form_type'], 'list_default');
  }

  /**
   * @param $options
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createReference($options = []) {
    if (!isset($options['form_type']) || !in_array($options['form_type'], ['options_select', 'options_buttons'])) {
      $options['form_type'] = 'options_select';
    }

    if (!isset($options['target_type'])) {
      $options['target_type'] = 'node';
    }

    return self::createField('entity_reference', $options['form_type'], 'boolean')
      ->setSetting('target_type', $options['target_type']);
  }

  /**
   * @param $options
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  static function createOgReference($options = []) {

    if (!isset($options['form_type']) || !in_array($options['form_type'], ['options_select', 'options_buttons'])) {
      $options['form_type'] = 'options_select';
    }

    if (!isset($options['handler'])) {
      $options['handler'] = 'default:node';
    }

    if (!isset($options['target_bundles'])) {
      throw new \Exception('Target bundles is required');
    }

    if (!isset($options['access_override'])) {
      $options['access_override'] = FALSE;
    }

    $handler_settings = [
      'target_bundles' => $options['target_bundles'],
      'sort' => ['field' => '_none'],
      'auto_create' => FALSE,
      'auto_create_bundle' => '',

    ];

    return self::createField('og_standard_reference', $options['form_type'], 'boolean')
      ->setSetting('handler', $options['handler'])
      ->setSetting('handler_settings', $handler_settings)
      ->setSetting('access_override', $options['access_override']);
  }

  /**
   * @param $type
   *
   * @return \Drupal\Core\Field\BaseFieldDefinition
   */
  protected static function createField($type, $form_type, $view_type) {
    self::$currentWeight += 1;

    return BaseFieldDefinition::create($type)
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayOptions('form', [
        'type'   => $form_type,
        'weight' => self::$currentWeight,
      ])
      ->setDisplayOptions('view', [
        'label'  => 'inline',
        'type'   => $view_type,
        'weight' => self::$currentWeight,
      ]);
  }
}
