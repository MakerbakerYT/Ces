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

class SolitudeEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Solitude";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_ELITE;
    /** @var int */
    public $maxLevel = 3;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;
	/** @var int */
	public $time = 5;

    public function getDefaultExtraData(): array
    {
        return ["duration" => 5];
    }
	
    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$this->time--;
            if ($this->time = 5 * $this->extraData["duration"])
				$event->getEntity()->removeEffect(Effect::REGENERATION);
				$event->getEntity()->removeEffect(Effect::RESISTANCE);
				$event->getEntity()->removeEffect(Effect::ABSORPTION);
				$event->getEntity()->removeEffect(Effect::STRENGTH);
		}
		$player->sendMessage("§b*§d*§b* §bMultiplied The Silenced! §8(§7Solitude Strengthened Silenced§8) §b*§d*§b*");
		$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Silenced You Using Solitude! §8(§7Solitude Strengthened Silenced§8) §c*§6*§c*");
	}
}