
<?php

namespace skyss0fly\AeroAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;

class Main extends PluginBase {
    private $money = [];
    public version;
    public isdevelopment;
    
    public function onLoad(): void {
        // Initialize the money array
        $this->money = [];
        $this->version = 0.2; // 0.3 is next
        $this->isdevelopment = true;


    }
    public function getApiVersion(): bool {
        return $this->version;
    }
public function isApiInDevelopment(): bool {
    return $this->isdevelopment;
}

    public function addMoney(Player $player, int $amount): bool {
        $playerName = $player->getName();
        
        // Check if the player already has money recorded
        if (isset($this->money[$playerName])) {
            $previous = $this->money[$playerName];
        } else {
            $previous = 0;
        }

        // Calculate the new amount
        $new = $previous + $amount;
        $this->money[$playerName] = $new;

        // Return true to indicate the operation was successful
        return true;
    }

    public function getMoney(Player $player): int {
        $playerName = $player->getName();

        // Return the player's money or 0 if not set
        return $this->money[$playerName] ?? 0;
    }
}

public function deductMoney(Player $player, int $amount): bool {
        $playerName = $player->getName();
        
        // Check if the player already has money recorded
        if (isset($this->money[$playerName])) {
            $previous = $this->money[$playerName];
        } else {
            $previous = 0;
        }

        // Calculate the new amount
        $new = $previous - $amount;
        $this->money[$playerName] = $new;

        // Return true to indicate the operation was successful
        return true;
}
