<?php


namespace AHT\Testimonial\Model;


class BlogRepository
{
    /**
     * @var $collection
     */
    protected $collection;

    /**
     * @param CollectionFactory $collectionFactory
     * @return void
     */
    public function __contruct(
        \AHT\Testimonial\Model\ResourceModel\Blog\CollectionFactory $collectionFactory
    )
    {
        $this->collection = $collectionFactory;
    }
    /**
     * {@inheritdoc}
     * @return array
     */
    public function getPost()
    {
        $blog = $this->collection->create();
        $blog->getData();
        return $blog;
    }
}
