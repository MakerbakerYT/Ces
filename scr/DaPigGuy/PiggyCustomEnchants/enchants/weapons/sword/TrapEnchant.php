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

class TrapEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Trap";
    /** @var int */
    public $cooldownDuration = 46;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["speedDurationMultiplier" => 200, "speedBaseAmplifier" => 3, "speedAmplifierMultiplier" => 0.2, "strengthDurationMultiplier" => 200, "strengthBaseAmplifier" => 3, "strengthAmplifierMultiplier" => 0.2];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
			$entity = $event->getEntity();
			if($entity instanceof Living) {
                if (!$entity->hasEffect(Effect::SLOWNESS)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::SLOWNESS), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $entity->addEffect($effect);
				}
				$player->sendMessage("§b*§d*§b* §bTrapped The Enemy! §8(§7Slowness Buff§8) §b*§d*§b*");
		    	$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Trapped You! §8(§7Slowness Buff§8) §c*§6*§c*");
			}
		}
	}
}	