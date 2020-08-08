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

class DominateEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Dominate";
    /** @var int */
    public $cooldownDuration = 66;
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
            if (!$entity->hasEffect(Effect::WEAKNESS)) {
				$effect = new EffectInstance(Effect::getEffect(Effect::WEAKNESS), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                $entity->addEffect($effect);
				}
				$player->sendMessage("§b*§d*§b* §eYou are now more Dominate than Your Enemy! §8(§7Constant Strength§8) §b*§d*§b*");
				$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Made You Weak! §8(§7Constant Strength§8) §c*§6*§c*");
		}
	}
}