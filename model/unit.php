<?php

class model_unit
{
    protected $_badge;
    protected $_name;
    protected $_type;
    protected $_platoon;

    protected $rank;

    public function __construct($data)
    {
        $this->_badge = $data['badge'];
        $this->_name = $data['name'];
        $this->_type = $data['type'];
        $this->_platoon = $data['platoon'];

        $this->rank = $data['rank'];
    }

    public function getBadge()
    {
        return $this->_badge;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getPlatoon()
    {
        return $this->_platoon;
    }

    public function getType()
    {
        return $this->_type;
    }

    public function getRank()
    {
        return $this->rank;
    }
}
