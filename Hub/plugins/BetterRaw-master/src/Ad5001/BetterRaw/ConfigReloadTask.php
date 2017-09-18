<?php
namespace Ad5001\BetterRaw;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\tile\Sign;
use pocketmine\utils\TextFormat as C;
use pocketmine\utils\Config;
use Ad5001\BetterRaw\Main;
use pocketmine\plugin\PluginBase;

   class ConfigReloadTask extends PluginTask  {
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
    }
    public function onRun($tick){
		$this->plugin->reloadConfig();
	}
}
?>