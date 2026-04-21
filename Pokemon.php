<?php

require_once __DIR__ . '/Move.php';

// Pokemon die kan evolueren
interface Evolvable
{
    public function evolve(): string;
}

// Basis Pokemon klasse
abstract class Pokemon
{

    protected string $naam;
    protected string $type;
    protected int $level;
    protected int $hp;
    protected string $ability;
    protected array $moves;


    public function __construct(string $naam, string $type, int $level, int $hp, string $ability)
    {
        $this->naam = $naam;
        $this->type = $type;
        $this->level = $level;
        $this->hp = $hp;
        $this->ability = $ability;
        $this->moves = [];
    }

    // Getters
    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getAbility(): string
    {
        return $this->ability;
    }

    // Setters
    public function setLevel(int $level): void
    {
        if ($level < 1 || $level > 100) {
            return;
        }

        $this->level = $level;
    }

    public function setHp(int $hp): void
    {
        if ($hp < 0) {
            return;
        }

        $this->hp = $hp;
    }

    public function addMove(Move $move): void
    {
        $this->moves[] = $move;
    }

    public function showMoves(): array
    {
        $result = [];
        foreach ($this->moves as $move) {
            $result[] = $move->showInfo();
        }

        return $result;
    }

    // Gebruik eerste move op target
    public function attack(Pokemon $target): string
    {
        if (count($this->moves) === 0) {
            return $this->naam . " heeft geen moves.";
        }

        $move = $this->moves[0];
        if (!$move->use()) {
            return $this->naam . " kan " . $move->getNaam() . " niet gebruiken (PP op).";
        }

        $damage = max(1, intdiv($move->getPower(), 10));
        $target->setHp(max(0, $target->getHp() - $damage));

        return $this->naam . " gebruikt " . $move->getNaam() . " op " . $target->getNaam() . " (-" . $damage . " HP).";
    }

    // Herstel HP
    public function heal(int $amount): string
    {
        if ($amount <= 0) {
            return $this->naam . " kan niet healen met " . $amount . ".";
        }

        $this->setHp($this->hp + $amount);
        return $this->naam . " healt +" . $amount . " HP.";
    }

    // Verhoog level met 1
    public function levelUp(): string
    {
        if ($this->level >= 100) {
            return $this->naam . " is al level 100.";
        }

        $this->level++;
        return $this->naam . " is nu level " . $this->level . ".";
    }

    // Elke type Pokemon heeft eigen special move
    abstract public function specialMove(): string;
}

// Concrete Pokemon

class VuurPokemon extends Pokemon implements Evolvable
{
    public function specialMove(): string
    {
        return $this->naam . " gebruikt Fire Blast!";
    }

    public function evolve(): string
    {
        return $this->naam . " evolueert naar Charizard!";
    }
}

class WaterPokemon extends Pokemon implements Evolvable
{
    public function specialMove(): string
    {
        return $this->naam . " gebruikt Hydro Pump!";
    }

    public function evolve(): string
    {
        return $this->naam . " evolueert naar Blastoise!";
    }
}

class VliegPokemon extends Pokemon implements Evolvable
{
    public function specialMove(): string
    {
        return $this->naam . " gebruikt Sky Attack!";
    }

    public function evolve(): string
    {
        return $this->naam . " evolueert naar Pidgeot!";
    }
}

class ElektrischPokemon extends Pokemon implements Evolvable
{
    public function specialMove(): string
    {
        return $this->naam . " gebruikt Thunderbolt!";
    }

    public function evolve(): string
    {
        return $this->naam . " evolueert naar Raichu!";
    }
}
