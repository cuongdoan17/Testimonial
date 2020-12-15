<?php


namespace AHT\Testimonial\Controller\Adminhtml\Index;


use AHT\Testimonial\Model\Blog\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Index';

    protected $dataPersistor;

    protected $resultPageFactory;

    protected $blogFactory;

    protected $imageUploader;

    protected $date;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        \AHT\Testimonial\Model\Blog\ImageUploader $imageUploader,
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->dataPersistor = $dataPersistor;
        $this->blogFactory = $blogFactory;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
        $this->date = $date;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $date = $this->date->gmtDate();

            try{
                if (!isset($data['id'])) {
                    $id = $data['id'];
                    unset($data['created_at']);

                    $blog = $this->blogFactory->create()->load($id);

                    $data = array_filter($data, function($value) {return $value !== ''; });

                    $blog->setData($data);
                    $blog->save();
                    $this->messageManager->addSuccess(__('Successfully saved the item.'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                    return $resultRedirect->setPath('*/*/');
                }else {
                    if (isset($data['image'])) {
                        $imageName = $data['image'];
                    }
                    if (isset($data['image'][0]['name'])) {

                        $imageName = $data['image'][0]['name'];
                    }

                    $blog = $this->blogFactory->create();
                    $data['created_at'] = $date;
                    $data['updated_at'] = null;
                    $data['image'] = $imageName;

                    $data = array_filter($data, function($value) {return $value !== ''; });

                    $blog->setData($data);
                    $blog->save();
                    $this->messageManager->addSuccess(__('Successfully saved the item.'));
                    $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                    return $resultRedirect->setPath('*/*/');
                }
            }
            catch(\Exception $e)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $blog->getId()]);
            }

        return $resultRedirect->setPath('*/*/');
    }
}
