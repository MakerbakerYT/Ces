<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons\sword;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\entity;

class SkillSwipeEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Skill Swipe";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_UNIQUE;
    /** @var int */
    public $maxLevel = 3;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
			if ($entity instanceof Living) {
				$entity->getLastDamageCause();
		      	if ($entity->getXpLevel() >= 5) {
					$entity->setXpLevel($entity->getXpLevel() - 5);
		     	    $damager = $event->getDamager();
		    		$damager->getLastDamageCause();
					if ($damager->getXpLevel() >=0) {
						$damager->setXpLevel($damager->getXpLevel() + 5);
					}
					$damager->sendMessage("§b*§d*§b* §aStolen The Enemy's XP! §8(§7XP Stole§8) §b*§d*§b*");
			     	$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Stolen XP From You! §8(§7XP Stole§8) §c*§6*§c*");
				} else {
					$player->sendMessage("§b*§d*§b* §aFailed to Steal the Enemy's XP! §8(§7XP INSUFFICIENT§8) §b*§d*§b*");
			     	$entity->sendMessage("§c*§6*§c* §cThe Enemy Tried to Steal XP From you but Failed! §8(§7XP INSUFFICIENT§8) §c*§6*§c*");
				}
			}
		}
	}
}