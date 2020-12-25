<?php


namespace AHT\Testimonial\Model;


class Blog extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'aht_testimonial_blog';

    protected $_cacheTag = 'aht_testimonial_blog';

    protected $_eventPrefix = 'aht_testimonial_blog';

    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\ResourceModel\Blog');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getAuthorName()

    {

        return $this->getData('author_name');

    }
}
