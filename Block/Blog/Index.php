<?php

namespace AHT\Testimonial\Block\Blog;


use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_blog;

    public function __construct(
        Template\Context $context,
        \AHT\Testimonial\Model\ResourceModel\Blog\CollectionFactory $blogFactory,
        array $data = []
    )
    {
        $this->_blog = $blogFactory;
        parent::__construct($context, $data);
    }

    /**
     * Preparing global layout
     *
     * @return $this
     */
    protected function _prepareLayout() {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Blog Collection'));
        return $this;
    }

    public function getAll() {
        $collecion = $this->_blog->create();
        return $collecion;
    }

    public function getCreate() {
            return $this->getUrl('testimonial/blog/create');
    }
}
