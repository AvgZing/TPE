<?php
namespace BoxOfDevs\ColorfullBlock;

use pocketmine\server;
use pocketmine\scheduler\PluginTask;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\utils\TextFormat as C;
use pocketmine\IPlayer;
use pocketmine\math\Vector3;

   class ChangeColorTask extends PluginTask  {
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
	}
	public function onRun($tick) {
		$cfg = new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);
        if($cfg->get("ColorChange") === "same") {
            $rand = rand(0, 15);
        }
		foreach($cfg->get("Blocks") as $sblock) {
            if($cfg->get("ColorChange") === "not") {
                $rand = rand(0, 15);
            } elseif($cfg->get("ColorChange") ===! "same") {
                $rand = rand(0, 15);
                $this->plugin->getLogger()->warning("Invalid ColorChange in config : {$cfg->get("ColorChange")}");
            }
            list($x, $y, $z, $levelname) = explode("/", $sblock);
            $level = $this->plugin->getServer()->getLevelByName($levelname);
            $level->setBlock(new Vector3($x, $y, $z), new Block(35, $rand));
        }
	}
   }
