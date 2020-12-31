<?php


namespace AHT\Testimonial\Controller\Adminhtml\Author;


use Magento\Backend\App\Action;

class Save extends Action
{
    const ADMIN_RESOURCE = 'Index';

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
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        $id = $data['author_id'];
        if($data)
        {
            try{

                $author = $this->authorFactory->create()->load($id);

                $data = array_filter($data, function($value) {return $value !== ''; });

                $author->setData($data);
                $author->save();
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            }
            catch(\Exception $e)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
