<?php

namespace AHT\Testimonial\Model\ResourceModel\Author;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'author_id';

    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\Author', 'AHT\Testimonial\Model\ResourceModel\Author');
    }
}
