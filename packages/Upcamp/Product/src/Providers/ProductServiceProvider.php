<?php
namespace Upcamp\Product\Providers;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Support\ServiceProvider;
use function GuzzleHttp\uri_template;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Event::listen('bagisto.shop.products.view.before', function($viewRenderEventManager) {

            // todo hot hack I dont know how to use template!
            $eventParams = $viewRenderEventManager->getParams();

            if (empty($eventParams['product'])) {

                return $this;
            }
            $product = $eventParams['product'];

            $viewRenderEventManager->addTemplate(
                sprintf('<meta property="og:image" content=%s>', $product->getImagesAttribute()->first()->url()));

        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}