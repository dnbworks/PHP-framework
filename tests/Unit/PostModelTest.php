<?php

declare(strict_types = 1);

namespace Magma\Tests\Unit;

use \PHPUnit\Framework\TestCase;

class  PostModelTest extends TestCase
{
    // public function setUp()
    // {
    //     var_dump('2');
    // }

    /** @test */
    public function it_registers_a_route_tablename(): void
    {
        $post = new \Magma\App\Models\PostModel;
        
        $post->setTableName('Posts');
        $this->assertEquals($post->getTableName(), 'Posts');
    }

    public function test_it_registers_a_route_primary_id(): void
    {
        $post = new \Magma\App\Models\PostModel;
        
        $post->setPrimaryId('post_id');
        $this->assertEquals($post->getPrimaryId(), 'post_id');
    }

    public function test_if_primaryId_and_Tablename_return(): void
    {
        $post = new \Magma\App\Models\PostModel;
        
        $post->setPrimaryId('post_id');
        $post->setTableName('posts');
        $this->assertEquals($post->ReturnTableAndPrimaryId(), 'posts post_id');
    }

    public function test_if_primaryId_and_Tablename_trimmed(): void
    {
        $post = new \Magma\App\Models\PostModel;
        
        $post->setPrimaryId('   post_id   ');
        $post->setTableName(  'posts  ');

        $this->assertEquals($post->getPrimaryId(), 'post_id');
        $this->assertEquals($post->getTableName(), 'posts');
    }

    public function test_tableVariables_contain_correctValues(): void
    {
        $post = new \Magma\App\Models\PostModel;
        
        $post->setPrimaryId('   post_id   ');
        $post->setTableName(  'posts  ');

        $tableVariables = $post->getTableVariables();

        $this->assertArrayHasKey('table_name', $tableVariables);
        $this->assertArrayHasKey('primary_key', $tableVariables);

        $this->assertEquals($tableVariables['primary_key'], 'post_id');
        $this->assertEquals($tableVariables['table_name'], 'posts');
    }
}