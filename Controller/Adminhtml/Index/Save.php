<?php


namespace AHT\Testimonial\Controller\Adminhtml\Index;


use AHT\Testimonial\Model\Blog\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Backend\Model\Session;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Index';

    protected $dataPersistor;

    protected $resultPageFactory;

    protected $blogFactory;

    protected $_resource;

    protected $imageUploader;

    protected $date;

    private $_cacheTypeList;

    private $_cacheFrontendPool;

    protected $_session;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        \AHT\Testimonial\Model\ResourceModel\Blog $resouce,
        \AHT\Testimonial\Model\Blog\ImageUploader $imageUploader,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        Session $session
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->dataPersistor = $dataPersistor;
        $this->blogFactory = $blogFactory;
        $this->_resource = $resouce;
        $this->imageUploader = $imageUploader;
        $this->date = $date;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_session = $session;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $date = $this->date->gmtDate();
        $id = $data['id'];
            try{
                if (!isset($data['id'])) {
                    unset($data['created_at']);
                    if (isset($data['image'])) {
                        $imageName = $data['image'];
                    }
                    if (isset($data['image'][0]['name'])) {

                        $imageName = $data['image'][0]['name'];
                    }
                    if ($imageName) {
                        $this->imageUploader->moveFileFromTmp($imageName);
                    }

                    $blog = $this->blogFactory->create();
                    $this->_resource->load($blog, $id);

                    $data = array_filter($data, function($value) {return $value !== ''; });

                    $blog->setData($data);
                    $blog->save();
                    $this->messageManager->addSuccess(__('Successfully saved the item.'));
                    $this->_session->setFormData(false);
                    return $resultRedirect->setPath('*/*/');
                }else {
                    if (isset($data['image'])) {
                        $imageName = $data['image'];
                    }
                    if (isset($data['image'][0]['name'])) {

                        $imageName = $data['image'][0]['name'];
                    }
                    if ($imageName) {
                        $this->imageUploader->moveFileFromTmp($imageName);
                    }

                    $blog = $this->blogFactory->create();
                    $data['created_at'] = $date;
                    $data['updated_at'] = null;
                    $data['image'] = $imageName;

                    $data = array_filter($data, function($value) {return $value !== ''; });

                    $blog->setData($data);
                    $blog->save();
                    $this->messageManager->addSuccess(__('Successfully saved the item.'));
                    $this->_session->setFormData(false);
                    return $resultRedirect->setPath('*/*/');
                }
            }
            catch(\Exception $e)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_session->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }

        $types = array('config','layout','block_html','collections','reflection','db_ddl','compiled_config','eav','config_integration','config_integration_api','full_page','translate','config_webservice','vertex');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }

        return $resultRedirect->setPath('*/*/');
    }
}
