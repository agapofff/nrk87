<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\View;
    
	$this->title = Yii::$app->params['title'] ?: Yii::t('front', 'Lookbook');
	$h1 = Yii::$app->params['h1'] ?: $this->title;
?>

    <div class="container position-relative ">

        <div class="row mt-4 mt-lg-5">
            
            <div class="col-12">
                <h1 class="display-1 acline my-4 my-lg-5 text-center">
                    <?= $h1 ?>
                </h1>
            </div>
        </div>
        
    </div>

	<div class="container-fluid position-relative my-4 my-lg-5">

		<div class="row">
		
		<?php
			foreach ($images as $image){
		?>
				<div class="col-12 col-md-6 col-xl-4 mb-3 mb-lg-4">
					<img src="/images/lookbook/<?= $image ?>.jpg" loading="lazy" class="img-fluid pointer-events-none">
				</div>
		<?php
			}
		?>
		
		</div>
		
	</div>

	<div class="text-center my-5">
		<?= Html::a(Html::tag('span') . Yii::t('front', 'Посмотреть каталог'), [
				'/catalog'
			], [
				'title' => Yii::t('front', 'Посмотреть каталог'),
				'class' => 'btn btn-nrk',
			])
		?>
	</div>