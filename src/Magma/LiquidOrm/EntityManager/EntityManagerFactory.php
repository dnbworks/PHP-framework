<?php

declare(strict_types=1);

namespace Magma\LiquidOrm\EntityManager;

use Magma\LiquidOrm\EntityManager\Exception\CrudException;
use Magma\LiquidOrm\EntityManager\EntityManagerInterface;
use Magma\LiquidOrm\QueryBuilder\QueryBuilderInterface;
use Magma\LiquidOrm\DataMapper\DataMapperInterface;



class EntityManagerFactory
{

    /** @var DataMapperInterface */
    protected DataMapperInterface $dataMapper;

    /** @var QueryBuilderInterface */
    protected QueryBuilderInterface $queryBuilder;

    /**
     * Main class constructor
     *
     * @param DataMapperInterface $dataMapper
     * @param QueryBuilderInterface $queryBuilder
     */
    public function __construct(DataMapperInterface $dataMapper, QueryBuilderInterface $queryBuilder)
    {
        $this->dataMapper = $dataMapper;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * Create the entityManager object and inject the dependency which is the crud object
     *
     * @param string $crudString
     * @param string $tableSchema
     * @param string $tableSchemaID
     * @return EntityManagerInterface
     */
    public function create(string $crudString, string $tableSchema, string $tableSchemaID) : EntityManagerInterface
    {
        $crudObject = new $crudString($this->dataMapper, $this->queryBuilder, $tableSchema, $tableSchemaID);
        if (!$crudObject instanceof CrudInterface) {
            throw new CrudException($crudString . ' is not a valid crud object.');
        }
        return new EntityManager($crudObject);
    }

}
