<?php

namespace AHT\Testimonial\Api\Data;


interface BlogInterface
{
    /**
     * get blog name
     * @return string
     */
    public function getName();

    /**
     * get blog email
     *
     * @return string
     */
    public function getEmail();

    /**
     * get blog designation
     *
     * @return string
     */
    public function getDesignation();

    /**
     * get blog contact
     *
     * @return string
     */
    public function getContact();


    /**
     * get blog message
     *
     * @return string
     */
    public function getMessage();

    /**
     * get blog image
     *
     * @return string
     */
    public function getImage();

    /**
     * get author id
     *
     * @return integer
     */
    public function getAuthorId();

    /**
     * set blog name
     *
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * set blog email
     * @param $email
     * @return string
     */
    public function setEmail($email);

    /**
     * set blog designation
     * @param $designation
     * @return string
     */
    public function setDesignation($designation);

    /**
     * set blog contact
     *
     * @param $contact
     * @return string
     */
    public function setContact($contact);

    /**
     * set blog message
     *
     * @param $message
     * @return string
     */
    public function setMessage($message);

    /**
     * set blog image
     *
     * @param $image
     * @return string
     */
    public function setImage($image);

    /**
     * set Author Id
     *
     * @param $authorId
     * @return integer
     */
    public function setAuthorId($authorId);
}
