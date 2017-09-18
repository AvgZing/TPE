<?php

namespace AlwaysSpawn;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\ConsoleCommandExecutor;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\entity\Entity;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;

class Main extends PluginBase implements Listener, CommandExecutor{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
	$this->saveDefaultConfig();
	$this->getResource("config.yml");
        $this->getLogger()->info("AlwaysSpawn Loaded!");
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        switch($cmd->getName()){
            case "alwaysspawn":
                if($args[0] == "set"){
		    if(!$sender Instanceof Player){
			$sender->sendMessage("[AlwaysSpawn] You can only use AlwaysSpawn while in-game!");
			return true;
		    }else{
			$X = $sender->getFloorX();
			$Y = $sender->getFloorY();
			$Z = $sender->getFloorZ();
			$Level = $sender->getLevel()->getName();
			$this->getConfig()->set("X", $X);
			$this->getConfig()->set("Y", $y);
			$this->getConfig()->set("Z", $Z);
			$this->getConfig()->set("Level", $Level);
			$this->getConfig()->set("enableConf", true);
			$this->getConfig()->save();
			$sender->sendMessage("[AlwaysSpawn] Set login spawn location to you current position!");
			return true;
		    }
                }elseif($args[0] == "location"){
		    if(!$sender Instanceof Player){
			$sender->sendMessage("[AlwaysSpawn] You can only use AlwaysSpawn while in-game!");
			return true;
		    }else{
			$X = $sender->getFloorX();
			$Y = $sender->getFloorY();
			$Z = $sender->getFloorZ();
			$Level = $sender->getLevel()->getName();
			$sender->sendMessage("[AlwaysSpawn] Your location is:\nX: " . $X . "\nY: " . $Y . "\nZ: " . $Z . "\nLevel: " . $Level);
			return true;
		    }
                }else{
                    $sender->sendMessage("Usage: /alwaysspawn <set|location>");
		    return true;
                }
            break;
	}
     }
    
    /**
     * @param PlayerJoinEvent $event
     *
     * @priority       NORMAL
     * @ignoreCanceled false
     */
    public function onSpawn(PlayerJoinEvent $event){
	$enableConf = $this->getConfig()->get("enableConf");
        $X = $this->getConfig()->get("X");
        $Y = $this->getConfig()->get("Y");
        $Z = $this->getConfig()->get("Z");
        $Level = $this->getConfig()->get("Level");
	$player = $event->getPlayer();
	if($enableConf === false){
	    $player->teleport($this->getServer()->getDefaultLevel()->getSpawn());
	}else{
	    $player->teleport(new Vector3($X, $Y+4, $Z, $Level));
	}
    }
    
    public function onDisable(){
    	$this->getConfig()->save();
        $this->getLogger()->info("AlwaysSpawn Unloaded!");
    }
}
?>
