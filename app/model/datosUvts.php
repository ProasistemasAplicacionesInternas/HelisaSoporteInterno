<?php
class Uvts
{
    private $year_uvt;
    private $value_uvt;

    public function getYearUvt()
    {
        return $this->year_uvt;
    }

    public function setYearUvt($year_uvt): self
    {
        $this->year_uvt = $year_uvt;

        return $this;
    }

    public function getValueUvt()
    {
        return $this->value_uvt;
    }

    public function setValueUvt($value_uvt): self
    {
        $this->value_uvt = $value_uvt;

        return $this;
    }
}
