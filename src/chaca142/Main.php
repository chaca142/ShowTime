<?php

namespace chaca142;

use pocketmine\scheduler\Task;
use pocketmine\level\Level;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Server;

class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("§aShowTimeを起動しました");

        date_default_timezone_set('Asia/Tokyo');
        $this->getScheduler()->scheduleRepeatingTask(new Time($this), 5);
    }
}

class Time extends Task{

    public function onRun(int $tick){
        foreach(Server::getInstance()->getOnlinePlayers() as $player){
            $time = date("G時i分s秒");
            $level = $player->getLevel();
            $wt = $level->getTime();

            $player->sendPopup("                                                                                          §bリアル現在時刻 : {$time}\n                                                                                            §eワールド現在時刻 : {$wt}");
        }
    }
}