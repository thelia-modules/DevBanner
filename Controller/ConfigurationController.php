<?php


namespace DevBanner\Controller;


use DevBanner\DevBanner;
use DevBanner\Form\DevBannerForm;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Thelia\Controller\Admin\AdminController;
use Thelia\Core\HttpFoundation\Request;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\Resource\AdminResources;
use Symfony\Component\Routing\Annotation\Route;
use Thelia\Tools\URL;

class ConfigurationController extends AdminController
{
    /**
     * @Route("/admin/module/devbanner/save", name="save", methods="post")
     */
    public function Save(Request $request)
    {
        if (null !== $response = $this->checkAuth([AdminResources::MODULE], ['DevBanner'], AccessManager::UPDATE)) {
            return $response;
        }

        $errorMsg = null;
        $url = '/admin/modules/';
        $form = $this->createForm(DevBannerForm::getName(),
            FormType::class,
                    [
                        'text_content' => DevBanner::getConfigValue('text')
                    ]);

        $this->getParserContext()->addForm($form);

        try {
            $vform = $this->validateForm($form);
            DevBanner::setConfigValue('text', $vform->get('text_content')->getData());

        } catch (\Exception $exception) {
            $errorMsg = $exception->getMessage();
        }
        // Redirect to the success URL,
        if ('stay' == $request->get('save_mode')) {
            $url = '/admin/module/DevBanner';
        }
        return $this->generateRedirect(URL::getInstance()->absoluteUrl($url, $errorMsg ? ['errorMsg' => $errorMsg] : null));
    }
}
