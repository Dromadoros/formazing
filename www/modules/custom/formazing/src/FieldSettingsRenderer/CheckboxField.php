<?php

namespace Drupal\formazing\FieldSettingsRenderer;

use Drupal\formazing\FieldViewer\Parser\TextParser;

class CheckboxField extends Field{
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
          '#type' => 'checkbox',
          '#default_value' => $entity->getFieldValue(),
          '#title' => t('Default value', [], ['context' => 'formazing']),
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
    
    /**
     * @return string
     */
    public function getParser(){
        return TextParser::class;
    }
}