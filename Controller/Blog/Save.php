<?php


namespace AHT\Testimonial\Controller\Blog;


use Magento\Framework\App\Action\Context;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_blogFactory;

    protected $_pageFactory;

    protected $resultRedirect;

    private $_cacheTypeList;
    private $_cacheFrontendPool;

    public function __construct(
        Context $context,
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->resultRedirect = $result;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $blog = $this->_blogFactory->create();
        $data = [
            'name' => $post['blog_name'],
            'email' => $post['blog_email'],
            'designation' => $post['blog_designation'],
            'contact' => $post['blog_contact'],
            'message' => $post['blog_message'],
//            'image' => $post['blog_image'],
        ];

        if (isset($_POST['createBtn'])){
            $blog->setData($data);
            $blog->save();
        }

        $types = array('config','layout','block_html','collections','reflection','db_ddl','compiled_config','eav','config_integration','config_integration_api','full_page','translate','config_webservice','vertex');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('testimonial/blog/index');
        return $resultRedirect;
    }
}
