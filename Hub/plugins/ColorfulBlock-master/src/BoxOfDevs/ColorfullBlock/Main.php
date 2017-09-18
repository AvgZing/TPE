<?php
namespace BoxOfDevs\ColorfullBlock; 
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use BoxOfDevs\ColorfullBlock\ChangeColorTask; 
use BoxOfDevs\ColorfullBlock\ReloadConfigTask; 
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\Config;
use pocetmine\Player;
use pocketmine\block\Block;
use pocketmine\math\Vector3;


class Main extends PluginBase implements Listener{
    public function onBlockBreak(BlockBreakEvent $event) {
        $cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		foreach($cfg->get("Blocks") as $sblock) {
            list($x, $y, $z, $levelname) = explode("/", $sblock);
            $level = $this->getServer()->getLevelByName($levelname);
            $b = $event->getBlock();
            switch($cfg->get("BreakMode")) {
                case "normal":
                break;
                case "nodrop":
                if($b->x == $x and $b->y == $y and $b->z == $z and $levelname == $event->getPlayer()->getLevel()->getName()) {
                    $event->setCancelled(true);
                }
                break;
                case "delete":
                if($b->x == $x and $b->y == $y and $b->z == $z and $levelname == $event->getPlayer()->getLevel()->getName() and $event->getPlayer()->hasPermission("cfb.delete")) {
                    $cfg->remove("$x/$y/$z/$levelname");
                    $cfg->save();
                    $event->setCancelled(true);
                }
                break;
                default:
                $this->getLogger()->warning("Invalid BreakMode provided in the config: {$cfg->get("BreakMode")}. Switched to normal mode.");
                break;
            }
        }
    }
public function onEnable(){
	$this->saveDefaultConfig();
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new ChangeColorTask($this), $this->getConfig()->get("Speed") * 20);
	$this->getServer()->getScheduler()->scheduleRepeatingTask(new ReloadConfigTask($this), 50);
	$this->getServer()->getPluginManager()->registerEvents($this, $this);
 }
 public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
switch($cmd->getName()){
	case "colorfullblock":
	if(isset($args[0]) and is_numeric($args[0]) and isset($args[1]) and is_numeric($args[1]) and isset($args[2]) and is_numeric($args[2])) {
		$x = $args[0];
		$y = $args[1];
		$z = $args[2];
		$level = $sender->getLevel();
	} elseif(isset($args[0])) {
		$player = $this->getServer()->getPlayer($args[0]);
		if($player instanceof Player) {
			$x = round($player->x, 0);
			$y = round($player->y, 0);
			$z = round($player->z, 0);
			$level = $player->getLevel();
		} else {
			return false;
		}
	} else {
			$x = round($sender->x, 0);
			$y = round($sender->y, 0);
			$z = round($sender->z, 0);
			$level = $sender->getLevel();
	}
	$cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    $blocks = $cfg->get("Blocks");
    $this->getLogger()->debug("$x/$y/$z/{$level->getName()}");
    array_push($blocks, "$x/$y/$z/{$level->getName()}");
    $cfg->set("Blocks",  $blocks);
	$cfg->save();
	$sender->sendMessage("[CFB] Block has been place in $x, $y, $z.");
	return true;
}
return false;
 }
}