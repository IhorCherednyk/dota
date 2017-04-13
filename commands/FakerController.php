<?php

namespace app\commands;
use yii\console\Controller;
class FakerController extends Controller{
    
    public function actionTeam(){
        $faker = Factory::create();
        $created = false;

        for ($i = 1; $i <= 5; $i++) {
            $model = new Categories([
                'name' => $faker->word,
                'icon' => 'fa fa-gamepad',
                'number_of_videos' => 0,
                'status' => Categories::STATUS_ENABLED,
                'seo_text' => $faker->text(250),
                'meta_keywords' => implode(', ', $faker->words(10)),
                'meta_description' => $faker->text(250),
            ]);

            if ($model->save()) {
                $created = true;
            }
        }

        return $created;
    }
    
}
      