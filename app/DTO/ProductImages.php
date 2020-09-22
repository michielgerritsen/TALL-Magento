<?php
/**
 *    ______            __             __
 *   / ____/___  ____  / /__________  / /
 *  / /   / __ \/ __ \/ __/ ___/ __ \/ /
 * / /___/ /_/ / / / / /_/ /  / /_/ / /
 * \______________/_/\__/_/   \____/_/
 *    /   |  / / /_
 *   / /| | / / __/
 *  / ___ |/ / /_
 * /_/ _|||_/\__/ __     __
 *    / __ \___  / /__  / /____
 *   / / / / _ \/ / _ \/ __/ _ \
 *  / /_/ /  __/ /  __/ /_/  __/
 * /_____/\___/_/\___/\__/\___/
 *
 */

namespace App\DTO;

use Assert\Assertion;

class ProductImages
{
    /**
     * @var array
     */
    private $images;

    public function __construct(array $images)
    {
        Assertion::allIsInstanceOf($images, ProductImage::class);

        $this->images = $images;
    }

    /**
     * @return ProductImage[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return ProductImage
     */
    public function getImage()
    {
        foreach ($this->images as $image) {
            if ($image->getType() == 'image') {
                return $image;
            }
        }

        new NoSuchImageException();
    }

    /**
     * @return ProductImage
     */
    public function getSmallImage()
    {
        foreach ($this->images as $image) {
            if ($image->getType() == 'small_image') {
                return $image;
            }
        }

        new NoSuchImageException();
    }
}
