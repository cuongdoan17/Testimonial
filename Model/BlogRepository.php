<?php


namespace AHT\Testimonial\Model;


use AHT\Testimonial\Api\AHT;
use AHT\Testimonial\Api\BlogRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class BlogRepository implements BlogRepositoryInterface
{
    /**
     * @var ResourceModel\Blog
     */
    protected $_resource;

    /**
     * @var Blog
     */
    protected $_blogFactory;

    /**
     * @var ResourceModel\Blog\CollectionFactory
     */
    protected $_blogCollectionFactory;

    /**
     * BlogRepository constructor.
     * @param Blog $blogFactory
     * @param ResourceModel\Blog $resource
     * @param ResourceModel\Blog\CollectionFactory $blogCollectionFactory
     */
    public function __construct(
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        \AHT\Testimonial\Model\ResourceModel\Blog $resource,
        \AHT\Testimonial\Model\ResourceModel\Blog\CollectionFactory $blogCollectionFactory
    )
    {
        $this->_resource = $resource;
        $this->_blogFactory = $blogFactory;
        $this->_blogCollectionFactory = $blogCollectionFactory;
    }


    /**
     * @param AHT\Testimonial\Api\Data\BlogInterface|\AHT\Testimonial\Api\Data\BlogInterface $blog
     * @return \AHT\Testimonial\Api\Data\BlogInterface|void
     */
    public function save($blog)
    {
        try {
            $this->_resource->save($blog);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $blog;
    }

    /**
     * @return mixed|void
     */
    public function getList()
    {
        $collection = $this->_blogCollectionFactory->create();
        return $collection->getData();
    }

    /**
     * @param int $id
     * @return AHT\Testimonial\Api\Data\BlogInterface|void
     */
    public function getById($id)
    {
        $blog = $this->_blogFactory->create();
        $blog->load($id);
        if (!$blog->getId()) {
            throw new NoSuchEntityException(__('The CMS Post with the "%1" ID doesn\'t exist.', $id));
        }
        return $blog->getData();
    }

    /**
     * @param \AHT\Testimonial\Api\Data\BlogInterface $blog
     * @return bool|void
     */
    public function delete($blog)
    {
        $blogModel = $this->_blogFactory->create();
        $blogModel->setData($blog);
        try {
            $this->_resource->delete($blogModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool|void
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
