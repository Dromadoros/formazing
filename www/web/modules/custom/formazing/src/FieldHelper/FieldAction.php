<?php

namespace Drupal\formazing\FieldHelper;

use Drupal\Core\Form\FormStateInterface;

class FieldAction
{
    
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
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $a
     * @param \Drupal\formazing\Entity\FieldFormazingEntity $b
     * @return int
     */
    public static function orderWeight($a, $b)
    {
        return $a->getWeight() < $b->getWeight() ? -1 : 1;
    }
    
    /**
     * @param $options
     * @return array
     */
    public static function filterEmptyOption($options)
    {
        if (!$options) {
            return [];
        }
        
        $options = array_filter($options, [
          FieldAction::class,
          'removeEmptyValue'
        ]);
        
        return $options;
    }
    
    /**
     * Remove empty options
     * @param $value
     * @return string
     */
    public static function removeEmptyValue($value)
    {
        $value = str_replace(' ', '', $value);
        
        return $value['value'] && strlen($value['value']);
    }
    
    /**
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     * @return array
     */
    public static function cleanFormValues($form_state) {
        $wrong_values = ['form_build_id', 'form_token', 'form_id', 'op'];
        $values = $form_state->getValues();
        
        return array_filter($values, function($key) use ($wrong_values) {
            return !in_array($key, $wrong_values);
        }, ARRAY_FILTER_USE_KEY);
    }
}
