<?php
namespace skyss0fly\AeroAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;

class Main extends PluginBase {
    private $money = [];
    private $dataFile;
    private const VERSION = "0.2"; // Use string for precise versioning
    private bool $isDevelopment = true;

    public function getApiVersion(): string {
        return self::VERSION;
    }

    public function isApiInDevelopment(): bool {
        return $this->isDevelopment;
    }


    public function onEnable(): void {
        // Define the data file path
        $this->dataFile = $this->getDataFolder() . "money.json";

        // Ensure the directory exists
        if (!is_dir($this->getDataFolder())) {
            @mkdir($this->getDataFolder(), 0777, true);
        }

        // Load player balances from the JSON file
        if (file_exists($this->dataFile)) {
            $this->money = json_decode(file_get_contents($this->dataFile), true) ?? [];
        }
    }

    public function onDisable(): void {
        // Save player balances to the JSON file when the server stops
        file_put_contents($this->dataFile, json_encode($this->money, JSON_PRETTY_PRINT));
    }

    public function addMoney(Player $player, int $amount): bool {
        $playerName = $player->getName();
        $this->money[$playerName] = ($this->money[$playerName] ?? 0) + $amount;
        $this->saveData(); // Save changes
        return true;
    }

    public function getMoney(Player $player): int {
        return $this->money[$player->getName()] ?? 0;
    }

    public function deductMoney(Player $player, int $amount): bool {
        $playerName = $player->getName();
        $currentBalance = $this->money[$playerName] ?? 0;

        if ($currentBalance < $amount) {
            return false; // Not enough money
        }

        $this->money[$playerName] = $currentBalance - $amount;
        $this->saveData(); // Save changes
        return true;
    }

    private function saveData(): void {
        file_put_contents($this->dataFile, json_encode($this->money, JSON_PRETTY_PRINT));
    }
            }
