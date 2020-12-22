<?php


namespace AHT\Testimonial\Observer;


use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ShowMessageText implements ObserverInterface
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @codeCoverageIgnore
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->messageManager = $messageManager;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        try {
            $this->messageManager->addNotice( __('Hello World') );
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Load customer quote error'));
        }
    }
}
