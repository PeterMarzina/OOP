<?php

class Move
{
    protected string $naam;
    protected string $type;
    protected int $power;
    protected int $pp;

    public function __construct(string $naam, string $type, int $power, int $pp)
    {
        $this->naam = $naam;
        $this->type = $type;
        $this->power = $power;
        $this->pp = $pp;
    }

    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPower(): int
    {
        return $this->power;
    }

    public function getPp(): int
    {
        return $this->pp;
    }

    public function setPp(int $pp): void
    {
        if ($pp < 0) {
            return;
        }

        $this->pp = $pp;
    }

    public function use(): bool
    {
        if ($this->pp <= 0) {
            return false;
        }

        $this->pp--;
        return true;
    }

    public function showInfo(): string
    {
        return $this->naam . " (" . $this->type . ") Power: " . $this->power . ", PP: " . $this->pp;
    }
}
