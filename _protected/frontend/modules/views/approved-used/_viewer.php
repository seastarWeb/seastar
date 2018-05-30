<div class="bikestock-form">

    <?= dosamigos\gallery\Carousel::widget([
    'items' => $slides, 'json' => true,
    'clientEvents' => [
        'onslide' => 'function(index, slide) {
            console.log(slide);
        }'
]]); ?>
</div>
