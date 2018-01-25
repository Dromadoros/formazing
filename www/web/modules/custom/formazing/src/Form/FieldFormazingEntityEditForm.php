<?php

namespace Drupal\formazing\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\formazing\Entity\FieldFormazingEntity;
use Drupal\formazing\FieldHelper\FieldAction;

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
        
        /** @var \Drupal\formazing\FieldSettingsRenderer\TextField $type */
        $type = $field->getFieldType();
        
        $form = $type::generateSettings($field);
        
        return $form;
    }
    
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $fieldId = $form_state->getValue('field_id');
        
        $field = FieldFormazingEntity::load($fieldId);
        
        FieldAction::saveField($field, $form_state);
        
        $form_state->setRedirect('entity.formazing_entity_elements.view', ['formazing_entity' => $form_state->getValue('formazing_id')]);
    }
}
