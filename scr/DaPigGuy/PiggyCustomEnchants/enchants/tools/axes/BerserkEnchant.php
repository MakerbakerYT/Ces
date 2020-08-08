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

class BerserkEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Berserk";
    /** @var int */
    public $cooldownDuration = 120;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

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
        if ($event instanceof EntityDamageByEntityEvent) {
			$entity = $event->getEntity();
			if($entity instanceof Living) {
                if (!$player->hasEffect(Effect::STRENGTH)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::STRENGTH), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $player->addEffect($effect);
                }
                if (!$player->hasEffect(Effect::MINING_FATIGUE)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::MINING_FATIGUE), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                    $player->addEffect($effect);
				}
				$player->sendMessage("§b*§d*§b* §aBerserked The Enemy! §8(§7Buff Effects§8) §b*§d*§b*");
		     	$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Berserked You! §8(§7Buff Effects§8) §c*§6*§c*");
			}
		}
	}
}