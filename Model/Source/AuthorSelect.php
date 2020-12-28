<?php

namespace AHT\Testimonial\Model\Source;

class AuthorSelect implements \Magento\Framework\Option\ArrayInterface
{
    protected $_author;

    public function __construct(
        \AHT\Testimonial\Model\ResourceModel\Author\CollectionFactory $authorFactory
    )
    {
        $this->_author = $authorFactory;
    }

    public function toOptionArray()
    {
        $collection = $this->_author->create();
        $author = $collection->getData();
        $result = [];
        foreach ($author as $item) {
            $result[] = [
                'value' => $item['author_id'],
                'label' => $item['author_name'],
            ];
        }
//        var_dump($result);
//        die();
        return $result;
    }
}
