<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons\sword;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class ThunderingBlowEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Thundering Blow";
    /** @var int */
    public $maxLevel = 3;
    /** @var int */
    public $usageType = CustomEnchant::TYPE_HAND;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;
    /** @var int */
    public $rarity = CustomEnchant::RARITY_SIMPLE;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$entity = $event->getEntity();
			if ($entity instanceof Player) {
				$lightning = Entity::createEntity("PiggyLightning", $event->getEntity()->getLevel(), Entity::createBaseNBT($event->getEntity()));
				$lightning->setOwningEntity($player);
                $lightning->spawnToAll();
                }
                $player->sendMessage("§b*§d*§b* §7Stormed The Enemy! §8(§7Thunder Strikes§8) §b*§d*§b*");
				$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Stormed You! §8(§7Thunder Strikes§8) §c*§6*§c*");
		}
	}
}