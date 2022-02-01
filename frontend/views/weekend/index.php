<?php

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\web\View;

    /* @var $this yii\web\View */
    
    Yii::$app->cache->flush();
    
    // title
    $this->title = Yii::$app->name . ' - ' . Yii::$app->formatter->asText($common->{'title_'.Yii::$app->language});
    
    $this->registerMetaTag([
        'property' => 'og:title',
        'content' => $this->title
    ]);
    
    // description
    $description = [$this->title];
    foreach ($learns as $learn) {
        $description[] = $learn->{'title_'.Yii::$app->language};
    }
    if ($common->{'meta_description_'.Yii::$app->language}) {
        $this->registerMetaTag([
            'name' => 'description',
            'content' => implode('. ', $description)
        ]);
        $this->registerMetaTag([
            'property' => 'og:description',
            'content' => implode('. ', $description)
        ]);
    }
    
    // body background
    if ($common->background) {
        $this->registerCss("
            body {
                background: url('".$common->background."') center center no-repeat;
                background-size: cover;
            }
        ");
    }
    
    // main image
    if ($common->image) {
        $this->registerMetaTag([
            'name' => 'twitter:image',
            'content' => Url::to([$common->image, 'v' => time()])
        ]);
        $this->registerMetaTag([
            'property' => 'og:image',
            'content' => Url::to([$common->image, 'v' => time()])
        ]);
        $this->registerMetaTag([
            'property' => 'og:image:secure_url',
            'content' => Url::to([$common->image, 'v' => time()])
        ]);
    }
    
    // active color
    $this->registerCss("
        a,
        code,
        .text-primary,
        .btn-link,
        .page-link,
        .btn-outline-primary,
        .btn-outline-primary:disabled,
        .owl-theme .owl-nav [class*='owl-']
        {
            color: ".$common->active_color." !important;
        }
        
        .btn-primary,
        .btn-primary:disabled,
        .btn-outline-primary:hover,
        .show > .btn-outline-primary.dropdown-toggle,
        .dropdown-item.active,
        .dropdown-item:active,
        .custom-control-input:checked ~ .custom-control-label::before,
        .custom-checkbox .custom-control-input:indeterminate ~ .custom-control-label::before,
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link,
        .page-item.active .page-link,
        .badge-primary,
        .progress-bar.bg-primary,
        .list-group-item.active,
        .bg-primary,
        .owl-theme .owl-dots .owl-dot.active span,
        .owl-theme .owl-dots .owl-dot:hover span
        {
            background-color: ".$common->active_color." !important;
            background: ".$common->active_color." !important;
        }
        
        .btn-primary,
        .btn-primary:disabled,
        .btn-outline-primary,
        .btn-outline-primary:hover,
        .show>.btn-outline-primary.dropdown-toggle,
        .custom-control-input:checked ~ .custom-control-label::before,
        .custom-checkbox .custom-control-input:indeterminate ~ .custom-control-label::before,
        .page-item.active .page-link,
        .list-group-item.active,
        .border-primary
        {
            border-color: ".$common->active_color." !important;
        }
    ");
    
    $this->registerJs("
        var ERROR = '" . Yii::t('front', 'Ошибка!') . "',
            ERROR_SERVER = '" . Yii::t('front', 'Что-то пошло не так... Попробуйте ещё раз') . "',
            ERROR_FORBIDDEN = '" . Yii::t('front', 'Похоже, Вы уже зарегистрировались') . "',
            ERROR_BAD_REQUEST = '" . Yii::t('front', 'Проверьте корректность введённых данных') . "',
            ERROR_INTERNAL = '" . Yii::t('front', 'Похоже, сервер перегружен... Пожалуйста, попробуйте ещё раз через несколько минут') . "',
            REGISTRATION_SUCCESS_TEXT_1 = '" . Yii::t('front', 'Вы зарегистрировались для участия в F3 weekend online') . "',
            REGISTRATION_SUCCESS_TEXT_2 = '" . Yii::t('front', 'Ваш номер участника') . "',
            REGISTRATION_SUCCESS_TEXT_3 = '" . Yii::t('front', 'Ваш номер участника будет отправлен на указанную Вами почту. Пожалуйста, проверьте почту: возможно письмо попало в спам.') . "';
    ", View::POS_HEAD);
    
    
    echo $this->render('_header');
    
    echo $this->render('_main', [
        'common' => $common,
        'stream' => $stream,
    ]);
    
    if ($stream->publish) {
        echo $this->render('_stream', [
            'stream' => $stream,
        ]);
    }
    
    if ($questions) {
        echo $this->render('_questions', [
            'questions' => $questions,
            'answers' => $answers,
            'voted' => $voted,
            'votes' => $votes,
            'vote' => $vote,
        ]);        
    }
    
    echo $this->render('_socials');
    
    echo $this->render('_experts', [
        'experts' => $experts
    ]);
    
    echo $this->render('_learn', [
        'learns' => $learns
    ]);
    
    echo $this->render('_past_events', [
        'pastEvents' => $pastEvents
    ]);
    
    echo $this->render('_sponsors');
    
    echo $this->render('_contacts');
    
    echo $this->render('_registration', [
        'registration' => $registration,
        'common' => $common,
        'countries' => $countries,
    ]);
    
    echo $this->render('_footer');
?>

