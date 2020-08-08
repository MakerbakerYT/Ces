<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\weapons;

use DaPigGuy\PiggyCustomEnchants\enchants\ReactiveEnchantment;
use DaPigGuy\PiggyCustomEnchants\PiggyCustomEnchants;
use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;
use ReflectionException;

class ConditionalDamageMultiplierEnchant extends ReactiveEnchantment
{
    /** @var callable */
    private $condition;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_AXE;

    /**
     * @throws ReflectionException
     */
    public function __construct(PiggyCustomEnchants $plugin, int $id, string $name, callable $condition, int $rarity = self::RARITY_LEGENDARY)
    {
        $this->name = $name;
        $this->rarity = $rarity;
        $this->condition = $condition;
        parent::__construct($plugin, $id);
    }

    public function getDefaultExtraData(): array
    {
        return ["additionalMultiplier" => 2];
    }

    public function react(Player $player, Item $item, Inventory $inventory, int $slot, Event $event, int $level, int $stack): void
    {
        if ($event instanceof EntityDamageByEntityEvent) {
			$entity = $event->getEntity();
				if (($this->condition)($event)) {
					$event->setModifier($this->extraData["additionalMultiplier"] * $level, $this->getId());
				}
                $player->sendMessage("§b*§d*§b* §cRogue Activated, DOUBLE DAMAGE! §8(§7Constant Damage§8) §b*§d*§b*");
		     	$event->getEntity()->sendMessage("§c*§6*§c* §cThe Enemy Is Doing Double Damage! §8(§7Constant Damage§8) §c*§6*§c*");
		}
	}
}
