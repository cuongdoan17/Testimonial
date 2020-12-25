<?php

namespace AHT\Testimonial\Model\ResourceModel\Author;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\Author', 'AHT\Testimonial\Model\ResourceModel\Author');
    }
}
