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

class FeatherWeightEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Feather Weight";
    /** @var int */
    public $cooldownDuration = 400;
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
			if($player instanceof Living) {
                if (!$player->hasEffect(Effect::HASTE)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::HASTE), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $player->addEffect($effect);
			}
			$player->sendMessage("§b*§d*§b* §aBoosting Your Haste! §8(§7Haste Boost§8) §b*§d*§b*");
			$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy's Haste Has Activated! §8(§7Haste Boost§8) §c*§6*§c*");
			}
		}
	}
}