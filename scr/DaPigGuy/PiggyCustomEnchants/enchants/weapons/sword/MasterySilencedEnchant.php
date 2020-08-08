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

class MasterySilencedEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Mastery Silenced";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_MASTERY;
    /** @var int */
    public $maxLevel = 4;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$event->getEntity()->removeEffect(Effect::REGENERATION);
			$event->getEntity()->removeEffect(Effect::RESISTANCE);
			$event->getEntity()->removeEffect(Effect::SATURATION);
			$event->getEntity()->removeEffect(Effect::ABSORPTION);
			$event->getEntity()->removeEffect(Effect::SPEED);
			$event->getEntity()->removeEffect(Effect::JUMP_BOOST);
			$event->getEntity()->removeEffect(Effect::NIGHT_VISION);
			$event->getEntity()->removeEffect(Effect::HEALTH_BOOST);
			$event->getEntity()->removeEffect(Effect::STRENGTH);
		}
		$player->sendMessage("§b*§d*§b* §4§lMastery Silenced The Enemy! §8(§7Mastery Silenced§8) §b*§d*§b*");
		$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Mastery Silenced You! §8(§7Mastery Silenced§8) §c*§6*§c*");
	}
}