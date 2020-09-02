<?php


namespace smn\cheapbinarytds;


class Node implements NodeInterface
{

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var NodeInterface
     */
    protected NodeInterface $parent;

    /**
     * @var NodeInterface[]
     */
    protected array $children = [];

    public function __construct(string $name, $value) {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @inheritDoc
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function addChildNode(NodeInterface $node)
    {
        $name = $node->getName();
        if (array_key_exists($name, $this->children)) {
            throw new NodeException('Node already exists');
        }
        $this->children[$name] = $node;
    }

    /**
     * @inheritDoc
     */
    public function getChild(string $name)
    {
        if (array_key_exists($name, $this->children)) {
            return $this->children[$name]->getValue();
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getChildInstance(string $name)
    {
        if (array_key_exists($name, $this->children)) {
            return $this->children[$name];
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function removeNode(NodeInterface $node)
    {
        if (array_key_exists($node->getName(), $this->children)) {
            unset($this->children[$node->getName()]);
        }
    }

    /**
     * @inheritDoc
     */
    public function removeNodeByName(string $name)
    {
        if (array_key_exists($name, $this->children)) {
            unset($this->children[$name]);
        }
    }

    /**
     * @inheritDoc
     */
    public function getChildrenCount()
    {
        return count($this->children);
    }

    /**
     * @inheritDoc
     */
    public function getChildren()
    {
        $children = [];
        foreach($this->children as $node) {
            $children[$node->getName()] = $node->getValue();
        }
        return $children;
    }

    /**
     * @inheritDoc
     */
    public function setParent(NodeInterface $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @inheritDoc
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritDoc
     */
    public function getRootParent()
    {
        // TODO: Implement getRootParent() method.
    }

    public function hasChild(string $name)
    {
        return array_key_exists($name, $this->children);
    }
}