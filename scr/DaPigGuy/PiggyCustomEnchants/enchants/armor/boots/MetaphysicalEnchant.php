<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor\boots;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\miscellaneous\RecursiveEnchant;
use pocketmine\entity\Effect;
use pocketmine\event\entity\EntityEffectAddEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class MetaphysicalEnchant extends RecursiveEnchant
{
    /** @var string */
    public $name = "Metaphysical";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_ULTIMATE;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_BOOTS;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_BOOTS;

    public function getReagent(): array
    {
        return [EntityEffectAddEvent::class];
    }

    public function safeReact(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
			$player->removeEffect(Effect::SLOWNESS);
			$player->removeEffect(Effect::MINING_FATIGUE);
			$player->removeEffect(Effect::BLINDNESS);
			$player->removeEffect(Effect::WEAKNESS);
			$player->removeEffect(Effect::POISON);
			$player->removeEffect(Effect::WITHER);
		}
		$player->sendMessage("§b*§d*§b* §6Recovered Status! §8(§7Canceling All Bad Effects§8) §b*§d*§b*");
	}
}
