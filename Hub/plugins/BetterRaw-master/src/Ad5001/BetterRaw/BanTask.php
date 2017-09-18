<?php
namespace Ad5001\BetterRaw;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\Player;
use pocketmine\tile\Sign;
use pocketmine\utils\TextFormat as C;
use pocketmine\IPlayer;
use Ad5001\BetterRaw\Main;
use pocketmine\plugin\PluginBase;

   class BanTask extends PluginTask  {
    private $player;
	private $plugin;
    public function __construct($plugin, Player $player, $reason){
        parent::__construct($plugin);
		$this->plugin = $plugin;
		$this->player = $player;
		$this->message = $reason;
		$this->playername = $player->getName();
    }
    public function onRun($tick){
		$player = $this->plugin->getServer()->getPlayer($this->playername);
		if($this->isPlayerOnline($this->playername) === true) {
		$player->kick($this->message, false);
		}
    }
	public function isPlayerOnline($username){
   if($this->plugin->getServer()->getPlayer($username) instanceof Player){
      return true;
   }else{
      return false;
   }
}
   }