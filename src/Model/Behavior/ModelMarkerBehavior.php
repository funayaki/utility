<?php
namespace Utility\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Behavior;

class ModelMarkerBehavior extends Behavior
{
    /**
     * @var array
     */
    protected $_defaultConfig = [
        'method' => 'getAlias',
        'field' => 'model',
    ];

    /**
     * @param array $config
     */
    public function initialize(array $config)
    {
        if (isset($config['method'])) {
            $this->setConfig('method', $config['method'], false);
        }
        if (isset($config['field'])) {
            $this->setConfig('field', $config['field'], false);
        }
    }

    /**
     * @param Event $event
     * @param EntityInterface $entity
     * @param ArrayObject $options
     */
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options)
    {
        $method = $this->getConfig('method');
        $field = $this->getConfig('field');

        $callable = [$this->getTable(), $method];
        if ($entity->isNew() && is_callable($callable)) {
            $entity->{$field} = call_user_func($callable);
        }
    }
}
