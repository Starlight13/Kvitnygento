<?php

namespace Kvitny\BouquetEntity\Model\Data;

use Kvitny\BouquetEntity\Api\Data\BouquetInterface;
use Magento\Framework\DataObject;

class BouquetData extends DataObject implements BouquetInterface
{
    /**
     * @inheritDoc
     */
    public function getBouquetId(): ?int
    {
        return $this->getData(self::BOUQUET_ID) === null ? null
            : (int)$this->getData(self::BOUQUET_ID);
    }

    /**
     * @inheritDoc
     */
    public function setBouquetId(?int $bouquetId): void
    {
        $this->setData(self::BOUQUET_ID, $bouquetId);
    }

    /**
     * @inheritDoc
     */
    public function getFlowerQty(): ?int
    {
        return $this->getData(self::FLOWER_QTY) === null ? null
            : (int)$this->getData(self::FLOWER_QTY);
    }

    /**
     * @inheritDoc
     */
    public function setFlowerQty(?int $flowerQty): void
    {
        $this->setData(self::FLOWER_QTY, $flowerQty);
    }

    /**
     * @inheritDoc
     */
    public function getBouquetHeight(): ?int
    {
        return $this->getData(self::BOUQUET_HEIGHT) === null ? null
            : (int)$this->getData(self::BOUQUET_HEIGHT);
    }

    /**
     * @inheritDoc
     */
    public function setBouquetHeight(?int $bouquetHeight): void
    {
        $this->setData(self::BOUQUET_HEIGHT, $bouquetHeight);
    }

    /**
     * @inheritDoc
     */
    public function getColor(): ?string
    {
        return $this->getData(self::COLOR);
    }

    /**
     * @inheritDoc
     */
    public function setColor(?string $color): void
    {
        $this->setData(self::COLOR, $color);
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): ?string
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(?string $description): void
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @inheritDoc
     */
    public function getPackaging(): ?string
    {
        return $this->getData(self::PACKAGING);
    }

    /**
     * @inheritDoc
     */
    public function setPackaging(?string $packaging): void
    {
        $this->setData(self::PACKAGING, $packaging);
    }

    /**
     * @inheirtDoc
     */
    public function getBouquetName(): ?string
    {
        return $this->getData(self::BOUQUET_NAME);
    }

    /**
     * @inerhitDoc
     */
    public function setBouquetName(?string $bouquetName): void
    {
        $this->setData(self::BOUQUET_NAME, $bouquetName);
    }

    /**
     * @inheirtDoc
     */
    public function getImage(): ?string
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheirtDoc
     */
    public function setImage($image): void
    {
        $this->setData(self::IMAGE, $image);
    }
}
