<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<section id="stream" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12 align-self-end align-self-xl-center">
                <h2 class="display-1 mt-5">
                    <span class="bg-primary">
                        <strong>&nbsp;<?= Yii::t('front', 'Онлайн-трансляция') ?>&nbsp;</strong>
                    </span>
                </h2>
            </div>
            <div class="col-12 col-md-10 col-lg-9 col-xl-8 text-center align-self-start">
            <?php
                $video_link = $stream->{'event_'.Yii::$app->language} ? $stream->{'event_'.Yii::$app->language} : $stream->{'preview_'.Yii::$app->language};
                $link_parts = explode('/', explode('?', $video_link)[0]);
                $video_id = array_pop($link_parts);
            ?>
                <div class="video">
                    <iframe src="https://www.youtube.com/embed/<?= $video_id ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>