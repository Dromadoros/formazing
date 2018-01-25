<?php

namespace Drupal\formazing\FieldHelper;

use Drupal\Core\Form\FormStateInterface;

class FieldAction {
    
    /**
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $entity
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     * @return array|void
     */
    public static function saveField($entity, FormStateInterface $form_state)
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
    public static function parse($field)
    {
        /** @var \Drupal\formazing\FieldSettingsRenderer\TextField $fieldType */
        $fieldType = $field->getFieldType();
        
        return [
          '#type' => $fieldType::getMachineTypeName(),
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
    
    /**
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $a
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $b
     * @return int
     */
    public static function orderWeight($a, $b)
    {
        return $a->getWeight() < $b->getWeight() ? -1 : 1;
    }
}