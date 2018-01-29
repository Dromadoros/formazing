<?php

namespace Drupal\formazing\FieldViewer\Parser;

class CheckboxesParser extends Parser
{
    /**
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $field
     * @return array
     */
    public static function parse($field)
    {
        /** @var \Drupal\formazing\FieldSettings\TextField $fieldType */
        $fieldType = $field->getFieldType();
        $options = $field->get('field_options')->getValue();
        $options = array_map(function($value){ return $value['value']; }, $options);
        
        return [
          '#type' => $fieldType::getMachineTypeName(),
          '#title' => $field->getName(),
          '#options' => $options,
          '#required' => $field->isRequired(),
          '#prefix' => $field->getPrefix(),
          '#suffix' => $field->getSuffix(),
          '#attributes' => [
            'placeholder' => $field->getPlaceholder(),
          ]
        ];
    }
}