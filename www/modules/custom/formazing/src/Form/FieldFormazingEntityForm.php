<?php

namespace Drupal\formazing\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Field formazing entity edit forms.
 *
 * @ingroup formazing
 */
class FieldFormazingEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\formazing\Entity\FieldFormazingEntity */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Field formazing entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Field formazing entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.field_formazing_entity.canonical', ['field_formazing_entity' => $entity->id()]);
  }

}
