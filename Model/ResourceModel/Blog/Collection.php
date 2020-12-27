<?php


namespace AHT\Testimonial\Model\ResourceModel\Blog;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'aht_testimonial_blog_collection';
    protected $_eventObject = 'blog_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\Blog', 'AHT\Testimonial\Model\ResourceModel\Blog');
    }

    protected function _initSelect()
    {
        $this->addFilterToMap('id','aht_testimonial_blog.id');

        $this->getSelect()

            ->from(['aht_testimonial_blog' => $this->getMainTable()])

            ->join('aht_blog_author',

                'aht_testimonial_blog.author_id = aht_blog_author.author_id',

                [

                    'author_name'

                ]);
        return $this;
    }
}
