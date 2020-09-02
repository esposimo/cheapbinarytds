<?php


namespace smn\cheapbinarytds;


interface NodeInterface
{


    /**
     * Configure value of a node
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * Return value of a node
     * @return mixed
     */
    public function getValue();


    /**
     * Set a name for a node. If name already exists, throw a NodeException
     * @param string $name Name of node
     * @throws NodeException
     */
    public function setName(string $name);


    /**
     * Return the name of Node
     * @return string
     */
    public function getName();


    /**
     * Add a child node. If $node already exists, throw a NodeException
     * @param NodeInterface $node Node instance to add
     * @throws NodeException
     */
    public function addChildNode(NodeInterface $node);


    /**
     * Return a value of a child node. If $name doesn't exist, return false
     * @param string $name Name of a node
     * @return mixed|bool
     */
    public function getChild(string $name);


    /**
     * Return true o false if a child exists
     * @param string $name Name of a child
     * @return bool
     */
    public function hasChild(string $name);

    /**
     * Return true or false if child instance exists
     * @param NodeInterface $node
     * @return mixed
     */
    public function hasChildInstance(NodeInterface $node);


    /**
     * Remove a $node from binary tree.
     * @param NodeInterface $node
     */
    public function removeNode(NodeInterface $node);

    /**
     * Remove a NodeInstance by $name
     * @param string $name Name of a Node
     */
    public function removeNodeByName(string $name);


    /**
     * Return count of children node
     * @return int
     */
    public function getChildrenCount();

    /**
     * Return all children node
     * @return mixed
     */
    public function getChildren();


    /**
     * Give a parent to the Node instance
     * @param NodeInterface $parent
     */
    public function setParent(NodeInterface $parent);


    /**
     * Return the parent of a Node
     * @return NodeInterface
     */
    public function getParent();


    /**
     * Return root Parent of binary structure
     * @return NodeInterface
     */
    public function getRootParent();


}