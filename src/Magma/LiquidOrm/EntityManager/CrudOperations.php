<?php

declare(strict_types=1);

namespace MagmaCore\DataObjectLayer\EntityManager;


use Magma\LiquidOrm\DataMapper\DataMapper;
use Magma\LiquidOrm\QueryBuilder\QueryBuilder;
use Throwable;

class Crud implements CrudInterface
{
     /** @var DataMapper */
     protected DataMapper $dataMapper;

     /** @var QueryBuilder */
     protected QueryBuilder $queryBuilder;
 
     /** @var string */
     protected string $tableSchema;
 
     /** @var string */
     protected string $tableSchemaID;

    private string $createQuery;
    private string $readQuery;
    private string $joinQuery;
    private string $updateQuery;
    private string $deleteQuery;
    private string $searchQuery;
    private string $rawQuery;

    /**
     * Main constructor
     *
     * @param DataMapper $dataMapper
     * @param QueryBuilder $queryBuilder
     * @param string $tableSchema
     * @param string $tableSchemaID
     */
    public function __construct(DataMapper $dataMapper, QueryBuilder $queryBuilder, string $tableSchema, string $tableSchemaID)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
        $this->tableSchema = $tableSchema;
        $this->tableSchemaID = $tableSchemaID;
    }

     /**
     * @inheritdoc
     *
     * @return string
     */
    public function getSchema(): string
    {
        return $this->tableSchema;
    }

    public function getMapping(): Object
    {
        return $this->dataMapper;
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getSchemaID(): string
    {
        return $this->tableSchemaID;
    }

    /**
     * @inheritdoc
     *
     * @return integer
     * @throws Throwable
     */
    public function lastID(): int
    {
        return $this->dataMapper->getLastId();
    }

    public function create(array $fields = []) : bool 
    {
        try {
            $args = ['table' => $this->getSchema(), 'type' => 'insert', 'fields' => $fields];
            $query = $this->queryBuilder->buildQuery($args)->insertQuery();
            $this->dataMapper->persist($query, $this->dataMapper->buildQueryParameters($fields));
            if($this->dataMapper->numRows() == 1){
                return true;
            }
        } catch(Throwable $throwable) {
            throw $throwable;
        }
    }
}