<?php

namespace VHUG\Contao\Boxes\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use VHUG\Contao\Boxes\ContaoBoxesBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoBoxesBundle::class)
            ->setLoadAfter([ContaoCoreBundle::class])
        ];
    }
}