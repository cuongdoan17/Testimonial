<?php

namespace AHT\Testimonial\Api;

interface BlogRepositoryInterface
{
    /**
     * Save Blog
     *
     * @param AHT\Testimonial\Api\Data\BlogInterface $blog
     * @return \AHT\Testimonial\Api\Data\BlogInterface
     */
    public function save(\AHT\Testimonial\Api\Data\BlogInterface $blog);

    /**
     * get all blog
     *
     * @return \AHT\Testimonial\Api\Data\BlogInterface
     */
    public function getList();

    /**
     * Retrieve Blog
     *
     * @param int $id
     * @return AHT\Testimonial\Api\Data\BlogInterface
     */
    public function getById($id);

    /**
     * @param \AHT\Testimonial\Api\Data\BlogInterface $blog
     * @return bool true on success
     */
    public function delete(\AHT\Testimonial\Api\Data\BlogInterface $blog);


    /**
     * @param int $id
     * @return bool true on success
     */
    public function deleteById($id);

}
