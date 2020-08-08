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

class DivineImmolationEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Divine Immolation";
    /** @var int */
    public $cooldownDuration = 500;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_HAND;
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
                if (!$player->hasEffect(Effect::SPEED)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::SPEED), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $player->addEffect($effect);
                }
                if (!$player->hasEffect(Effect::ABSORPTION)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::ABSORPTION), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                    $player->addEffect($effect);
                }
                if (!$player->hasEffect(Effect::HEALTH_BOOST)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::HEALTH_BOOST), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                    $player->addEffect($effect);
                }
                if (!$player->hasEffect(Effect::STRENGTH)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::STRENGTH), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                    $player->addEffect($effect);
                }
                if (!$player->hasEffect(Effect::RESISTANCE)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::RESISTANCE), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                    $player->addEffect($effect);
                }
                if (!$player->hasEffect(Effect::REGENERATION)) {
                    $effect = new EffectInstance(Effect::getEffect(Effect::REGENERATION), $this->extraData["strengthDurationMultiplier"] * $level, $level * $this->extraData["strengthAmplifierMultiplier"] + $this->extraData["strengthBaseAmplifier"], false);
                    $player->addEffect($effect);
				}
                $player->sendMessage("§b*§d*§b* §cDIVINE IMMOLATION ACTIVATED! §8(§7EXOTIC POWERS§8) §b*§d*§b*");
		    	$event->getEntity()->sendMessage("§c*§6*§c* §cENEMIES DIVINE IMMOLATION HAS ACTIVATED! §8(§7EXOTIC POWERS§8) §c*§6*§c*");
		}
	}
}