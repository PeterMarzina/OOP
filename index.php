<?php

require_once __DIR__ . '/Move.php';
require_once __DIR__ . '/Pokemon.php';
require_once __DIR__ . '/Trainer.php';

// Moves
$move1 = new Move("Thunderbolt", "Electric", 90, 15);
$move2 = new Move("Flamethrower", "Fire", 90, 15);
$move3 = new Move("Water Pulse", "Water", 60, 20);
$move4 = new Move("Vine Whip", "Grass", 45, 25);

// Pokemon
$pokemon1 = new ElektrischPokemon("Pikachu", "Electric", 25, 80, "Static");
$pokemon2 = new VuurPokemon("Charmander", "Fire", 18, 70, "Blaze");
$pokemon3 = new WaterPokemon("Squirtle", "Water", 20, 85, "Torrent");
$pokemon4 = new VliegPokemon("Pidgeot", "Flying", 30, 90, "Keen Eye");

// Koppel moves
$pokemon1->addMove($move1);
$pokemon1->addMove($move4);
$pokemon2->addMove($move2);
$pokemon2->addMove($move4);
$pokemon3->addMove($move3);
$pokemon3->addMove($move1);
$pokemon4->addMove($move1);
$pokemon4->addMove($move2);

// Trainers
$trainer1 = new Trainer("Ash", 5);
$trainer2 = new Trainer("Misty", 6);

// Teams
$trainer1->addPokemon($pokemon1);
$trainer1->addPokemon($pokemon2);
$trainer2->addPokemon($pokemon3);
$trainer2->addPokemon($pokemon1);

// Overzicht
$pokemons = [$pokemon1, $pokemon2, $pokemon3, $pokemon4];
$trainers = [$trainer1, $trainer2];

// Tests
$tests = [];
$tests[] = $pokemon1->attack($pokemon3);
$tests[] = $pokemon3->heal(15);
$tests[] = $pokemon2->levelUp();
$tests[] = $trainer1->earnBadge();
$tests[] = $move1->use() ? "Thunderbolt gebruikt (PP nu " . $move1->getPp() . ")" : "Thunderbolt faalt";

$pokemon1->setHp(-10);
$pokemon2->setLevel(200);
$trainer2->setBadges(99);
$move2->setPp(-1);

$tests[] = "Na ongeldige setHp: " . $pokemon1->getHp();
$tests[] = "Na ongeldige setLevel: " . $pokemon2->getLevel();
$tests[] = "Na ongeldige setBadges: " . $trainer2->getBadges();
$tests[] = "Na ongeldige setPp: " . $move2->getPp();

$tests[] = $pokemon1->specialMove();
$tests[] = $pokemon2->specialMove();
$tests[] = $pokemon3->specialMove();
$tests[] = $pokemon4->specialMove();
$tests[] = $pokemon1->evolve();
$tests[] = $pokemon2->evolve();
$tests[] = $trainer1->tradeAll($trainer2);
$tests[] = "Trainer1 team na ruil: " . implode(", ", $trainer1->showTeam());
$tests[] = "Trainer2 team na ruil: " . implode(", ", $trainer2->showTeam());
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Pokemon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f7f7f7;
        }

        h1,
        h2 {
            color: #333;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
        }

        .card {
            background: #fff;
            padding: 16px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .label {
            font-weight: bold;
        }

        .section {
            margin-bottom: 28px;
        }
    </style>
</head>

<body>
    <h1>Pokemon Systeem</h1>

    <div class="section">
        <h2>Pokemon Overzicht</h2>
        <div class="grid">
            <?php foreach ($pokemons as $p): ?>
                <div class="card">
                    <div><span class="label">Naam:</span> <?= htmlspecialchars($p->getNaam()) ?></div>
                    <div><span class="label">Type:</span> <?= htmlspecialchars($p->getType()) ?></div>
                    <div><span class="label">Level:</span> <?= $p->getLevel() ?></div>
                    <div><span class="label">HP:</span> <?= $p->getHp() ?></div>
                    <div><span class="label">Ability:</span> <?= htmlspecialchars($p->getAbility()) ?></div>
                    <hr>
                    <div class="label">Moves:</div>
                    <ul>
                        <?php foreach ($p->showMoves() as $moveInfo): ?>
                            <li><?= htmlspecialchars($moveInfo) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2>Trainer Overzicht</h2>
        <div class="grid">
            <?php foreach ($trainers as $t): ?>
                <div class="card">
                    <div><span class="label">Naam:</span> <?= htmlspecialchars($t->getNaam()) ?></div>
                    <div><span class="label">Badges:</span> <?= $t->getBadges() ?></div>
                    <hr>
                    <div class="label">Team:</div>
                    <ul>
                        <?php foreach ($t->showTeam() as $teamInfo): ?>
                            <li><?= htmlspecialchars($teamInfo) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section">
        <h2>Test Output</h2>
        <div class="card">
            <ul>
                <?php foreach ($tests as $line): ?>
                    <li><?= htmlspecialchars($line) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>

</html>