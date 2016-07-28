<?php
namespace Muqsit;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\{EntityDamageEvent, EntityDamageByEntityEvent};
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener{

  public function onEnable(){
    @mkdir($this->getDataFolder());
    $this->saveDefaultConfig();
    $this->reloadConfig();
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }
  
  public function rewardPlayer(EntityDamageEvent $e){
    $p = $e->getEntity();
    $cfg = $this->getConfig();
    $rand = $cfg->get("chance");
    $exp = $cfg->get("reward-xp");
    $rewardMessage = $cfg->get("reward-message");
    if($p instanceof Player && $e instanceof EntityDamageByEntityEvent){
      $d = $e->getDamager();
      if($d->hasPermission("assault.xp")){
        switch(mt_rand(1, $rand)){
          case 1:
            $d->addExperience($exp);
            $d->sendMessage($rewardMessage);
          break;
        }
      }
    }
  }
}
      
  
