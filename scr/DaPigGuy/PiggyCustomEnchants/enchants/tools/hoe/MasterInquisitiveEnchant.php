<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\tools\hoe;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\entity;

class MasterInquisitiveEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Master Inquisitive";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_HEROIC;
    /** @var int */
    public $maxLevel = 4;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_HOE;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $entity = $event->getEntity();
			$damager = $event->getDamager();
			$damager->getLastDamageCause();
			if ($damager->getXpLevel() >=0) {
				$damager->setXpLevel($damager->getXpLevel() + 50);
			}
			$damager->sendMessage("§b*§d*§b* §dMaster Inquisitive Active! §8(§7+50 XP§8) §b*§d*§b*");
		}
	}
}
