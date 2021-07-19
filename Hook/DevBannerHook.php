<?php

/*
 * This file is part of the Thelia package.
 * http://www.thelia.net
 *
 * (c) OpenStudio <info@thelia.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevBanner\Hook;

use DevBanner\DevBanner;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class DevBannerHook extends BaseHook
{
    public function DevBannerConfig(HookRenderEvent $event): void
    {
        $event->add($this->render(
            'module-configuration.html'
        ));
    }

    public function RenderModule(HookRenderEvent $event): void
    {
        $message = DevBanner::getConfigValue('text');

        $event->add(
            $this->render('module.html',
                [
                    'message' => $message,
                ]
            )
        );
    }
}
