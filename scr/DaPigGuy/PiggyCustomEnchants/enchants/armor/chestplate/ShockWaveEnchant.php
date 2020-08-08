<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor\chestplate;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class ShockWaveEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Shock Wave";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_ELITE;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_CHESTPLATE;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_CHESTPLATE;

    public function getDefaultExtraData(): array
    {
        return ["durationMultiplier" => 5, "baseAmplifier" => 5, "amplifierMultiplier" => 25];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$entity = $event->getEntity();
            $entity->addEffect(new EffectInstance(Effect::getEffect(Effect::LEVITATION), $this->extraData["durationMultiplier"] * $level, $level * $this->extraData["amplifierMultiplier"] + $this->extraData["baseAmplifier"], false));
			}
			$player->sendMessage("§b*§d*§b* §bPushed The Enemy! §8(§7ShockWave Blast§8) §b*§d*§b*");
			$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Pushed You! §8(§7ShockWave Blast§8) §c*§6*§c*");
	}
}
