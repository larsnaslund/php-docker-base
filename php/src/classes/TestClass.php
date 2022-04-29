<?php

class TestClass
{
    private int $int;

    public function printMessage($str): void
    {
        echo $str;
    }

    public function setInt(int $int): void
    {
        $this->int = $int;
    }

}