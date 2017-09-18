<?php
namespace Ad5001\BetterRaw;

/*
                         _______________________________________________________________
                        /                 BetterRaw Plugin by Ad5001 !                  \
                        /               This plugin is work in progress!                \
                        /  Feel free to make issues or/and help me correcting bugs :)   \
                        -----------------------------------------------------------------
*/

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\katana\Console;
use pocketmine\IPlayer;
use Ad5001\BetterRaw\SignTask;
use Ad5001\BetterRaw\BanTask;
use Ad5001\BetterRaw\ConfigReloadTask;
use Ad5001\BetterRaw\FloatingTask;
use Ad5001\BetterRaw\TipTask;
use Ad5001\BetterRaw\PopupTask;
use pocketmine\utils\TextFormat as C;
use pocketmine\scheduler\PluginTask;
use pocketmine\scheduler\ServerScheduler;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\server;
use pocketmine\plugin\PluginBase;
   class  API {
   public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }
                         public function tellWorldRaw(Level $world, $message) {
                               foreach($world->getPlayers() as $worldplayers){
								   $message = str_replace("&", "§", $message);
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $randcolors = rand(0, 15);
								 $color = [C::BLACK, C::BOLD, C::STRIKETHROUGH, C::BLUE, C::RESET, $colors[$randcolors]];
								 $message = str_replace($lastcolor, implode("", $color), $message);
                                 $worldplayers->sendMessage($message);
                               }
                               }
                         public function tip(Player $player, $message) {
                           // tip command
						   $message = str_replace("&", "§", $message);
                                 $player->sendTip($message);
								 $ntip = 0;
								 $time = 0;
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $this->getServer()->getScheduler()->scheduleRepeatingTask(new TipTask($this, $player, implode(" ", $args)), 10);
                              }
                         public function popup(Player $player, $message) {
                           // popup command
						   $message = str_replace("&", "§", $message);
                                 $player->sendPopup($message);
								 $ntip = 0;
								 $time = 0;
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupTask($this, $player, implode(" ", $args)), 10);
                              }
                          public function popupWorld(Level $world, $message) {
                           // popupworld command
                               foreach($world->getPlayers() as $worldplayers){
								   $message = str_replace("&", "§", $message);
                                 $worldplayers->sendPopup($message);
								 $ntip = 0;
								 $time = 0;
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupTask($this, $worldplayers, implode(" ", $args)), 10);
                               }
                               }
                          public function tipWorld(Level $world, $message) {
                           // tipworld command
						   $message = str_replace("&", "§", $message);
                               foreach($world->getPlayers() as $worldplayers){
                                 $worldplayers->sendTip($message);
								 $ntip = 0;
								 $time = 0;
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $this->getServer()->getScheduler()->scheduleRepeatingTask(new TipTask($this, $worldplayers, implode(" ", $args)), 10);
                               }
                               }
						   public function sayTip($message) {
		 	                           // saytip command
									   $message = str_replace("&", "§", $message);
		 	                                 $this->plugin->getServer()->broadcastTip($message);
											 $ntip = 0;
								             $time = 0;
								             $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								             $lastcolor = "§mc";
											 foreach ($this->getServer()->getOnlinePlayers() as $player) {
								             $this->getServer()->getScheduler()->scheduleRepeatingTask(new TipTask($this, $player, implode(" ", $args)), 10);
											 }
						   }
		 			      public function sayPopup($message) {
		 	                           // saypopup command
									   $message = str_replace("&", "§", $message);
											 $ntip = 0;
								             $time = 0;
								             $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								             $lastcolor = "§mc";
		 	                                 $this->plugin->getServer()->broadcastPopup($message);
											 foreach ($this->getServer()->getOnlinePlayers() as $player) {
								             $this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupTask($this, $player, implode(" ", $args)), 10);
											 }
						  }
						   public function cKickWorld(Level $world, $message) {
                           // ckickworld command
						   $message = str_replace("&", "§", $message);
                               foreach($world->getPlayers() as $worldplayers){
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $randcolors = rand(0, 15);
								 $color = [C::BLACK, C::BOLD, C::STRIKETHROUGH, C::BLUE, C::RESET, $colors[$randcolors]];
								 $message = str_replace($lastcolor, implode("", $color), $message);
								 
                                 $worldplayers->kick($message, false);
                               }
                               }
						public function cKickAll($message) {
                           // ckickall command
						   $message = str_replace("&", "§", $message);
                               foreach($this->plugin->getServer()->getOnlinePlayers() as $players){
								 $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								 $lastcolor = "§mc";
								 $randcolors = rand(0, 15);
								 $color = [C::BLACK, C::BOLD, C::STRIKETHROUGH, C::BLUE, C::RESET, $colors[$randcolors]];
								 $message = str_replace($lastcolor, implode("", $color), $message);
								 
                                 $players->kick($message, false);
							   }
						}
						 public function tellRadiusRaw(Player $player, $radius, $message) {
                                 if(!is_numeric($radius)){
                                  return false;
                                 } else {
									 $message = str_replace("&", "§", $message);
								   $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								   $lastcolor = "§mc";
								   $randcolors = rand(0, 15);
								   $color = [C::BLACK, C::BOLD, C::STRIKETHROUGH, C::BLUE, C::RESET, $colors[$randcolors]];
								   $message = str_replace($lastcolor, implode("", $color), $message);
								   foreach($player->getLevel()->getPlayers() as $players){
                                      if($player->distance($players) <= $radius){
										  $players->sendMessage($message);
										  return true;
                                      }
                                   }
								 }
							   }
						    public function popupRadius(Player $player, $radius, $message) {
                                 if(!is_numeric($radius)){
                                  return false;
                                 } else {
									 $message = str_replace("&", "§", $message);
								   $ntip = 0;
								   $time = 0;
								   $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								   $lastcolor = "§mc";
								   foreach($player->getLevel()->getPlayers() as $players){
                                      if($player->distance($players) <= $radius){
								             $this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupTask($this, $players, implode(" ", $args)), 10);
                                      }
                                   }
								 }
							}
							public function tipRadius(Player $player, $radius, $message) {
                                 if(!is_numeric($radius)){
                                   return false;
                                 } else {
									 $message = str_replace("&", "§", $message);
								   $ntip = 0;
								   $time = 0;
								   $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								   $lastcolor = "§mc";
								   foreach($player->getLevel()->getPlayers() as $players){
                                      if($player->distance($players) <= $radius){
										 $this->getServer()->getScheduler()->scheduleRepeatingTask(new TipTask($this, $players, implode(" ", $args)), 10);
                                      }
                                   }
								 }
							   }
							public function cKickRadius(Player $player, $radius, $message) {
                                 if(!is_numeric($radius)){
                                   return false;
                                 } else {
									 $message = str_replace("&", "§", $message);
								   $colors = [C::BLACK, C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::DARK_PURPLE, C::GOLD, C::GRAY, C::DARK_GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::YELLOW, C::WHITE];
								   $lastcolor = "§mc";
								   $randcolors = rand(0, 15);
								   $color = [C::BLACK, C::BOLD, C::STRIKETHROUGH, C::BLUE, C::RESET, $colors[$randcolors]];
								   $message = str_replace($lastcolor, implode("", $color), $message);
								   foreach($player->getLevel()->getPlayers() as $players){
                                      if($player->distance($players) <= $radius){
										  $players->kick($message, false);
                                      }
                                   }
								 }
							   }
   }