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

   class SignTask extends PluginTask  {
    private $player;
	private $plugin;
    public function __construct($plugin){
        parent::__construct($plugin);
		$this->plugin = $plugin;
    }
    public function onRun($tick){
		 foreach ($this->plugin->getServer()->getLevels() as $levels) {
                  foreach ($levels->getTiles() as $tile) {
                     if ($tile instanceof Sign) {
                         if ($tile->getText()[0] === "[BetterRaw]") {
							 $tile->setText("§e-=<>=-", $tile->getText()[1], $tile->getText()[2], $tile->getText()[3]);
						}
						 if ($tile->getText()[0] === "§e-=<>=-") {
							  // Default values
					          $colors = [C::DARK_BLUE, C::DARK_GREEN, C::DARK_AQUA, C::DARK_RED, C::GOLD, C::GRAY, C::BLUE, C::GREEN, C::AQUA, C::RED, C::LIGHT_PURPLE, C::WHITE];
					          $mc = "§mc";
					          // Line 2
							  $randcolors = rand(0, 11);
					          $line1 = $tile->getText()[1];
							  $color = [C::STRIKETHROUGH, $colors[$randcolors]];
					          $line1 = str_replace($mc, implode("", $color), $line1);
							  while ($id <= 11) {
								  $color = [C::STRIKETHROUGH, $colors[$id]];
								  $line1 = str_replace($color, implode("", $color), $line1);
								  $id++;
							  }
					          // Line 3
					          $randcolors = rand(0, 11);
					          $line2 = $tile->getText()[2];
							  $color = [C::STRIKETHROUGH, $colors[$randcolors]];
					          $line2 = str_replace($mc, implode("", $color), $line2);
							  $id = 0;
							  while ($id <= 12) {
								  $color = [C::STRIKETHROUGH, $colors[$id]];
								  $line2 = str_replace($color, implode("", $color), $line2);
								  $id++;
							  }
					          // Line 4
					          $randcolors = rand(0, 11);
					          $line3 = $tile->getText()[3];
							  $color = [C::STRIKETHROUGH, $colors[$randcolors]];
					          $line3 = str_replace($mc, implode("", $color), $line3);
							  while ($id <= 11) {
								  $color = [$colors[$id], "§m"];
								  $line3 = str_replace($color, implode("", $color), $line3);
								  $id++;
							  }
                              $tile->setText($tile->getText()[0], $line1, $line2, $line3);
						 }
					 }
				  }
			  }
	}
   }