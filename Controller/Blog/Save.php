<?php


namespace AHT\Testimonial\Controller\Blog;


use Magento\Framework\App\Action\Context;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \AHT\Testimonial\Model\BlogFactory
     */
    protected $_blogFactory;

    /**
     * @var \AHT\Testimonial\Model\ResourceModel\Blog
     */
    protected $_resource;

    protected $_pageFactory;

    protected $resultRedirect;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    private $_cacheTypeList;
    private $_cacheFrontendPool;

    /**
     * Save constructor.
     * @param Context $context
     * @param \AHT\Testimonial\Model\BlogFactory $blogFactory
     * @param \AHT\Testimonial\Model\ResourceModel\Blog $resource
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Controller\ResultFactory $result
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     */
    public function __construct(
        Context $context,
        \AHT\Testimonial\Model\BlogFactory $blogFactory,
        \AHT\Testimonial\Model\ResourceModel\Blog $resource,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->_storeManager = $storeManager;
        $this->_resource = $resource;
        $this->resultRedirect = $result;
        $this->_filesystem = $filesystem;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();

        $blog = $this->_blogFactory->create();

        if (isset($_POST['editBtn'])) {
            $data = [
                'id' => $post['blog_id'],
                'name' => $post['blog_name'],
                'email' => $post['blog_email'],
                'designation' => $post['blog_designation'],
                'contact' => $post['blog_contact'],
                'message' => $post['blog_message'],
                'image' => $_FILES['blog_image']['name'],
                'author_id' => 1
            ];
            $id = $data['id'];
            $this->_resource->load($blog, $id);
            $blog->setData($data);
        }else if (isset($_POST['createBtn'])) {
            $data = [
                'name' => $post['blog_name'],
                'email' => $post['blog_email'],
                'designation' => $post['blog_designation'],
                'contact' => $post['blog_contact'],
                'message' => $post['blog_message'],
                'image' => $_FILES['blog_image']['name'],
                'author_id' => 1
            ];
            $blog->setData($data);
        }

        $blog->save($data);

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
