<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerISZrg5v\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerISZrg5v/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerISZrg5v.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerISZrg5v\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerISZrg5v\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'ISZrg5v',
    'container.build_id' => 'ce6aeed2',
    'container.build_time' => 1553702022,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerISZrg5v');
