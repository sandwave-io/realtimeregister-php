<?php declare(strict_types = 1);

use SandwaveIo\RealtimeRegister\Domain\Enum\TemplateNameEnum;

return [
    'name' => TemplateNameEnum::TEMPLATE_NAME_THANK_YOU_PAGE,
    'subject' => 'template_subject',
    'text' => 'template_text',
    'html' => 'template_html',
    'contexts' => ['base'],
];
