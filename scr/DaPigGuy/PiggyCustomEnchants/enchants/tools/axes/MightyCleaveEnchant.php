<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\tools\axes;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class MightyCleaveEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Mighty Cleave";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_HEROIC;
    /** @var int */
    public $maxLevel = 5;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    public function getDefaultExtraData(): array
    {
        return ["base" => 2, "multiplier" => 0.8];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
            $event->setModifier($this->extraData["base"] + $level * $this->extraData["multiplier"], CustomEnchantIds::MIGHTYCLEAVE);
		}
		$player->sendMessage("§b*§d*§b* §dMighty Cleaved The Enemy! §8(§7Mighty Strength§8) §b*§d*§b*");
		$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Is Dealing More Strength than You! §8(§7Mighty Strength§8) §c*§6*§c*");
	}
}