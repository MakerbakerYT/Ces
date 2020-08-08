<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\tools\axes;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class ExtremeInsanityEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Extreme Insanity";
    /** @var int */
    public $cooldownDuration = 40;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["speedDurationMultiplier" => 200, "speedBaseAmplifier" => 6, "speedAmplifierMultiplier" => 2, "strengthDurationMultiplier" => 200, "strengthBaseAmplifier" => 3, "strengthAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
                if (!$player->hasEffect(Effect::STRENGTH)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::STRENGTH), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $player->addEffect($effect);
				}
				$player->sendMessage("§b*§d*§b* §dExtreme Insanity Powers Awoken! §8(§7Extreme Buff§8) §b*§d*§b*");
		}
	}
}