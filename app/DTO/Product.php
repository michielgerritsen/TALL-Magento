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

class Product
{
    const SIMPLE = 'SimpleProduct';
    const CONFIGURABLE = 'ConfigurableProduct';
    const BUNDLE = 'BundleProduct';
    const DOWNLOADABLE = 'DownloadableProduct';
    const GROUPED = 'GroupedProduct';

    const TYPE_IDS = [
        self::SIMPLE,
        self::CONFIGURABLE,
        self::BUNDLE,
        self::DOWNLOADABLE,
        self::GROUPED,
    ];

    /**
     * @var string
     */
    private $typeId;

    /**
     * @var string
     */
    private $urlKey;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $sku;

    /**
     * @var string
     */
    private $description;

    /**
     * @var ProductImages
     */
    private $productImages;

    /**
     * @var ProductImages
     */
    private $gallery;

    /**
     * @var ProductPrices
     */
    private $prices;

    /**
     * @var ProductTypeSpecific
     */
    private $productTypeSpecific;

    private function __construct(
        string $typeId,
        string $urlKey,
        string $name,
        string $sku,
        string $description,
        ProductImages $productImages,
        ProductImages $gallery,
        ProductPrices $prices,
        ProductTypeSpecific $productTypeSpecific
    ) {
        Assertion::inArray($typeId, static::TYPE_IDS);

        $this->typeId = $typeId;
        $this->urlKey = $urlKey;
        $this->name = $name;
        $this->sku = $sku;
        $this->description = $description;
        $this->productImages = $productImages;
        $this->gallery = $gallery;
        $this->prices = $prices;
        $this->productTypeSpecific = $productTypeSpecific;
    }

    public static function fromGraphqlResponse(array $data): Product
    {
        $images = [];
        foreach ($data['media_gallery'] as $image) {
            $images[] = new ProductImage('media_gallery', $image['label'], $image['url']);
        }

        return new Product(
            $data['__typename'],
            $data['url_key'],
            $data['name'],
            $data['sku'],
            $data['description']['html'],
            new ProductImages([
                new ProductImage(
                    'small_image',
                    $data['small_image']['label'],
                    $data['small_image']['url']
                ),
                new ProductImage(
                    'image',
                    $data['image']['label'],
                    $data['image']['url']
                ),
            ]),
            new ProductImages($images),
            new ProductPrices(
                new Price($data['price']['maximalPrice']['amount']['currency'], $data['price']['maximalPrice']['amount']['value']),
                new Price($data['price']['minimalPrice']['amount']['currency'], $data['price']['minimalPrice']['amount']['value']),
                new Price($data['price']['regularPrice']['amount']['currency'], $data['price']['regularPrice']['amount']['value'])
            ),
            ProductTypeSpecific::fromArray($data)
        );
    }

    /**
     * @return string
     */
    public function getTypeId(): string
    {
        return $this->typeId;
    }

    /**
     * @return string
     */
    public function getUrlKey(): string
    {
        return $this->urlKey;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return ProductPrices
     */
    public function getPrices(): ProductPrices
    {
        return $this->prices;
    }

    /**
     * @return ProductImages
     */
    public function getProductImages(): ProductImages
    {
        return $this->productImages;
    }

    /**
     * @return ProductTypeSpecific
     */
    public function getProductTypeSpecific(): ProductTypeSpecific
    {
        return $this->productTypeSpecific;
    }
}
