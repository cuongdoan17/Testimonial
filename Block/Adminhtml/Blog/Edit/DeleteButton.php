<?php


namespace AHT\Testimonial\Block\Adminhtml\Blog\Edit;



use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Block\Adminhtml\Block\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Framework\UrlInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    protected $_urlInterface;

    public function __construct(
        Context $context,
        BlockRepositoryInterface $blockRepository,
        UrlInterface $urlInterface
    )
    {
        $this->_urlInterface = $urlInterface;
        parent::__construct($context, $blockRepository);
    }

    public function getButtonData()
    {
        return [
            'label' => __('Delete Contact'),
            'on_click' => 'deleteConfirm(\'' . __('Are you sure you want to delete this contact ?') . '\', \'' . $this->getDeleteUrl() . '\')',
            'class' => 'delete',
            'sort_order' => 20
        ];
    }

    public function getDeleteUrl()
    {
        $url = $this->_urlInterface->getCurrentUrl();

        $parts = explode('/', parse_url($url, PHP_URL_PATH));

        $id = $parts[6];

        return $this->getUrl('*/*/delete', ['id' => $id]);
    }
}
