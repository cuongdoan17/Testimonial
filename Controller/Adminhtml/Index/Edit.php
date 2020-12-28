<?php


namespace AHT\Testimonial\Controller\Adminhtml\Index;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        return $this->resultPageFactory->create();
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AHT_Testimonial::index');
    }
}
