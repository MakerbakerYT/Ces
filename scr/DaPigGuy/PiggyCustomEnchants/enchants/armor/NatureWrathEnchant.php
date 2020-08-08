<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class NatureWrathEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Natures Wrath";
    /** @var int */
    public $cooldownDuration = 500;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_ARMOR;

    public function getReagent(): array
    {
        return [EntityDamageEvent::class];
    }

    public function getDefaultExtraData(): array
    {
        return ["speedDurationMultiplier" => 200, "speedBaseAmplifier" => 9, "speedAmplifierMultiplier" => 7, "strengthDurationMultiplier" => 200, "strengthBaseAmplifier" => 3, "strengthAmplifierMultiplier" => 1];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
			$entity = $event->getEntity();
			$damager = $entity->getLastDamageCause()->getDamager();
			if ($damager->getXpLevel() >= 50) {
				$damager->setXpLevel($damager->getXpLevel() - 50);
				if (!$player->hasEffect(Effect::STRENGTH)) {
					$effect = new EffectInstance(Effect::getEffect(Effect::STRENGTH), $this->extraData["speedDurationMultiplier"] * $level, $level * $this->extraData["speedAmplifierMultiplier"] + $this->extraData["speedBaseAmplifier"], false);
                    $player->addEffect($effect);
				}
                $player->sendMessage("§b*§d*§b* §cNATURES WRATH ACTIVATED! §8(§7EXOTIC STRENGTH§8) §b*§d*§b*");
		    	$event->getEntity()->sendMessage("§c*§6*§c* §cENEMIES WRATH HAS ACTIVATED! §8(§7EXOTIC STRENGTH§8) §c*§6*§c*");
			} else {
				$damager->sendMessage("§c*§6*§c* §cYOU NEED 50XP LEVELS TO ACTIVATE THIS ENCHANT! (NATURES WRATH)§c*§6*§c*");
			}
		}
	}
}