<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor\helmet;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\entity\Effect;

class DestructionEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Destruction";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_LEGENDARY;
    /** @var int */
    public $maxLevel = 5;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_HELMET;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
			$entity = $event->getEntity();
			if ($entity instanceof Living) {
				$event->getEntity()->removeEffect(Effect::REGENERATION);
				$event->getEntity()->removeEffect(Effect::STRENGTH);
				$event->getEntity()->removeEffect(Effect::SPEED);
				$event->getEntity()->removeEffect(Effect::JUMP_BOOST);
				$event->getEntity()->removeEffect(Effect::RESISTANCE);
				$event->getEntity()->removeEffect(Effect::ABSORPTION);
		}
		$player->sendMessage("§b*§d*§b* §6Destructed The Enemy! §8(§7Debuff§8) §b*§d*§b*");
		$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Destructed You! §8(§7Debuff§8) §c*§6*§c*");
		}
	}
}