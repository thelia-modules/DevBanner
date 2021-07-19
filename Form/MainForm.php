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

namespace DevBanner\Form;

use DevBanner\DevBanner;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Core\Translation\Translator;
use Thelia\Form\BaseForm;

class MainForm extends BaseForm
{
    protected function buildForm(): void
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

}
