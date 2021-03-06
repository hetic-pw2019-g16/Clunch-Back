<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // Sonata Core Bundles
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),

            // Sonata ORM Admin Bundle
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),

            // Sonata Media Bundle and Dependencies
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),

            // JMS SerializerBundle
            new JMS\SerializerBundle\JMSSerializerBundle(),

            // FOSUser Bundle
            new FOS\UserBundle\FOSUserBundle(),

            // FOSRest Bundle
            new FOS\RestBundle\FOSRestBundle(),

            // CORS Bundle
            new Nelmio\CorsBundle\NelmioCorsBundle(),

            // JWTAuth
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),

            // Custom Bundles
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
            new Clunch\AdminBundle\AdminBundle(),
            new Clunch\UserBundle\UserBundle(),
            new Clunch\CompanyBundle\CompanyBundle(),
            new Clunch\EventBundle\EventBundle(),
            new Clunch\CommentBundle\CommentBundle(),
            new Clunch\RecipeBundle\RecipeBundle(),
            new Clunch\CategoryBundle\CategoryBundle(),
            new Clunch\IngredientBundle\IngredientBundle(),
            new Clunch\AllergyBundle\AllergyBundle(),
            new Clunch\TagBundle\TagBundle(),
            new Clunch\NewsletterBundle\NewsletterBundle(),
            new Clunch\ApiBundle\ApiBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->setParameter('container.autowiring.strict_mode', true);
            $container->setParameter('container.dumper.inline_class_loader', true);

            $container->addObjectResource($this);
        });
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
