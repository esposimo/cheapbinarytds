<?php

namespace smn\cheapbinarytds;

use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{

    /**
     * @var Node
     */
    protected Node $instance;

    /**
     * @var string
     */
    protected string $name = 'schema';

    /**
     * @var string
     */
    protected string $value = 'schema_name';

    protected function setUp(): void
    {
        parent::setUp();
        $this->instance = new Node($this->name, $this->value);
    }

    public function testRemoveNode()
    {

        $this->testAddChildNode();
        $count = count($this->instance->getChildren());
        $remove = $this->instance->getChild('table');
        $this->instance->removeNode($remove);
        $count--;
        $this->assertCount($count, $this->instance->getChildren());
        $this->assertFalse($this->instance->hasChild('table'));

    }

    public function testGetValue()
    {
        $this->assertEquals($this->instance->getValue(), $this->value);
    }

    public function testGetChild()
    {
        $add = new Node('table','table_name');
        $this->instance->addChildNode($add);
        $child = $this->instance->getChild('table');
        $this->assertEquals($add, $child);


    }

    public function testAddChildNode()
    {
        $count = count($this->instance->getChildren());
        $node = new Node('table','table_name');
        $this->instance->addChildNode($node);
        $count++;
        $this->assertCount($count, $this->instance->getChildren());

    }

    public function testGetParent()
    {
        $node = new Node('table','table_name');
        $this->instance->addChildNode($node);
        $parent = $node->getParent();
        $this->assertEquals($parent, $this->instance);


    }

    public function testGetChildrenCount()
    {
        $this->assertEquals(0, $this->instance->getChildrenCount());
        $this->instance->addChildNode(new Node('table1','value'));
        $this->instance->addChildNode(new Node('table2','value'));
        $this->instance->addChildNode(new Node('table3','value'));
        $this->assertEquals(3, $this->instance->getChildrenCount());

    }

    public function testGetChildren()
    {
        $this->assertEquals(0, $this->instance->getChildrenCount());
        $node1 = new Node('table1','value');
        $node2 = new Node('table2','value');
        $node3 = new Node('table3','value');
        $this->instance->addChildNode($node1);
        $this->instance->addChildNode($node2);
        $this->instance->addChildNode($node3);

        $array = $this->instance->getChildren();
        $this->assertCount(3, $array);
        $noKey = array_combine(array_keys(array_fill(0,count($array),0)), array_values($array));
        $this->assertEquals($noKey[0], $node1);
        $this->assertEquals($noKey[1], $node2);
        $this->assertEquals($noKey[2], $node3);

    }

    public function testSetParent()
    {
        $node = new Node('parent','value');
        $node->setParent($this->instance);
        $this->assertEquals($node->getParent(), $this->instance);

    }

    public function testSetName()
    {
        $this->assertEquals($this->instance->getName(), $this->name);

    }

    public function testSetValue()
    {
        $this->assertEquals($this->instance->getValue(), $this->value);
    }

    public function testGetRootParent()
    {
        $child = new Node('child','value');
        $sub_child = new Node('sub_child','value');
        $child->addChildNode($sub_child);
        $this->instance->addChildNode($child);

        $this->assertEquals($sub_child->getRootParent(), $this->instance);


    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->instance->getName());

    }

    public function testRemoveNodeByName()
    {
        $node1 = new Node('child1','value');
        $node2 = new Node('child2','value');
        $node3 = new Node('child3','value');

        $this->instance->addChildNode($node1);
        $this->instance->addChildNode($node2);
        $this->instance->addChildNode($node3);

        $this->instance->removeNodeByName('child2');

        $this->assertFalse($this->instance->getChild('child2'));


    }

    public function testHasChild()
    {
        $node1 = new Node('child1','value');
        $node2 = new Node('child2','value');
        $node3 = new Node('child3','value');

        $this->instance->addChildNode($node1);
        $this->instance->addChildNode($node2);
        $this->instance->addChildNode($node3);

        $this->assertTrue($this->instance->hasChild('child2'));
        $this->assertFalse($this->instance->hasChild('child4'));
    }
}
