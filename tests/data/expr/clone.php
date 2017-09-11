<?php

namespace Malios;

class Test
{
    private $dateTime = null;

    public function cloneSelf(): self
    {
        return clone $this;
    }

    public function setDateTime(\DateTime $dt)
    {
        $this->dateTime = clone $dt;
    }

    public function getDateTime(): \DateTime
    {
        return clone $this->dateTime;
    }
}
