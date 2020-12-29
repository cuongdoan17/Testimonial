<?php


namespace AHT\Testimonial\Model\Blog;


use AHT\Testimonial\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

use AHT\Testimonial\Model\Blog\FileInfo;
use Magento\Framework\Filesystem;

class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \AHT\Testimonial\Model\ResourceModel\Blog\CollectionFactory
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var Filesystem
     */
    private $fileInfo;

    protected $_storeManager;

    protected $_FileInfo;
    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $testimonialCollecionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $testimonialCollecionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        FileInfo $FileInfo,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $testimonialCollecionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager = $storeManager;
        $this->_FileInfo = $FileInfo;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $testimonial) {
            $testimonial = $this->convertValues($testimonial);
            $this->loadedData[$testimonial->getId()] = $testimonial->getData();
        }

        $data = $this->dataPersistor->get('testimonial');
        if (!empty($data)) {
            $testimonial = $this->collection->getNewEmptyItem();
            $testimonial->setData($data);
            $this->loadedData[$testimonial->getId()] = $testimonial->getData();
            $this->dataPersistor->clear('testimonial');
        }

        return $this->loadedData;
    }
    /**
     * Converts image data to acceptable for rendering format
     *
     * @param \AHT\Testimonial\Model\Blog $testimonial
     * @return \AHT\Testimonial\Model\Blog $testimonial
     */
    private function convertValues(\AHT\Testimonial\Model\Blog $testimonial)
    {
        $fileName = $testimonial->getImage();

        $image = [];
        if ($this->_FileInfo->isExist($fileName)) {
            $stat = $this->_FileInfo->getStat($fileName);
            $mime = $this->_FileInfo->getMimeType($fileName);
            $image[0]['name'] = $fileName;
            $image[0]['url'] = $this->_storeManager->getStore()->getBaseUrl()."pub/media/testimonial/tmp/index/".$fileName;
            $image[0]['size'] = isset($stat) ? $stat['size'] : 0;
            $image[0]['type'] = $mime;
        }
        $testimonial->setImage($image);

        return $testimonial;
    }
}
