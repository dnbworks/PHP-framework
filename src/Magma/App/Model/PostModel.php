<?php

declare(strict_types=1);

namespace Magma\App\Models;

class PostModel 
{

    private string $tablename;
    private string $PrimaryId;
    public function __construct()
    {   }

    public function setTableName(string $tablename) : void
    {
        $this->tablename = trim($tablename);
    }

    public function getTableName() : string
    {
        return $this->tablename;
    }

    public function setPrimaryId(string $PrimaryId) : void
    {
        $this->PrimaryId = trim($PrimaryId);
    }

    public function getPrimaryId() : string
    {
        return $this->PrimaryId;
    }

    public function ReturnTableAndPrimaryId() : string
    {
        return $this->getTableName() . ' ' . $this->getPrimaryId();
    }

    public function getTableVariables() : array
    {
        return [
            'table_name' => $this->getTableName(),
            'primary_key' => $this->getPrimaryId()
        ];
    }

} 
