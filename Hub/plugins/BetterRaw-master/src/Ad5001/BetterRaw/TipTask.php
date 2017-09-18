<?php


namespace Ad5001\BetterRaw;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\plugin\PluginBase;

class TipTask extends PluginTask  {
    private $player;
    private $plugin;
    public function __construct($plugin, Player $player, $message){
        parent::__construct($plugin);
        $this->plugin = $plugin;
		$this->times = 0;
		$this->lastcolor = "§mc";
		$this->player = $player;
		$this->message = $message;
    }
     public function onRun($tick){
		 if($this->times  > 25) {
			 $this->plugin->getServer()->getScheduler()->cancelTask($this->getTaskId());
		 }
     	$colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
		$randcolors = rand(0, 15);
	   $color = [C::STRIKETHROUGH, $colors[$randcolors]];
	   $this->message = str_replace($this->lastcolor, implode("", $color), $this->message);
	   $this->player->sendTip($this->message);
	   $this->lastcolor = implode("", $color);
	   $this->times++;
     }
}
