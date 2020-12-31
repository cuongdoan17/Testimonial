<?php


namespace AHT\Testimonial\Controller\Adminhtml\Author;


use Magento\Backend\App\Action;

class Delete extends Action
{
    const ADMIN_RESOURCE = 'Author';

    protected $resultPageFactory;
    protected $authorFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \AHT\Testimonial\Model\AuthorFactory $authorFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->authorFactory = $authorFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('author_id');

        $blog = $this->authorFactory->create()->load($id);

        if(!$blog)
        {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }

        try{
            $blog->delete();
            $this->messageManager->addSuccess(__('Your author has been deleted !'));
        }
        catch(\Exception $e)
        {
            $this->messageManager->addError(__('Error while trying to delete contact'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
