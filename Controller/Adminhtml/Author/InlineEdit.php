<?php
namespace AHT\Testimonial\Controller\Adminhtml\Author;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Testimonial\Model\AuthorFactory;
use AHT\Testimonial\Model\ResourceModel\Author;

class InlineEdit extends Action
{
    protected $jsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
        $postItems = $this->getRequest()->getParam('items', []);
        if (!count($postItems)) {
        $messages[] = __('Please correct the data sent.');
        $error = true;
        } else {
        foreach (array_keys($postItems) as $modelid) {

        $model = $this->_objectManager->create(\AHT\Testimonial\Model\Author::class)->load($modelid);
        try {
        $model->setData(array_merge($model->getData(), $postItems[$modelid]));
        $model->save();
        } catch (\Exception $e) {
        $messages[] = "[Author ID: {$modelid}]  {$e->getMessage()}";
        $error = true;
        }
        }
        }
        }

        return $resultJson->setData([
        'messages' => $messages,
        'error' => $error
        ]);
        }
}

