<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor\boots;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class RocketEscapeEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Rocket Escape";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_ELITE;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_BOOTS;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_BOOTS;

    public function getDefaultExtraData(): array
    {
        return ["durationMultiplier" => 5, "baseAmplifier" => 5, "amplifierMultiplier" => 50];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageEvent) {
			if ($player->getHealth() - $event->getFinalDamage() <= 6) {
				$player = $event->getPlayer();
				$player->addEffect(new EffectInstance(Effect::getEffect(Effect::LEVITATION), $this->extraData["durationMultiplier"] * $level, $level * $this->extraData["amplifierMultiplier"] + $this->extraData["baseAmplifier"], false));
			}
			$player->sendMessage("§b*§d*§b* §bBlasted Off! §8(§7Saviour Blast§8) §b*§d*§b*");
		}
	}
}
