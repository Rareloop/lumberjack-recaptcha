<?php

namespace Rareloop\Lumberjack\Recaptcha;

use Rareloop\Lumberjack\Validation\Validator;
use Rareloop\Lumberjack\Recaptcha\RecaptchaRule;
use Rareloop\Lumberjack\Providers\ServiceProvider;
use Rareloop\Lumberjack\Recaptcha\Twig\RecaptchaExtension;

class RecaptchaServiceProvider extends ServiceProvider
{
    public function boot(Validator $validator)
    {
        $validator->addValidator('recaptcha', $this->app->get(RecaptchaRule::class));

        add_filter('timber/twig', function ($twig) {
            $twig->addExtension($this->app->get(RecaptchaExtension::class));

            return $twig;
        });

        add_filter('script_loader_tag', [$this, 'addScriptAttributes'], 10, 2);
    }

    public function addScriptAttributes($tag, $handle)
    {
        if ($handle === 'lumberjack-recaptcha') {
            $tag = str_replace('src', 'async defer src', $tag);
        }

        return $tag;
    }
}
