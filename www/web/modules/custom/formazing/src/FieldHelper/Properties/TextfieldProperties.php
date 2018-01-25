<?php

namespace Drupal\formazing\FieldHelper\Properties;

use Drupal\formazing\Entity\FieldFormazingEntity;
use Drupal\formazing\FieldHelper\Properties\PropertiesInterface;

/**
 * Class Field
 * @package Drupal\formazing\FieldSettings
 */
abstract class TextfieldProperties implements PropertiesInterface
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
    public static function settingValue($entity)
    {
        return $elements['value'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getFieldValue(),
          '#title' => t('Default value', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
    }
    
    /**
     * @param FieldFormazingEntity $entity
     * @return array
     */
    public static function settingPlaceholder($entity)
    {
        return $elements['placeholder'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getPlaceholder(),
          '#title' => t('Placeholder', [], ['context' => 'formazing']),
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