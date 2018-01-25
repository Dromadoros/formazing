<?php

namespace Drupal\formazing\FieldViewer\Parser;

abstract class Parser {
    
    /**
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $field
     * @return array
     */
    public static function parse($field)
    {
        /** @var \Drupal\formazing\FieldSettings\TextField $fieldType */
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
}