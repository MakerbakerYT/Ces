<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons\sword;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class DemonicLifestealEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Demonic Lifesteal";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_HEROIC;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;

    public function getDefaultExtraData(): array
    {
        return ["base" => 2, "multiplier" => 3];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $player->setHealth($player->getHealth() + $this->extraData["base"] + $level * $this->extraData["multiplier"] > $player->getMaxHealth() ? $player->getMaxHealth() : $player->getHealth() + $this->extraData["base"] + $level * $this->extraData["multiplier"]);
			}
			$player->sendMessage("§b*§d*§b* §dExtracted The Enemy's HP! §8(§7Demonic Lifesteal§8) §b*§d*§b*");
			$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Has Extracted Tons of Your HP! §8(§7Demonic Lifesteal§8) §c*§6*§c*");
	}
}