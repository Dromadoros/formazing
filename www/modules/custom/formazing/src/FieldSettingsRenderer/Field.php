<?php

namespace Drupal\formazing\FieldSettingsRenderer;

use Drupal\Core\Form\FormStateInterface;

/**
 * Class Field
 * @package Drupal\formazing\FieldSettingsRenderer
 */
abstract class Field implements FieldInterface
{
    
    /**
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $entity
     * @return array
     */
    public function renderField($entity)
    {
        $elements = [];
        
        $elements['name'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getName(),
          '#title' => t('Label', [], ['context' => 'formazing']),
          '#required' => TRUE,
        ];
        
        $elements['type'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getFieldType(),
          '#title' => t('Type of field', [], ['context' => 'formazing']),
          '#required' => TRUE,
          '#attributes' => array(
            'readonly' => 'readonly',
            'disabled' => 'disabled'
          ),
        ];
        
        $elements['value'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getFieldValue(),
          '#title' => t('Default value', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
        
        $elements['placeholder'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getPlaceholder(),
          '#title' => t('Placeholder', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
        
        $elements['prefix'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getPrefix(),
          '#title' => t('Prefix', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
        
        $elements['suffix'] = [
          '#type' => 'textfield',
          '#default_value' => $entity->getSuffix(),
          '#title' => t('Suffix', [], ['context' => 'formazing']),
          '#required' => FALSE,
        ];
        
        $elements['is_required'] = [
          '#type' => 'checkbox',
          '#default_value' => $entity->isRequired(),
          '#title' => t('Required field', [], ['context' => 'formazing']),
        ];
        
        $elements['field_id'] = [
          '#type' => 'hidden',
          '#value' => $entity->id(),
        ];
        
        $elements['formazing_id'] = [
          '#type' => 'hidden',
          '#value' => $entity->getFormId(),
        ];
        
        $elements['submit'] = [
          '#type' => 'submit',
          '#value' => t('Confirm this field', [], ['context' => 'formazing']),
        ];
        
        return $elements;
    }
    
    public function saveField($entity, FormStateInterface $form_state)
    {
        $values = $form_state->getValues();
        
        foreach ($values as $key => $value) {
            if ($entity->hasField($key)) {
                $entity->set($key, $value);
            }
        }
        
        $entity->save();
    }
    
    /**
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $field
     * @return array
     */
    public function parse($field)
    {
        return [
          '#type' => 'textfield',
          '#title' => $field->getName(),
          '#default_value' => $field->getFieldValue(),
          '#required' => $field->isRequired(),
          '#prefix' => $field->getPrefix(),
          '#suffix' => $field->getSuffix(),
          '#attributes' => [
            'placeholder' => $field->getPlaceholder(),
          ]
        ];
    }
}