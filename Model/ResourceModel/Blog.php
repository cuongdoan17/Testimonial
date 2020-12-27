<?php


namespace AHT\Testimonial\Model\ResourceModel;


class Blog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('aht_testimonial_blog', 'id');
    }

    protected function _getLoadSelect($field, $value, $object)

    {
        $field = $this->getConnection()->quoteIdentifier(sprintf('%s.%s', $this->getMainTable(), $field));

        $select = $this->getConnection()

            ->select()

            ->from($this->getMainTable())

            ->where($field . '=?', $value)

            ->joinRight('aht_blog_author',

                'aht_testimonial_blog.author_id = aht_blog_author.post_id',

                [

                    'auhtor_name',
                    'author_email'

                ]);

        return $select;

    }
}
