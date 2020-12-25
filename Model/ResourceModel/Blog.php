<?php


namespace AHT\Testimonial\Model\ResourceModel;


class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('aht_testimonial_blog', 'id');
    }
}
