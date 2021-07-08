<?php


namespace DevBanner\Hook;

use DevBanner\DevBanner;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Model\ModuleConfig;
use Thelia\Model\ModuleConfigQuery;

class DevBannerHook extends BaseHook
{
    public function DevBannerConfig(HookRenderEvent $event)
    {
        if (null !== $params = ModuleConfigQuery::create()->findByModuleId(DevBanner::getModuleId())) {
            /** @var ModuleConfig $param */
            foreach ($params as $param) {
                $vars[$param->getName()] = $param->getValue();
            }
        }

        $event->add($this->render(
            'module-configuration.html'
        ));
    }

    public function RenderModule(HookRenderEvent $event)
    {
        $message = DevBanner::getConfigValue('text');

        $event->add(
            $this->render('module.html',
                [
                    'message' => $message
                ]
            )
        );
    }
}

