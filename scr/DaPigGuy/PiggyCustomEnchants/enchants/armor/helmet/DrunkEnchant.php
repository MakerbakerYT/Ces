<?php

declare(strict_types=1);

namespace DaPigGuy\PiggyCustomEnchants\enchants\armor\helmet;

use DaPigGuy\PiggyCustomEnchants\enchants\CustomEnchant;
use DaPigGuy\PiggyCustomEnchants\enchants\ToggleableEnchantment;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\inventory\Inventory;
use pocketmine\item\Item;
use pocketmine\Player;

class DrunkEnchant extends ToggleableEnchantment
{
    /** @var string */
    public $name = "Drunk";
    /** @var int */
    public $maxLevel = 4;

    /** @var int */
    public $usageType = CustomEnchant::TYPE_HELMET;
    /** @var int */
    public $itemType = CustomEnchant::ITEM_TYPE_HELMET;

    /** @var EffectInstance[] */
    private $previousEffect;

    public function toggle(Player $player, Item $item, Inventory $inventory, int $slot, int $level, bool $toggle): void
    {
        if ($toggle) {
            if ($player->hasEffect(Effect::MINING_FATIGUE) && $player->getEffect(Effect::MINING_FATIGUE)->getAmplifier() > $this->stack[$player->getName()] - 1) $this->previousEffect[$player->getName()] = $player->getEffect(Effect::MINING_FATIGUE);
        } else {
            if ($this->equippedArmorStack[$player->getName()] === 0) {
                $player->removeEffect(Effect::MINING_FATIGUE);
                if (isset($this->previousEffect[$player->getName()])) {
                    $player->addEffect($this->previousEffect[$player->getName()]);
                    unset($this->previousEffect[$player->getName()]);
                }
                return;
            }
        }
        $player->removeEffect(Effect::MINING_FATIGUE);
        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::MINING_FATIGUE), 2147483647, $this->stack[$player->getName()] - 1, false));
        $player->removeEffect(Effect::STRENGTH);
        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::STRENGTH), 2147483647, $this->stack[$player->getName()] - 1, false));
        $player->removeEffect(Effect::SLOWNESS);
        $player->addEffect(new EffectInstance(Effect::getEffect(Effect::SLOWNESS), 2147483647, $this->stack[$player->getName()] - 1, false));
    }

    public function canEffectsStack(): bool
    {
        return true;
    }
}