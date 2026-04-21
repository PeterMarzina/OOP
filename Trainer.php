<?php

require_once __DIR__ . '/Pokemon.php';

class Trainer
{
    protected string $naam;
    protected int $badges;
    protected array $pokemons;

    public function __construct(string $naam, int $badges)
    {
        $this->naam = $naam;
        $this->badges = $badges;
        $this->pokemons = [];
    }

    // Getters
    public function getNaam(): string
    {
        return $this->naam;
    }

    public function getBadges(): int
    {
        return $this->badges;
    }

    // Setter
    public function setBadges(int $badges): void
    {
        if ($badges < 0 || $badges > 8) {
            return;
        }

        $this->badges = $badges;
    }

    public function addPokemon(Pokemon $pokemon): void
    {
        $this->pokemons[] = $pokemon;
    }

    public function showTeam(): array
    {
        $result = [];
        foreach ($this->pokemons as $pokemon) {
            $result[] = $pokemon->getNaam() . " (" . $pokemon->getType() . ")";
        }

        return $result;
    }

    // Voeg 1 badge toe
    public function earnBadge(): string
    {
        if ($this->badges >= 8) {
            return $this->naam . " heeft al 8 badges.";
        }

        $this->badges++;
        return $this->naam . " verdient een badge (" . $this->badges . ").";
    }

    // Wissel hele teams
    public function tradeAll(Trainer $otherTrainer): string
    {
        if (count($this->pokemons) === 0 || count($otherTrainer->pokemons) === 0) {
            return "Een van de trainers heeft geen Pokemon om te ruilen.";
        }

        $myPokemons = $this->pokemons;
        $otherPokemons = $otherTrainer->pokemons;

        $this->pokemons = $otherPokemons;
        $otherTrainer->pokemons = $myPokemons;

        return $this->naam . " en " . $otherTrainer->getNaam() . " hebben al hun Pokemon geruild!";
    }
}
