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

namespace DevBanner\Controller;

use DevBanner\DevBanner;
use DevBanner\Form\DevBannerForm;
use DevBanner\Form\MainForm;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Routing\Annotation\Route;
use Thelia\Controller\Admin\AdminController;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Tools\URL;

class ConfigurationController extends AdminController
{
    /**
     * @Route("/admin/module/DevBanner/save", name="save", methods="post")
     */
    public function save(Request $request)
    {
        if (null !== $response = $this->checkAuth([AdminResources::MODULE], ['DevBanner'], AccessManager::UPDATE)) {
            return $response;
        }

        $url = '/admin/modules/';
        $form = $this->createForm(MainForm::getName(),
            FormType::class,
                    [
                        'text_content' => DevBanner::getConfigValue('text')
                    ]);

        $this->getParserContext()->addForm($form);

        try {
            $validForm = $this->validateForm($form);
            DevBanner::setConfigValue('text', $validForm->get('text_content')->getData());
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();

            $request->getSession()->getFlashBag()->add('devBanner-error', $errorMessage);
        }
        // Redirect to the success URL,
        if ('stay' == $request->get('save_mode')) {
            $url = '/admin/module/DevBanner';
        }

        return $this->generateRedirect(URL::getInstance()->absoluteUrl($url));
    }
}
