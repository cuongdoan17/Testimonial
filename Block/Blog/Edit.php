<?php


namespace AHT\Testimonial\Block\Blog;


class Edit extends \Magento\Framework\View\Element\Template
{
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_blogFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        array $data = []
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_blogFactory = $blogFactory;
        return parent::__construct($context,$data);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

    public function getById()
    {
        $id = $this->_coreRegistry->registry('id');
        $blog = $this->_blogFactory->create();
        $result = $blog->load($id);
        $result = $result->getData();
        return $result;
    }
}
