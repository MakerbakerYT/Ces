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

class ObliterateEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Obliterate";
    /** @var int */
    public $maxLevel = 5;
    /** @var int */
    public $usageType = CustomEnchant::TYPE_HAND;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$entity = $event->getEntity();
			if($entity instanceof Living) {
				$stack = $stack > 4 ? 4 : $stack;
				$event->setKnockBack(0.4 * 0.5);
			}
			$player->sendMessage("§b*§d*§b* §7Obliterated The Enemy! §8(§7Extreme KnockBack§8) §b*§d*§b*");
		    $event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Obliterated You! §8(§7Extreme KnockBack§8) §c*§6*§c*");
		}
	}
}
           