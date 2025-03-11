<?php

namespace skyss0fly\AeroAPI;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Messages extends PluginBase {

    public function sendErrorToConsole(string $str): void {
        $this->getLogger()->error("AeroAPI: " . $str);
    }

    public function sendErrorToPlayer(string $str, Player $player): void {
        if (!$player instanceof Player) {
            $this->sendErrorToConsole("Player Not Found!");
            return;
        }
        $player->sendMessage(TextFormat::RED . "AeroAPI: " . $str);
    }
}
