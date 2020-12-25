<?php


namespace AHT\Testimonial\Model\ResourceModel;


class BlogAuthor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('aht_author_post', 'id');
    }
}
