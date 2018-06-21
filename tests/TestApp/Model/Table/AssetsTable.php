<?php
namespace Utility\Test\TestApp\Model\Table;

use Cake\ORM\Table;

class AssetsTable extends Table
{
    public function initialize(array $config)
    {
        $this->setPrimaryKey('id');

        $this->addBehavior('Utility.ModelMarker');
    }
}