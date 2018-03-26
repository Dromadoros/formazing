<?php

namespace Drupal\formazing\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\formazing\Entity\FieldFormazingEntity;
use Drupal\formazing\Entity\FormazingEntity;
use Drupal\formazing\Entity\ResultFormazingEntity;
use Drupal\formazing\FieldHelper\FieldAction;

/**
 * Class DynamicForm.
 */
class DynamicForm extends FormBase
{
    
    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'dynamic_form';
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $buildInfo = $form_state->getBuildInfo();
        if(!count($buildInfo['args'])){
            return [];
        }
        $value = $buildInfo['args'][0];
        $entityType = 'field_formazing_entity';
    
        $query = \Drupal::entityQuery($entityType);
        $query->condition('formazing_id', $value);
        $entity_ids = $query->execute();
        
        $fields = FieldFormazingEntity::loadMultiple($entity_ids);
    
        uasort($fields, [FieldAction::class, 'orderWeight']);
        
        /** @var FieldFormazingEntity $field */
        foreach ($fields as $field){
            $key = $field->getMachineName() ?:str_replace(' ', '_', strtolower($field->getName()));
            
            /** @var \Drupal\formazing\FieldSettings\TextField $fieldType */
            $fieldType = $field->getFieldType();
            /** @var \Drupal\formazing\FieldViewer\Parser\Parser $parser */
            $parser = $fieldType::getParser();
            
            $form[$key] = $parser::parse($field);
        }
        
        $form['_form_type'] = [
            'type' => 'hidden',
            'value' => $value,
        ];
        
        return $form;
    }
    
    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        parent::validateForm($form, $form_state);
    }
    
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $values = FieldAction::cleanFormValues($form_state, $form);
        $type = $form['_form_type']['value'];
        $formazing = FormazingEntity::load($type);
        
        $entity = ResultFormazingEntity::create([
            'form_type' => $type,
            'name' => $formazing->getName(),
            'data' => json_encode(array_filter($values, function($value) { return $value['type'] !== 'submit'; })),
            'langcode' => \Drupal::languageManager()->getCurrentLanguage()->getId(),
        ]);
        
        $entity->save();
    }
}
