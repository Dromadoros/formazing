<?php

namespace Drupal\formazing\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\formazing\Entity\FieldFormazingEntity;

/**
 * Form controller for Field formazing entity edit forms.
 *
 * @ingroup formazing
 */
class FieldFormazingEntityEditForm extends FormBase
{
    
    public function getFormId()
    {
        return 'field_formazing_entity_form_edit';
    }
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $formazing_entity = NULL, $field_formazing_entity = NULL)
    {
        $field = FieldFormazingEntity::load($field_formazing_entity);
        
        $type = $field->getFieldType();
        
        /** @var \Drupal\formazing\FieldSettingsRenderer\Field $fieldType */
        $fieldType = new $type;
        $form = $fieldType->renderField($field);
        
        return $form;
    }
    
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $fieldId = $form_state->getValue('field_id');
        
        $field = FieldFormazingEntity::load($fieldId);
        
        $type = $field->getFieldType();
        
        /** @var \Drupal\formazing\FieldSettingsRenderer\Field $fieldType */
        $fieldType = new $type;
        
        $fieldType->saveField($field, $form_state);
        
        $form_state->setRedirect('entity.formazing_entity_elements.view', ['formazing_entity' => $form_state->getValue('formazing_id')]);
    }
}
