<?php

namespace Drupal\formazing\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Formazing entity edit forms.
 *
 * @ingroup formazing
 */
class FormazingEntityForm extends ContentEntityForm
{
    
    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state, $formazing = NULL)
    {
        /* @var $entity \Drupal\formazing\Entity\FormazingEntity */
        $form = parent::buildForm($form, $form_state);
        
        $entity = $this->entity;
        
        $form['linked_api'] = [
          '#type' => 'checkbox',
          '#default_value' => $entity->getIsLinkedApi(),
          '#title' => $this->t('Form linked to an API')
        ];
        
        return $form;
    }
    
    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state)
    {
        /** @var \Drupal\formazing\Entity\FormazingEntity $entity */
        $entity = &$this->entity;
        $entity->setIsLinkedApi($form_state->getValue('linked_api'));
        $entity->save();
        
        $status = parent::save($form, $form_state);
        
        switch ($status) {
            case SAVED_NEW:
                drupal_set_message($this->t('Created the %label Formazing entity.', [
                  '%label' => $entity->label(),
                ]));
                break;
            
            default:
                drupal_set_message($this->t('Saved the %label Formazing entity.', [
                  '%label' => $entity->label(),
                ]));
        }
        $form_state->setRedirect('entity.formazing_entity.canonical', ['formazing_entity' => $entity->id()]);
    }
    
}
