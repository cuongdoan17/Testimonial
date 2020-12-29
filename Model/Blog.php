<?php


namespace AHT\Testimonial\Model;


use AHT\Testimonial\Api\Data\BlogInterface;

class Blog extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'aht_testimonial_blog';

    protected $_cacheTag = 'aht_testimonial_blog';

    protected $_eventPrefix = 'aht_testimonial_blog';

    protected function _construct()
    {
        $this->_init('AHT\Testimonial\Model\ResourceModel\Blog');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

    public function getAuthorName()

    {

        return $this->getData('author_name');

    }


    /**
     * get blog name
     * @return string
     */
    public function getName() {
        return $this->getData('name');
    }

    /**
     * get blog email
     *
     * @return string
     */
    public function getEmail() {
        return $this->getData('email');
    }

    /**
     * get blog designation
     *
     * @return string
     */
    public function getDesignation() {
        return $this->getData('designation');
    }

    /**
     * get blog contact
     *
     * @return string
     */
    public function getContact() {
        return $this->getData('contact');
    }


    /**
     * get blog message
     *
     * @return string
     */
    public function getMessage() {
        return $this->getData('message');
    }

    /**
     * get blog image
     *
     * @return string
     */
    public function getImage() {
        return $this->getData('image');
    }

    /**
     * get author id
     *
     * @return integer
     */
    public function getAuthorId() {
        return $this->getData('author_id');
    }

    /**
     * set blog name
     *
     * @param $name
     * @return string
     */
    public function setName($name) {
        return $this->setData('name', $name);
    }

    /**
     * set blog email
     * @param $email
     * @return string
     */
    public function setEmail($email) {
        return $this->setData('email', $email);
    }

    /**
     * set blog designation
     * @param $designation
     * @return string
     */
    public function setDesignation($designation) {
        return $this->setData('designation', $designation);
    }

    /**
     * set blog contact
     *
     * @param $contact
     * @return string
     */
    public function setContact($contact) {
        return $this->setData('contact', $contact);
    }

    /**
     * set blog message
     *
     * @param $message
     * @return string
     */
    public function setMessage($message) {
        return $this->setData('message', $message);
    }

    /**
     * set blog image
     *
     * @param $image
     * @return string
     */
    public function setImage($image) {
        return $this->setData('image',$image);
    }

    /**
     * set Author Id
     *
     * @param $authorId
     * @return integer
     */
    public function setAuthorId($authorId) {
        return $this->setData('author_id', $authorId);
    }
}
