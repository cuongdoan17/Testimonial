<?php


namespace AHT\Testimonial\Model;


class Author extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\ResourceModel\Author');
    }
}
