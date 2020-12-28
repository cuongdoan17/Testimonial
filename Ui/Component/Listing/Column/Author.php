<?php


namespace AHT\Testimonial\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Author extends Column
{
    protected $_author;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \AHT\Testimonial\Model\ResourceModel\Author\CollectionFactory $collectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_author = $collectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                $id = $items['author_id'];
                $authorName = $this->_author->create()
                    ->addFieldToFilter('author_id', $id)
                    ->addFieldToSelect('author_name')
                    ->getData();
                $items['author_id'] = $authorName[0]['author_name'];
            }
        }
        return $dataSource;
    }
}
