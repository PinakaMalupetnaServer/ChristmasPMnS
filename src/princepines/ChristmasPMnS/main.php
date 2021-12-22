<?php

namespace princepines\ChristmasPMnS;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;


class main extends PluginBase implements Listener
{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }


    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "launch":
                if ($sender instanceof Player) {
                    $this->getScheduler()->scheduleRepeatingTask(new LaunchTask($this, $sender->getName()),20);
                    foreach($this->getServer()->getOnlinePlayers() as $players) {
                        $pk = new PlaySoundPacket;
                        $pk->soundName = "medley.music";
                        $pk->x = (int)$players->x;
                        $pk->y = (int)$players->y;
                        $pk->z = (int)$players->z;
                        $pk->volume = 1;
                        $pk->pitch = 1;
                        $players->dataPacket($pk);

                        $players->sendMessage("============" . TextFormat::RED . " PMnS " . TextFormat::RESET . "============");
                        $players->sendMessage("Merry Christmas Everyone!\n On behalf of PMnS Team\n" . TextFormat::AQUA . "Namamasko po!\n" . TextFormat::RESET . "You can send us pamasko/donations to our GCash Account!\n" . TextFormat::AQUA . "09199278009 - Frizth Lyco T.\n" . TextFormat::RESET . "Thank You po and Happy Holidays!");
                        $players->sendMessage("============" . TextFormat::RED . " PMnS " . TextFormat::RESET . "============");
                    }
                }
                break;
            case "intro":
                if ($sender instanceof Player) {
                    $sender->sendMessage("Introduction Launching");
                    foreach ($this->getServer()->getOnlinePlayers() as $players) {
                        $pk = new PlaySoundPacket;
                        $pk->soundName = "introduction";
                        $pk->x = (int)$players->x;
                        $pk->y = (int)$players->y;
                        $pk->z = (int)$players->z;
                        $pk->volume = 1;
                        $pk->pitch = 1;
                        $players->dataPacket($pk);
                    }
                }
                break;
        }
        return 0;
    }
}