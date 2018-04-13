<?php

namespace Drupal\formazing\Plugin\Field\FieldWidget;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Field\Annotation\FieldWidget;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\formazing\Entity\FormazingEntity;

/**
 * Plugin implementation of the 'formazing_widget_type' widget.
 *
 * @FieldWidget(
 *   id = "formazing_widget_type",
 *   label = @Translation("Formazing widget type"),
 *   field_types = {
 *     "formazing_field_type"
 *   }
 * )
 */
class FormazingWidgetType extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
        'size' => 60,
        'placeholder' => '',
      ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $elements = [];

    $elements['size'] = [
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    ];
    $elements['placeholder'] = [
      '#type' => 'textfield',
      '#title' => t('Placeholder'),
      '#default_value' => $this->getSetting('placeholder'),
      '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
    ];

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];

    $summary[] = t('Textfield size: @size', ['@size' => $this->getSetting('size')]);
    if (!empty($this->getSetting('placeholder'))) {
      $summary[] = t('Placeholder: @placeholder', ['@placeholder' => $this->getSetting('placeholder')]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(
    FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state
  ) {
    $entityType = 'formazing_entity';

    $query = \Drupal::entityQuery($entityType);
    $entityIds = $query->execute();

    $forms = \Drupal::entityTypeManager()->getStorage($entityType)->loadMultiple($entityIds);

    $forms[0] = $this->t('--- Choose your form ---');
    $forms = array_map([$this, 'getNameFromEntity'], $forms);

    $element['value'] = $element + [
        '#type' => 'select',
        '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
        '#options' => $forms
      ];

    return $element;
  }

  /**
   * @param \Drupal\formazing\Entity\FormazingEntity $entity
   * @return string
   */
  private function getNameFromEntity($entity) {
    if (!$entity instanceof FormazingEntity) {
      return $entity;
    }

    return $entity->getName();
  }

}
