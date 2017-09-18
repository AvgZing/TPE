<?php
namespace Ad5001\BetterRaw;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\Task;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;
use pocketmine\IPlayer;
use Ad5001\BetterRaw\Main;
use pocketmine\plugin\PluginBase;
use pocketmine\math\Vector3;

   class FloatingTask extends PluginTask  {
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
    }
    public function onRun($tick){
						$id = 1;
						$levels = $this->plugin->getServer()->getLevels();
						foreach($levels as $level) {
						$cfg = new Config($this->plugin->getDataFolder() . "floating.yml", Config::YAML);
						while($id ===! $cfg->get("LastNumber") + 1) {
						 $x = $cfg->get("X" . $id);
						 $y = $cfg->get("Y" . $id);
						 $z = $cfg->get("Z" . $id);
						 $text = $cfg->get("Text" . $id);
						 $particle = new \pocketmine\level\particle\FloatingTextParticle(new Vector3($x, $y, $z), $text);
						 $level->addParticle($particle);
						 $id++;
						}
						}
	}
   }