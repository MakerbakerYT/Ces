<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons\sword;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchantIds;
use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class ExecuteEnchant extends ReactiveEnchantment
{
    /** @var string */
    public $name = "Execute";
    /** @var int */
    public $maxLevel = 3;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_SWORD;
    /** @var int */
    public $rarity = CustomEnchant::RARITY_ELITE;
	
    public function getDefaultExtraData(): array
    {
        return ["base" => 2, "multiplier" => 5];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$entity = $event->getEntity();
			if($entity instanceof Living) {
				if($entity->getHealth() <= 6)
					$event->setModifier($this->extraData["base"] + $level * $this->extraData["multiplier"], CustomEnchantIds::EXECUTE);
				}
				$player->sendMessage("§b*§d*§b* §bThe Enemy Is Now Being Executed! §8(§7Buff Damage§8) §b*§d*§b*");
		     	$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Is Executing You! §8(§7Buff Damage§8) §c*§6*§c*");
		}
	}
}