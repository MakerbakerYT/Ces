<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor\chestplate;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ToggleableEnchantment;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class GodlyOverloadEnchant extends ToggleableEnchantment
{
    /** @var string */
    public $name = "Godly Overload";
    /** @var int */
    public $rarity = CustomEnchant::RARITY_HEROIC;
    /** @var int */
    public $maxLevel = 3;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_CHESTPLATE;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_CHESTPLATE;

    public function getDefaultExtraData(): array
    {
        return ["multiplier" => 3.5];
    }

    public function toggle(Player $player, Item $item, Inventory $inventory, int $slot, int $level, bool $toggle): void
    {
        $player->setMaxHealth($player->getMaxHealth() + $this->extraData["multiplier"] * $level * ($toggle ? 1 : -1));
        $player->setHealth($player->getHealth() * ($player->getMaxHealth() / ($player->getMaxHealth() - $this->extraData["multiplier"] * $level * ($toggle ? 1 : -1))));
    }
}