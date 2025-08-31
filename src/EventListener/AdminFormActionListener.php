<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class AdminFormActionListener
 */
#[AsEventListener(event: FormEvents::PRE_SET_DATA, method: 'onPreSetData')]
readonly class AdminFormActionListener
{
    public function __construct(private RouterInterface $router) {}

    /**
     * Sets the form action based on the entity data before it is set.
     *
     * @param FormEvent $event The event object containing the form
     *
     * @return void
     */
    public function onPreSetData(FormEvent $event): void
    {
        $form = $event->getForm();
        $entity = $event->getData();

        if (!$entity) {
            return;
        }

        $actionUrl = $this->generateActionUrl($entity);
        if ($actionUrl) {
            $this->setFormAction($form, $actionUrl);
        }
    }

    /**
     * Generates the action URL for a given entity.
     *
     * @param object $entity The entity for which the action URL is generated.
     *
     * @return string|null The generated action URL as a string, or null if the entity does not have an ID.
     */
    private function generateActionUrl(object $entity): ?string
    {
        $entityName = strtolower((new \ReflectionClass($entity))->getShortName());

        return $entity->getId()
            ? sprintf($this->router->generate("admin_app_edit_%s_post", [$entityName => $entity->getId()]), $entityName)
            : sprintf($this->router->generate("admin_app_new_%s_post"), $entityName)
        ;
    }

    /**
     * Set the form action URL for a given form.
     *
     * @param FormInterface $form The form for which the action URL is set.
     * @param string $actionUrl The URL to set as the action of the form.
     *
     * @return void
     */
    private function setFormAction(FormInterface $form, string $actionUrl): void
    {
        $config = $form->getConfig();
        $formOptions = $config->getOptions();
        $formOptions['action'] = $actionUrl;

        $parent = $form->getParent();
        $parent?->add($form->getName(), get_class($config->getType()->getInnerType()), $formOptions);
    }
}