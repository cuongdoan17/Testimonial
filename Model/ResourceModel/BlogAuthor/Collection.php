<?php

namespace AHT\Testimonial\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\BlogAuthor', 'AHT\Testimonial\Model\ResourceModel\BlogAuthor');
    }
}
