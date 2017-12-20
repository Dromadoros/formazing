<?php

namespace Drupal\formazing\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Formazing entity entity.
 *
 * @ingroup formazing
 *
 * @ContentEntityType(
 *   id = "formazing_entity",
 *   label = @Translation("Formazing entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\formazing\FormazingEntityListBuilder",
 *     "views_data" = "Drupal\formazing\Entity\FormazingEntityViewsData",
 *     "translation" = "Drupal\formazing\FormazingEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\formazing\Form\FormazingEntityForm",
 *       "add" = "Drupal\formazing\Form\FormazingEntityForm",
 *       "edit" = "Drupal\formazing\Form\FormazingEntityForm",
 *       "delete" = "Drupal\formazing\Form\FormazingEntityDeleteForm",
 *     },
 *     "access" = "Drupal\formazing\FormazingEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\formazing\FormazingEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "formazing_entity",
 *   data_table = "formazing_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer formazing entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *     "linked_api" = "linked_api",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/formazing_entity/{formazing_entity}",
 *     "add-form" = "/admin/structure/formazing_entity/add",
 *     "edit-form" = "/admin/structure/formazing_entity/{formazing_entity}/edit",
 *     "delete-form" = "/admin/structure/formazing_entity/{formazing_entity}/delete",
 *     "collection" = "/admin/structure/formazing_entity",
 *   },
 *   field_ui_base_route = "formazing_entity.settings"
 * )
 */
class FormazingEntity extends ContentEntityBase implements
  FormazingEntityInterface
{
    
    use EntityChangedTrait;
    
    /**
     * {@inheritdoc}
     */
    public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
    {
        parent::preCreate($storage_controller, $values);
        $values += [
          'user_id' => \Drupal::currentUser()->id(),
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->get('name')->value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->set('name', $name);
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCreatedTime()
    {
        return $this->get('created')->value;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setCreatedTime($timestamp)
    {
        $this->set('created', $timestamp);
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->get('user_id')->entity;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getOwnerId()
    {
        return $this->get('user_id')->target_id;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setOwnerId($uid)
    {
        $this->set('user_id', $uid);
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $account)
    {
        $this->set('user_id', $account->id());
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isPublished()
    {
        return (bool) $this->getEntityKey('status');
    }
    
    /**
     * {@inheritdoc}
     */
    public function setPublished($published)
    {
        $this->set('status', $published ? TRUE : FALSE);
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function getIsLinkedApi()
    {
        return (bool) $this->get('linked_api')->value;
    }
    
    /**
     * @param $value
     */
    public function setIsLinkedApi($value)
    {
        $this->set('linked_api', $value);
    }
    
    /**
     * {@inheritdoc}
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);
        
        $fields['name'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Name'))
          ->setDescription(t('The name of the Formazing entity entity.'))
          ->setSettings([
            'max_length' => 50,
            'text_processing' => 0,
          ])
          ->setDefaultValue('')
          ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'string',
            'weight' => -4,
          ])
          ->setDisplayOptions('form', [
            'type' => 'string_textfield',
            'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);
        
        $fields['status'] = BaseFieldDefinition::create('boolean')
          ->setLabel(t('Publishing status'))
          ->setDescription(t('A boolean indicating whether the Formazing entity is published.'))
          ->setDefaultValue(TRUE);
        
        $fields['created'] = BaseFieldDefinition::create('created')
          ->setLabel(t('Created'))
          ->setDescription(t('The time that the entity was created.'));
        
        $fields['changed'] = BaseFieldDefinition::create('changed')
          ->setLabel(t('Changed'))
          ->setDescription(t('The time that the entity was last edited.'));
        
        $fields['linked_api'] = BaseFieldDefinition::create('boolean')
          ->setLabel(t('Is linked to API'))
          ->setDescription(t('Check if this form will be linked to an API'))
          ->setDefaultValue(FALSE);
        
        return $fields;
    }
}
