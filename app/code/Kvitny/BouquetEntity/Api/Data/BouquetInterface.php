<?php

namespace Kvitny\BouquetEntity\Api\Data;

interface BouquetInterface
{
    /**
     * String constants for property names
     */
    const BOUQUET_ID = "bouquet_id";
    const BOUQUET_NAME = "bouquet_name";
    const FLOWER_QTY = "flower_qty";
    const BOUQUET_HEIGHT = "bouquet_height";
    const COLOR = "color";
    const DESCRIPTION = "description";
    const PACKAGING = "packaging";
    const IMAGE = "image";
    const BASE_IMAGE_PATH = 'catalog/bouquet';
    const BASE_TMP_IMAGE_PATH = 'catalog/tmp/bouquet';

    /**
     * Getter for BouquetId.
     *
     * @return int|null
     */
    public function getBouquetId(): ?int;

    /**
     * Setter for BouquetId.
     *
     * @param int|null $bouquetId
     *
     * @return void
     */
    public function setBouquetId(?int $bouquetId): void;

    /**
     * Getter for BouquetName
     *
     * @return string|null
     */
    public function getBouquetName(): ?string;

    /**
     * Setter for BouquetName
     *
     * @param string|null $bouquetName
     *
     * @return void
     */
    public function setBouquetName(?string $bouquetName): void;

    /**
     * Getter for FlowerQty.
     *
     * @return int|null
     */
    public function getFlowerQty(): ?int;

    /**
     * Setter for FlowerQty.
     *
     * @param int|null $flowerQty
     *
     * @return void
     */
    public function setFlowerQty(?int $flowerQty): void;

    /**
     * Getter for BouquetHeight.
     *
     * @return int|null
     */
    public function getBouquetHeight(): ?int;

    /**
     * Setter for BouquetHeight.
     *
     * @param int|null $bouquetHeight
     *
     * @return void
     */
    public function setBouquetHeight(?int $bouquetHeight): void;

    /**
     * Getter for Color.
     *
     * @return string|null
     */
    public function getColor(): ?string;

    /**
     * Setter for Color.
     *
     * @param string|null $color
     *
     * @return void
     */
    public function setColor(?string $color): void;

    /**
     * Getter for Description.
     *
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * Setter for Description.
     *
     * @param string|null $description
     *
     * @return void
     */
    public function setDescription(?string $description): void;

    /**
     * Getter for Packaging.
     *
     * @return string|null
     */
    public function getPackaging(): ?string;

    /**
     * Setter for Packaging.
     *
     * @param string|null $packaging
     *
     * @return void
     */
    public function setPackaging(?string $packaging): void;

    /**
     * Getter for Image.
     *
     * @return string|null
     */
    public function getImage(): ?string;

    /**
     * Setter for Image.
     *
     * @param string|null $image
     *
     * @return void
     */
    public function setImage(?string $image): void;
}
