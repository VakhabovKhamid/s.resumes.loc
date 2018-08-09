<?php
namespace BruteForceDetector\Model\Table;

use Cake\ORM\Table;

class RequestsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('requests');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }
}
