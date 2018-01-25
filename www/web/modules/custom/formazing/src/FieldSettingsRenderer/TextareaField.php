<?php

namespace Drupal\formazing\FieldSettingsRenderer;

use Drupal\formazing\FieldHelper\Properties\TextareaProperties;

class TextareaField extends TextareaProperties
{
    /**
     * @param $entity
     * @return array
     */
    public static function generateSettings($entity)
    {
        $form = [];
        $form['name'] = parent::settingName($entity);
        $form['type'] = parent::settingType($entity);
        $form['value'] = parent::settingValue($entity);
        $form['placeholder'] = parent::settingPlaceholder($entity);
        $form['prefix'] = parent::settingPrefix($entity);
        $form['suffix'] = parent::settingSuffix($entity);
        $form['is_required'] = parent::settingRequired($entity);
        $form['field_id'] = parent::settingFieldId($entity);
        $form['formazing_id'] = parent::settingFormazingId($entity);
        $form['submit'] = parent::settingSubmit();
        
        return $form;
    }
    
    /**
     * @return string
     */
    public static function getMachineTypeName(){
        return 'textarea';
    }
}