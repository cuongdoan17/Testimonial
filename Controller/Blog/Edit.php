<?php


namespace AHT\Testimonial\Controller\Blog;


use Magento\Framework\App\ResponseInterface;

class Edit extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_blogFactory;

    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        \Magento\Framework\Registry $coreRegistry
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_blogFactory = $blogFactory;
        $this->_coreRegistry = $coreRegistry;

        return parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParams('id');
        $this->_coreRegistry->register('id', $id);

        return $this->_pageFactory->create();
    }
}
