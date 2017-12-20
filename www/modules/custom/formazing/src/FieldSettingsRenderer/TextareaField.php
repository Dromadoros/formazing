<?php

namespace Drupal\formazing\FieldSettingsRenderer;

class TextareaField extends Field
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
        
        $elements['value'] = [
          '#type' => 'textarea',
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
        
        $elements['required'] = [
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
}