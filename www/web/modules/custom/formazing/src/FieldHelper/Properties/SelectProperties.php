<?php

namespace Drupal\formazing\FieldHelper\Properties;

use Drupal\formazing\Entity\FieldFormazingEntity;

/**
 * Class Field
 * @package Drupal\formazing\FieldSettings
 */
abstract class SelectProperties implements PropertiesInterface
{
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingName($entity)
    {
        return $elements['name'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getName(),
          '#title' => t('Label', [], ['context' => 'formazing']),
          '#required' => TRUE,
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingMachineName($entity)
    {
        return $elements['id'] = [
          '#type' => 'machine_name',
          '#default_value' => $entity->getMachineName() ?: '',
          '#maxlength' => 64,
          '#description' => t('A unique name for this item. It must only contain lowercase letters, numbers, and underscores.', [], ['context' => 'formazing']),
          '#machine_name' => [
            'source' => ['name'],
          ],
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingType($entity)
    {
        return $elements['type'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getFieldType(),
          '#title' => t('Type of field', [], ['context' => 'formazing']),
          '#required' => TRUE,
          '#attributes' => array(
            'readonly' => 'readonly',
            'disabled' => 'disabled'
          ),
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingOptions($entity)
    {
        return $elements['options'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->get('field_options')->value,
          '#title' => t('Default value', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingPrefix($entity)
    {
        return $elements['prefix'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getPrefix(),
          '#title' => t('Prefix', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingSuffix($entity)
    {
        return $elements['suffix'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getSuffix($entity),
          '#title' => t('Suffix', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingRequired($entity)
    {
        return $elements['is_required'] = [
          '#type' => 'checkbox',
          '#default_value' => $entity->isRequired(),
          '#title' => t('Required field', [], ['context' => 'formazing']),
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingShowingLabel($entity)
    {
        return $elements['is_showing_label'] = [
          '#type' => 'checkbox',
          '#default_value' => $entity->isShowingLabel(),
          '#title' => t('Show label', [], ['context' => 'formazing']),
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingFieldId($entity)
    {
        return $elements['field_id'] = [
          '#type' => 'hidden',
          '#value' => $entity->id(),
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingFormazingId($entity)
    {
        return $elements['formazing_id'] = [
          '#type' => 'hidden',
          '#value' => $entity->getFormId(),
        ];
    }
    
    /**
     * @return array
     */
    public static function settingSubmit()
    {
        return $elements['submit'] = [
          '#type' => 'submit',
          '#value' => t('Confirm this field', [], ['context' => 'formazing']),
        ];
    }
}