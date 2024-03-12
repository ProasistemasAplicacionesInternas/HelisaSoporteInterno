<?php
class DataCategoryAssets
{
    private $id;
    private $nameCategory;
    private $areaCategory;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    public function setNameCategory($nameCategory): self
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    public function getAreaCategory()
    {
        return $this->areaCategory;
    }

    public function setAreaCategory($areaCategory): self
    {
        $this->areaCategory = $areaCategory;

        return $this;
    }
}