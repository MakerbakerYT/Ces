<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons\sword;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class VenomEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Venom";
    /** @var int */
    public $cooldownDuration = 45;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["speedDurationMultiplier" => 200, "speedBaseAmplifier" => 3, "speedAmplifierMultiplier" => 1, "strengthDurationMultiplier" => 200, "strengthBaseAmplifier" => 3, "strengthAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
			$entity = $event->getEntity();
			if($entity instanceof Living) {
                if (!$entity->hasEffect(Effect::POISON)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::POISON), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $entity->addEffect($effect);
			}
			$player->sendMessage("§b*§d*§b* §aInflicted Venom To Your Enemy! §8(§7Infected Effects§8) §b*§d*§b*");
			$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Infected You! §8(§7Infected Effects§8) §c*§6*§c*");
			}
		}
	}
}
