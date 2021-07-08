<?php


namespace DevBanner\Form;

use DevBanner\DevBanner;
use Metabase\Metabase;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class DevBannerForm extends BaseForm
{
    protected function buildForm()
    {
        $translator = Translator::getInstance();
        $this->formBuilder
            ->add(
                'text_content',
                TextareaType::class,
                [
                    'constraints' => [new NotBlank()],
                    'data' => DevBanner::getConfigValue('text'),
                    'label' => $translator->trans('The content to display', [], DevBanner::DOMAIN_NAME),
                    'label_attr' => ['for' => 'text_content'],
                ]
            );
    }

    public static function getName(): string
    {
        return 'devBannerForm';
    }
}
