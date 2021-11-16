<?php
    use yii\helpers\Html;
?>

<section id="questions" class="px-3 px-lg-5">
    <div class="container-fluid px-lg-5">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-12 align-self-end">
                <h2 class="display-3 my-5">
                    <strong><?= $questions->{'title_'.Yii::$app->language} ?></strong>
                </h2>
            </div>
            <div class="col-12 align-self-start">
                <div class="row align-items-center justify-content-start">
                    <div class="col-12 my-4">

                        <?php
                            echo $this->render('_vote', [
                                'model' => $vote,
                                'answers' => $answers,
                                'questions' => $questions,
                                'voted' => $voted,
                                'results' => $votes,
                            ]);
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>