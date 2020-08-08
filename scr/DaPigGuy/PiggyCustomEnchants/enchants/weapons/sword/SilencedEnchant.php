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

class SilencedEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Silenced";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_SOUL;
    /** @var int */
    public $maxLevel = 4;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$event->getEntity()->removeEffect(Effect::REGENERATION);
		}
		$player->sendMessage("§b*§d*§b* §6Silenced The Enemy! §8(§7Canceling All Regeneration§8) §b*§d*§b*");
		$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Silenced You! §8(§7Regeneration Canceled§8) §c*§6*§c*");
	}
}