<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'form.type_extension.csrf' shared service.

include_once $this->targetDirs[3].'/vendor/symfony/form/FormTypeExtensionInterface.php';
include_once $this->targetDirs[3].'/vendor/symfony/form/AbstractTypeExtension.php';
include_once $this->targetDirs[3].'/vendor/symfony/form/Extension/Csrf/Type/FormTypeCsrfExtension.php';

return $this->privates['form.type_extension.csrf'] = new \Symfony\Component\Form\Extension\Csrf\Type\FormTypeCsrfExtension(($this->services['security.csrf.token_manager'] ?? $this->load('getSecurity_Csrf_TokenManagerService.php')), true, '_token', ($this->services['translator'] ?? $this->getTranslatorService()), 'validators', ($this->privates['form.server_params'] ?? $this->load('getForm_ServerParamsService.php')));