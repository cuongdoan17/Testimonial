<?php


namespace AHT\Testimonial\Model\ResourceModel;


class Author extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('aht_blog_author', 'author_id');
    }
}
