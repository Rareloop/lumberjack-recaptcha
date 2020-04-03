<?php

namespace Rareloop\Lumberjack\Recaptcha\Twig;

use Twig\TwigFunction;
use Rareloop\Lumberjack\Config;
use Twig\Extension\AbstractExtension;

class RecaptchaExtension extends AbstractExtension
{
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('recaptcha', [$this, 'recaptcha']),
            new TwigFunction('recaptcha_invisible', [$this, 'recaptchaInvisible']),
        ];
    }

    public function recaptcha()
    {
        wp_enqueue_script('lumberjack-recaptcha', 'https://www.google.com/recaptcha/api.js', [], 'v2');

        return '<div class="g-recaptcha" data-sitekey="' . $this->config->get('recaptcha.key') . '"></div>';
    }

    public function recaptchaInvisible($classes = '')
    {
        wp_enqueue_script('lumberjack-recaptcha', 'https://www.google.com/recaptcha/api.js', [], 'v2');

        $callbackName = 'recaptchaCallback' . time();
        $buttonId = 'recaptchaButton' . time();

        return '
            <script>
                function ' . $callbackName . '(token) {
                    document.getElementById("' . $buttonId . '").closest("form").submit();
                }
            </script>
            <button id="' . $buttonId . '" class="g-recaptcha ' . $classes . '" type="submit" data-sitekey="' . $this->config->get('recaptcha.key') . '" data-callback="' . $callbackName . '">Submit</button>
        ';
    }
}
