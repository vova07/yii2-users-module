<?php

namespace vova07\users;

use yii\base\BootstrapInterface;

/**
 * Users module bootstrap class.
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        // Add module URL rules.
        $app->urlManager->addRules(
            [
                '<_m:users>' => '<_m>/default/index',
                '<_a:(login|signup|activation|recovery|recovery-confirmation|resend)>' => 'users/guest/<_a>',
                '<_a:logout>' => 'users/user/<_a>',
                '<_a:email>' => 'users/default/<_a>',
                '<_m:users>/<username:[a-zA-Z0-9_-]{3,20}+>' => '<_m>/default/view',
                'my/settings/<_a:[\w\-]+>' => 'users/user/<_a>',
            ],
            false
        );

        // Add module I18N category.
        if (!isset($app->i18n->translations['users']) && !isset($app->i18n->translations['users*'])) {
            $app->i18n->translations['users'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@vova07/users/messages',
                'forceTranslation' => true
            ];
        }
    }
}
