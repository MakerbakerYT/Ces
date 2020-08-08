<?php


namespace DaPigGuy\PiggyCustomEnchants\commands\subcommands;


use DaPigGuy\PiggyCustomEnchants\libs\CortexPE\Commando\BaseSubCommand;
use DaPigGuy\PiggyCustomEnchants\PiggyCustomEnchants;
use DaPigGuy\PiggyCustomEnchants\libs\jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class AboutSubCommand extends BaseSubCommand
{
    /** @var PiggyCustomEnchants */
    private $plugin;

    public function __construct(PiggyCustomEnchants $plugin, string $name, string $description = "", array $aliases = [])
    {
        $this->plugin = $plugin;
        parent::__construct($name, $description, $aliases);
    }

    public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
    {
        $message = TextFormat::GREEN . "PiggyCustomEnchants version " . TextFormat::GOLD . $this->plugin->getDescription()->getVersion() . TextFormat::EOL .
            TextFormat::GREEN . "PiggyCustomEnchants is a versatile custom enchantments plugin developed by DaPigGuy (MCPEPIG) and Aericio." . TextFormat::EOL .
            "More information about our plugin can be found at " . TextFormat::GOLD . "https://piggydocs.aericio.net/" . TextFormat::GREEN . "." . TextFormat::EOL .
            TextFormat::GRAY . "Copyright 2017-2020 DaPigGuy; Licensed under the Apache License.";
        if ($sender instanceof Player && $this->plugin->areFormsEnabled()) {
            $form = new SimpleForm(function (Player $player, ?int $data): void {
                if ($data !== null) {
                    $this->plugin->getServer()->dispatchCommand($player, "ce");
                }
            });
            $form->setTitle(TextFormat::GREEN . "About PiggyCustomEnchants");
            $form->setContent($message);
            $form->addButton("Back");
            $sender->sendForm($form);
            return;
        }
        $sender->sendMessage($message);
    }

    public function prepare(): void
    {
        $this->setPermission("piggycustomenchants.command.ce.about");
    }
}